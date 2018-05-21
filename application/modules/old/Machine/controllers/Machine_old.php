<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Machine extends MY_Controller
{
    function __construct()
    {

        

        parent::__construct();
        
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Machine';
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
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }

        //$this->load->model('Machine_model','model');
    }
    
    function index()
    {
        $sql = 'select a.*,b.vNama_proses
                from m_machine a 
                join m_jenis_proses b on b.iJenis_proses=a.iJenis_proses
                where a.lDeleted=0
                and b.lDeleted=0
                order by a.iMachine DESC';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Machine/create_action');
        $data['cMachineCode'] = set_value('cMachineCode'); 
        $data['vMachineName'] = set_value('vMachineName'); 
        $data['vDescription'] = set_value('vDescription'); 
        
        
        
        $data['vFormatOutput'] = set_value('vFormatOutput'); 
        $data['iIndexStart'] = set_value('iIndexStart'); 
        $data['iIndexFinish'] = set_value('iIndexFinish'); 

        $data['iMachine'] = set_value('iMachine'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Machine'; 
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cMachineCode  = $this->input->post('cMachineCode',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $vMachineName      = $this->input->post('vMachineName',TRUE);

        $vFormatOutput  = $this->input->post('vFormatOutput',TRUE);
        $iIndexStart  = $this->input->post('iIndexStart',TRUE);
        $iIndexFinish      = $this->input->post('iIndexFinish',TRUE);

        $iJenis_proses      = $this->input->post('iJenis_proses',TRUE);
        $cMachineCode      = $this->input->post('cMachineCode',TRUE);


        $data['vFormatOutput'] = $vFormatOutput;
        $data['iIndexStart'] = $iIndexStart;
        $data['iIndexFinish'] = $iIndexFinish;

        $data['cMachineCode'] = $cMachineCode;
        $data['vDescription'] = $vDescription;
        $data['vMachineName'] = $vMachineName;
        $data['iJenis_proses'] = $iJenis_proses;
        $data['cMachineCode'] = $cMachineCode;

        $data['dCreate'] = date('Y-m-d H:i:s');
        $data['cCreated'] =$this->user['cNip'];

        
        // validasi duplicate input
        $sqCek = 'select * from m_machine a where a.cMachineCode="'.$cMachineCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Machine/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Machine'); 
        }



    }
    function after_insert_process($last_id){

        /*auto number*/
        $sqCek = 'select * from m_machine a where a.iMachine="'.$last_id.'" ';
        $dCek =  $this->db->query($sqCek)->row_array();

        /*print_r($dCek);
        exit;*/

        if($dCek['cMachineCode'] == ""){
            $nomor = "M".str_pad($last_id, 5, "0", STR_PAD_LEFT);
            $sql = "UPDATE m_machine SET cMachineCode = '".$nomor."' WHERE iMachine=$last_id LIMIT 1";
            $query = $this->db->query( $sql );
        }
        


    }

    function update($id){

        //$sql='select * from m_machine a where a.lDeleted=0 and a.iMachine="'.$id.'" ';

        $sql = 'select a.*,b.iJenis_proses,b.vNama_proses
                from m_machine a 
                join m_jenis_proses b on b.iJenis_proses=a.iJenis_proses
                where a.lDeleted=0
                and b.lDeleted=0
                and  a.iMachine="'.$id.'" 
                ';

        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Machine');            
        }else{
            $data['iMachine'] = $dataD['iMachine']; 
            $data['cMachineCode'] = $dataD['cMachineCode']; 
            $data['vMachineName'] = $dataD['vMachineName']; 
            $data['vDescription'] = $dataD['vDescription']; 

            $data['vFormatOutput'] = $dataD['vFormatOutput']; 
            $data['iIndexStart'] = $dataD['iIndexStart']; 
            $data['iIndexFinish'] = $dataD['iIndexFinish']; 

            $data['iJenis_proses'] = $dataD['iJenis_proses']; 
            $data['vNama_proses'] = $dataD['vNama_proses']; 
            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Machine'; 

            $data['action'] = site_url('Machine/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $cMachineCode  = $this->input->post('cMachineCode',TRUE);
        $vDescription  = $this->input->post('vDescription');
        $vMachineName      = $this->input->post('vMachineName',TRUE);
        $iMachine  = $this->input->post('iMachine',TRUE);
        
        $vFormatOutput  = $this->input->post('vFormatOutput',TRUE);
        $iIndexStart  = $this->input->post('iIndexStart',TRUE);
        $iIndexFinish      = $this->input->post('iIndexFinish',TRUE);
        
        //$data['iMachine'] = $dataD['iMachine']; 
        $data['cMachineCode'] = $cMachineCode; 
        $data['vMachineName'] = $vMachineName; 

        $data['vFormatOutput'] = $vFormatOutput;
        $data['iIndexStart'] = $iIndexStart;
        $data['iIndexFinish'] = $iIndexFinish;

        $data['dupdate'] = date('Y-m-d H:i:s');
        $data['cUpdate'] =$this->user['cNip'];


        // validasi duplicate input
        $sqCek = 'select * from m_machine a where a.cMachineCode="'.$cMachineCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_machine a where a.lDeleted=0 and a.iMachine="'.$iMachine.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vDescription==""){
            $data['vDescription'] = trim($dataD['vDescription']);
        }else{
            $data['vDescription'] = $vDescription;
        }

        $uniq_key = $dataD['cMachineCode'];
        $uniq_input = $cMachineCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Machine/update/'.$iMachine);

        }else{
            $this->db->where($this->pk, $iMachine);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Machine');

        }
    }

    function detail(){

        
        $sql='select * from m_machine a where a.lDeleted=0 and a.iMachine="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iMachine'] = '-'; 
            $data['cMachineCode'] = '-'; 
            $data['vMachineName'] = '-'; 
            $data['vDescription'] = '-'; 

            $data['vFormatOutput'] = '-'; 
            $data['iIndexStart'] = '-'; 
            $data['iIndexFinish'] = '-'; 

        }else{
            $data['iMachine'] = $dataD['iMachine']; 
            $data['cMachineCode'] = $dataD['cMachineCode']; 
            $data['vMachineName'] = $dataD['vMachineName']; 
            $data['vDescription'] = $dataD['vDescription'];  

            $data['vFormatOutput'] = $dataD['vFormatOutput']; 
            $data['iIndexStart'] = $dataD['iIndexStart']; 
            $data['iIndexFinish'] = $dataD['iIndexFinish']; 

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
        redirect('Machine');
    }


   
}