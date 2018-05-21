<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Menu';
        $this->cekmodul = $this->user['iGroupUser']; 
        $this->acl   = $this->auth->checkAcl($this->modul,$this->cekmodul);  
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }
        if(empty($this->acl)) {  
            $data['judul'] = '';
            $return = $this->load->view('home/403',$data,true); 
            echo $return;
            exit;
        }

 
        $this->table = 'm_machine';
        $this->pk ='iMachine';

        $this->table = 'm_menu';
        $this->pk ='iMenu';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('login');
        }

        //$this->load->model('menu_model','model');
    }
    
    function index()
    {
        $sql = 'select a.*,b.vGroupMenuName 
                from m_menu a 
                join m_groupmenu b on a.iGroupMenu=b.iGroupMenu
                where a.lDeleted=0
                and b.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Menu/create_action');
        $data['cMenuCode'] = set_value('cMenuCode'); 
        $data['vMenuName'] = set_value('vMenuName'); 
        $data['vDescription'] = set_value('vDescription'); 
        $data['iGroupMenu'] = set_value('iGroupMenu'); 
        $data['iNeedLogin'] = set_value('iNeedLogin'); 

        $data['vController'] = set_value('vController'); 
        
        $data['iMenu'] = set_value('iMenu'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Menu'; 
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cMenuCode  = $this->input->post('cMenuCode',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $vMenuName      = $this->input->post('vMenuName',TRUE);
        $iGroupMenu      = $this->input->post('iGroupMenu',TRUE);
        $iNeedLogin      = $this->input->post('iNeedLogin',TRUE);
        $vController      = $this->input->post('vController',TRUE);

        $data['cMenuCode'] = $cMenuCode;
        $data['vDescription'] = $vDescription;
        $data['vMenuName'] = $vMenuName;
        $data['iGroupMenu'] = $iGroupMenu;
        $data['iNeedLogin'] = $iNeedLogin;
        $data['vController'] = $vController;
        

        
        
        // validasi duplicate input
        $sqCek = 'select * from m_menu a where a.cMenuCode="'.$cMenuCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Menu/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Menu'); 
        }



    }
    function after_insert_process($last_id){

        /*auto number*/
        $nomor = "MN".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_menu SET cMenuCode = '".$nomor."' WHERE iMenu=$last_id LIMIT 1";
        $query = $this->db->query( $sql );


    }

    function update($id){

        $sql='select * from m_menu a where a.lDeleted=0 and a.iMenu="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Menu');            
        }else{
            $data['iMenu'] = $dataD['iMenu']; 
            $data['cMenuCode'] = $dataD['cMenuCode']; 
            $data['vMenuName'] = $dataD['vMenuName']; 
            $data['vDescription'] = $dataD['vDescription']; 
            $data['iGroupMenu'] = $dataD['iGroupMenu']; 
            $data['iNeedLogin'] = $dataD['iNeedLogin']; 
            $data['vController'] = $dataD['vController']; 

            
            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Menu'; 

            $data['action'] = site_url('Menu/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cMenuCode  = $this->input->post('cMenuCode',TRUE);
        $vDescription  = $this->input->post('vDescription');
        $vMenuName      = $this->input->post('vMenuName',TRUE);
        $iMenu  = $this->input->post('iMenu',TRUE);
        $iGroupMenu  = $this->input->post('iGroupMenu',TRUE);
        $iNeedLogin  = $this->input->post('iNeedLogin',TRUE);
        $vController  = $this->input->post('vController',TRUE);

        
        //$data['iMenu'] = $dataD['iMenu']; 
        $data['cMenuCode'] = $cMenuCode; 
        $data['vMenuName'] = $vMenuName; 
        $data['iGroupMenu'] = $iGroupMenu; 
        $data['iNeedLogin'] = $iNeedLogin; 
        $data['vController'] = $vController; 
        
        

        // validasi duplicate input
        $sqCek = 'select * from m_menu a where a.cMenuCode="'.$cMenuCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_menu a where a.lDeleted=0 and a.iMenu="'.$iMenu.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vDescription==""){
            $data['vDescription'] = trim($dataD['vDescription']);
        }else{
            $data['vDescription'] = $vDescription;
        }

        $uniq_key = $dataD['cMenuCode'];
        $uniq_input = $cMenuCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Menu/update/'.$iMenu);

        }else{
            $this->db->where($this->pk, $iMenu);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Menu');

        }
    }

    function detail(){

        
        $sql='select * 
                from m_menu a 
                join m_groupmenu b on b.iGroupMenu=a.iGroupMenu
                where a.lDeleted=0 
                and a.iMenu="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iMenu'] = '-'; 
            $data['vMenuName'] = '-'; 
            $data['vController'] = '-'; 
            $data['vDescription'] = '-'; 
            $data['vGroupMenuName'] = '-'; 
        }else{
            $data['iMenu'] = $dataD['iMenu']; 
            $data['vMenuName'] = $dataD['vMenuName']; 
            $data['vController'] = $dataD['vController']; 
            $data['vDescription'] = $dataD['vDescription'];  
            $data['vGroupMenuName'] = $dataD['vGroupMenuName'];  
        }

        $dt = $this->load->view('detail',$data, TRUE);
        echo $dt; 

    }


    function delete($id)
    {
        $this->db->where($this->pk, $id);
        $data = array('lDeleted'=>1);
        $this->db->update($this->table,$data);
        
        $this->session->set_flashdata('success', 'Data deleted successfully');
        redirect('Menu');
    }


   
}