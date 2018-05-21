<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groupmenu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Groupmenu';
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

 

        $this->table = 'm_groupmenu';
        $this->pk ='iGroupMenu';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }

        //$this->load->model('Groupmenu_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_groupmenu a where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Groupmenu/create_action');
        $data['cGroupMenuCode'] = set_value('cGroupMenuCode'); 
        $data['vGroupMenuName'] = set_value('vGroupMenuName'); 
        $data['iJenis'] = set_value('iJenis'); 
        $data['iNeedLogin'] = set_value('iNeedLogin'); 
        $data['vDescription'] = set_value('vDescription'); 
        $data['iGroupMenu'] = set_value('iGroupMenu'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Groupmenu'; 
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cGroupMenuCode  = $this->input->post('cGroupMenuCode',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $vGroupMenuName      = $this->input->post('vGroupMenuName',TRUE);
        $iJenis      = $this->input->post('iJenis',TRUE);
        $iNeedLogin      = $this->input->post('iNeedLogin',TRUE);


        

        $data['cGroupMenuCode'] = $cGroupMenuCode;
        $data['vDescription'] = $vDescription;
        $data['vGroupMenuName'] = $vGroupMenuName;
        $data['iJenis'] = $iJenis;
        $data['iNeedLogin'] = $iNeedLogin;
        
        // validasi duplicate input
        $sqCek = 'select * from m_groupmenu a where a.cGroupMenuCode="'.$cGroupMenuCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Groupmenu/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Groupmenu'); 
        }



    }
    function after_insert_process($last_id){

        /*auto number*/
        $nomor = "GM".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_groupmenu SET cGroupMenuCode = '".$nomor."' WHERE iGroupMenu=$last_id LIMIT 1";
        $query = $this->db->query( $sql );


    }

    function update($id){

        $sql='select * from m_groupmenu a where a.lDeleted=0 and a.iGroupMenu="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Groupmenu');            
        }else{
            $data['iGroupMenu'] = $dataD['iGroupMenu']; 
            $data['cGroupMenuCode'] = $dataD['cGroupMenuCode']; 
            $data['vGroupMenuName'] = $dataD['vGroupMenuName']; 
            $data['vDescription'] = $dataD['vDescription']; 
            $data['iJenis'] = $dataD['iJenis']; 
            $data['iNeedLogin'] = $dataD['iNeedLogin']; 
            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Groupmenu'; 

            $data['action'] = site_url('Groupmenu/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cGroupMenuCode  = $this->input->post('cGroupMenuCode',TRUE);
        $vDescription  = $this->input->post('vDescription');
        $vGroupMenuName      = $this->input->post('vGroupMenuName',TRUE);
        $iGroupMenu  = $this->input->post('iGroupMenu',TRUE);
        $iJenis  = $this->input->post('iJenis',TRUE);
        $iNeedLogin  = $this->input->post('iNeedLogin',TRUE);

        

        
        $data['iJenis'] = $iJenis; 
        $data['iNeedLogin'] = $iNeedLogin;
        $data['cGroupMenuCode'] = $cGroupMenuCode; 
        $data['vGroupMenuName'] = $vGroupMenuName; 

        // validasi duplicate input
        $sqCek = 'select * from m_groupmenu a where a.cGroupMenuCode="'.$cGroupMenuCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_groupmenu a where a.lDeleted=0 and a.iGroupMenu="'.$iGroupMenu.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vDescription==""){
            $data['vDescription'] = trim($dataD['vDescription']);
        }else{
            $data['vDescription'] = $vDescription;
        }

        $uniq_key = $dataD['cGroupMenuCode'];
        $uniq_input = $cGroupMenuCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Groupmenu/update/'.$iGroupMenu);

        }else{
            $this->db->where($this->pk, $iGroupMenu);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Groupmenu');

        }
    }

    function detail(){

        $sql='select * from m_groupmenu a where a.lDeleted=0 and a.iGroupMenu="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
                
            $data['iGroupMenu'] = '-'; 
            $data['cGroupMenuCode'] = '-'; 
            $data['vGroupMenuName'] = '-'; 
            $data['vDescription'] = '-'; 
            $data['iJenis'] = '-'; 
            $data['iNeedLogin'] = '-'; 

        }else{
            $data['iGroupMenu'] = $dataD['iGroupMenu']; 
            $data['cGroupMenuCode'] = $dataD['cGroupMenuCode']; 
            $data['vGroupMenuName'] = $dataD['vGroupMenuName']; 
            $data['vDescription'] = $dataD['vDescription']; 
            $data['iJenis'] = $dataD['iJenis']; 
            $data['iNeedLogin'] = $dataD['iNeedLogin']; 
            

            

            

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
        redirect('Groupmenu');
    }


   
}