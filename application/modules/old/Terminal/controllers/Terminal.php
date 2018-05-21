<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Terminal extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Terminal';
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

 

        $this->table = 'm_terminal';
        $this->pk ='iTerminal';
        
              
        //$this->load->model('Terminal_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_terminal a where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Terminal/create_action');
        $data['cTerminalCode'] = set_value('cTerminalCode'); 
        $data['vTerminalName'] = set_value('vTerminalName');   
        $data['iTerminal'] = set_value('iTerminal'); 
        $data['vIpAddress'] = set_value('vIpAddress'); 
        
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Terminal';  
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cTerminalCode  = $this->input->post('cTerminalCode',TRUE);
        $vTerminalName  = $this->input->post('vTerminalName',TRUE);
        $vIpAddress  = $this->input->post('vIpAddress',TRUE); 

        $data['cTerminalCode'] = $cTerminalCode;
        $data['vTerminalName'] = $vTerminalName;
        $data['vIpAddress'] = $vIpAddress;  
        $data['dCreate'] = date('Y-m-d H:i:s');
        
        // validasi duplicate input
        $sqCek = 'select * from m_terminal a where a.cTerminalCode="'.$cTerminalCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Terminal/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Terminal'); 
        }



    }
    function after_insert_process($last_id){ 
        /*auto number*/
        $nomor = "TR".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_terminal SET cTerminalCode = '".$nomor."' WHERE iTerminal=$last_id LIMIT 1";
        $query = $this->db->query( $sql ); 
    }

    function update($id){

        $sql='select * from m_terminal a where a.lDeleted=0 and a.iTerminal="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Terminal');            
        }else{
            $data['iTerminal'] = $dataD['iTerminal']; 
            $data['cTerminalCode'] = $dataD['cTerminalCode'];  
            $data['vTerminalName'] = $dataD['vTerminalName'];  
            $data['vIpAddress'] = $dataD['vIpAddress']; 
            $data['cAction'] = 'update'; 
            $data['cController'] = 'Terminal';  

            $data['action'] = site_url('Terminal/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cTerminalCode  = $this->input->post('cTerminalCode',TRUE);
        $vTerminalName  = $this->input->post('vTerminalName'); 
        $vIpAddress      = $this->input->post('vIpAddress',TRUE); 
        $iTerminal  = $this->input->post('iTerminal',TRUE);

        
        //$data['iTerminal'] = $dataD['iTerminal']; 
        $data['cTerminalCode'] = $cTerminalCode;  
        $data['vIpAddress'] = $vIpAddress;  
        $data['dupdate'] = date('Y-m-d H:i:s');

        // validasi duplicate input
        $sqCek = 'select * from m_terminal a where a.cTerminalCode="'.$cTerminalCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_terminal a where a.lDeleted=0 and a.iTerminal="'.$iTerminal.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vTerminalName==""){
            $data['vTerminalName'] = trim($dataD['vTerminalName']);
        }else{
            $data['vTerminalName'] = $vTerminalName;
        }

        $uniq_key = $dataD['cTerminalCode'];
        $uniq_input = $cTerminalCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Terminal/update/'.$iTerminal);

        }else{
            $this->db->where($this->pk, $iTerminal);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Terminal');

        }
    }

    function detail(){ 
        $sql='select * from m_terminal a where a.lDeleted=0 and a.iTerminal="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {      
            $data['iTerminal'] = '-'; 
            $data['cTerminalCode'] = '-';  
            $data['vTerminalName'] = '-'; 
            $data['vIpAddress'] = '-'; 
        }else{
            $data['iTerminal'] = $dataD['iTerminal']; 
            $data['cTerminalCode'] = $dataD['cTerminalCode'];  
            $data['vTerminalName'] = $dataD['vTerminalName'];  
            $data['vIpAddress'] = $dataD['vIpAddress'];   
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
        redirect('Terminal');
    }


   
}