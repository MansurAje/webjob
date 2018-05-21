<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Shift extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Shift';
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

 

        $this->table = 'm_shift';
        $this->pk ='iShift';
        
              
        //$this->load->model('Shift_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_shift a where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Shift/create_action');
        $data['cShiftCode'] = set_value('cShiftCode'); 
        $data['vShiftName'] = set_value('vShiftName');   
        $data['iShift'] = set_value('iShift'); 
        $data['vDescription'] = set_value('vDescription'); 
        
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Shift';  
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cShiftCode  = $this->input->post('cShiftCode',TRUE);
        $vShiftName  = $this->input->post('vShiftName',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE); 

        $data['cShiftCode'] = $cShiftCode;
        $data['vShiftName'] = $vShiftName;
        $data['vDescription'] = $vDescription;  
        $data['dCreate'] = date('Y-m-d H:i:s');
        
        // validasi duplicate input
        $sqCek = 'select * from m_shift a where a.cShiftCode="'.$cShiftCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Shift/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Shift'); 
        }



    }
    function after_insert_process($last_id){ 
        /*auto number*/
        $nomor = "SF".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_shift SET cShiftCode = '".$nomor."' WHERE iShift=$last_id LIMIT 1";
        $query = $this->db->query( $sql ); 
    }

    function update($id){

        $sql='select * from m_shift a where a.lDeleted=0 and a.iShift="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Shift');            
        }else{
            $data['iShift'] = $dataD['iShift']; 
            $data['cShiftCode'] = $dataD['cShiftCode'];  
            $data['vShiftName'] = $dataD['vShiftName'];  
            $data['vDescription'] = $dataD['vDescription']; 
            $data['cAction'] = 'update'; 
            $data['cController'] = 'Shift';  

            $data['action'] = site_url('Shift/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cShiftCode  = $this->input->post('cShiftCode',TRUE);
        $vShiftName  = $this->input->post('vShiftName'); 
        $vDescription      = $this->input->post('vDescription',TRUE); 
        $iShift  = $this->input->post('iShift',TRUE);

        
        //$data['iShift'] = $dataD['iShift']; 
        $data['cShiftCode'] = $cShiftCode;  
        $data['vDescription'] = $vDescription;  
        $data['dupdate'] = date('Y-m-d H:i:s');

        // validasi duplicate input
        $sqCek = 'select * from m_shift a where a.cShiftCode="'.$cShiftCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_shift a where a.lDeleted=0 and a.iShift="'.$iShift.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vShiftName==""){
            $data['vShiftName'] = trim($dataD['vShiftName']);
        }else{
            $data['vShiftName'] = $vShiftName;
        }

        $uniq_key = $dataD['cShiftCode'];
        $uniq_input = $cShiftCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Shift/update/'.$iShift);

        }else{
            $this->db->where($this->pk, $iShift);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Shift');

        }
    }

    function detail(){

       $sql='select * from m_shift a where a.lDeleted=0 and a.iShift="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iShift'] = '-'; 
            $data['cShiftCode'] = '-'; 
            $data['vShiftName'] = '-'; 
            $data['vDescription'] = '-'; 
        }else{
            $data['iShift'] = $dataD['iShift']; 
            $data['cShiftCode'] = $dataD['cShiftCode'];  
            $data['vShiftName'] = $dataD['vShiftName'];  
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
        redirect('Shift');
    }


   
}