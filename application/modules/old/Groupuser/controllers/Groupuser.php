<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groupuser extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Groupuser';
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

 
        
        $this->table = 'm_groupuser';
        $this->pk ='iGroupUser';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }

        //$this->load->model('Groupuser_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_groupuser a where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Groupuser/create_action');
        $data['cGroupUserCode'] = set_value('cGroupUserCode'); 
        $data['vGroupUserName'] = set_value('vGroupUserName'); 
        /*$data['iJenis'] = set_value('iJenis'); */
        $data['vDescription'] = set_value('vDescription'); 
        $data['iGroupUser'] = set_value('iGroupUser'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Groupuser'; 
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cGroupUserCode  = $this->input->post('cGroupUserCode',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $vGroupUserName      = $this->input->post('vGroupUserName',TRUE);
        /*$iJenis      = $this->input->post('iJenis',TRUE);*/

        

        $data['cGroupUserCode'] = $cGroupUserCode;
        $data['vDescription'] = $vDescription;
        $data['vGroupUserName'] = $vGroupUserName;
        /*$data['iJenis'] = $iJenis;*/
        
        // validasi duplicate input
        $sqCek = 'select * from m_groupuser a where a.cGroupUserCode="'.$cGroupUserCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Groupuser/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Groupuser'); 
        }



    }
    function after_insert_process($last_id){

        /*auto number*/
        $nomor = "GU".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_groupuser SET cGroupUserCode = '".$nomor."' WHERE iGroupUser=$last_id LIMIT 1";
        $query = $this->db->query( $sql );


    }

    function update($id){

        $sql='select * from m_groupuser a where a.lDeleted=0 and a.iGroupUser="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Groupuser');            
        }else{
            $data['iGroupUser'] = $dataD['iGroupUser']; 
            $data['cGroupUserCode'] = $dataD['cGroupUserCode']; 
            $data['vGroupUserName'] = $dataD['vGroupUserName']; 
            $data['vDescription'] = $dataD['vDescription']; 
            /*$data['iJenis'] = $dataD['iJenis']; */
            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Groupuser'; 

            $data['action'] = site_url('Groupuser/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cGroupUserCode  = $this->input->post('cGroupUserCode',TRUE);
        $vDescription  = $this->input->post('vDescription');
        $vGroupUserName      = $this->input->post('vGroupUserName',TRUE);
        $iGroupUser  = $this->input->post('iGroupUser',TRUE);
        /*$iJenis  = $this->input->post('iJenis',TRUE);*/

        

        
        /*$data['iJenis'] = $dataD['iJenis']; */
        $data['cGroupUserCode'] = $cGroupUserCode; 
        $data['vGroupUserName'] = $vGroupUserName; 

        // validasi duplicate input
        $sqCek = 'select * from m_groupuser a where a.cGroupUserCode="'.$cGroupUserCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_groupuser a where a.lDeleted=0 and a.iGroupUser="'.$iGroupUser.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vDescription==""){
            $data['vDescription'] = trim($dataD['vDescription']);
        }else{
            $data['vDescription'] = $vDescription;
        }

        $uniq_key = $dataD['cGroupUserCode'];
        $uniq_input = $cGroupUserCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Groupuser/update/'.$iGroupUser);

        }else{
            $this->db->where($this->pk, $iGroupUser);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Groupuser');

        }
    }

    function detail(){

        $sql='select * from m_groupuser a where a.lDeleted=0 and a.iGroupUser="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
                
            $data['iGroupUser'] = '-'; 
            $data['cGroupUserCode'] = '-'; 
            $data['vGroupUserName'] = '-'; 
            $data['vDescription'] = '-'; 
            

        }else{
            $data['iGroupUser'] = $dataD['iGroupUser']; 
            $data['cGroupUserCode'] = $dataD['cGroupUserCode']; 
            $data['vGroupUserName'] = $dataD['vGroupUserName']; 
            $data['vDescription'] = $dataD['vDescription']; 
            

            

            

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
        redirect('Groupuser');
    }


   
}