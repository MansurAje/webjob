<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Operator extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Operator';
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

 

        $this->table = 'm_operator';
        $this->pk ='iOperator';
        
              
        //$this->load->model('Operator_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_operator a 
                join hrd.employee e on a.cNip = e.cNip where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 
        
        $this->front_page('list',$data);
    }
    function listemployee(){
        $term = $this->input->get('term');  
        $data = array();
        $sql = "SELECT a.cNip,a.vName,a.vNickName  
            FROM hrd.employee AS a WHERE 
            (a.dresign='0000-00-00' OR a.dresign>'".date('Y-m-d H:i:s')."') AND
            (a.cNip LIKE '%".$term."%' OR a.vName LIKE '%".$term."%') limit 50"; 
        $que = $this->db->query($sql)->result_array();
        if(!empty($que)){
            foreach ($que as $line) { 
                $row['id']        = trim($line['cNip']);
                $row['value']     = trim($line['cNip']).' - '.trim($line['vName']);
                $row['vNickName']    = trim($line['vNickName']);  
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;   
 
    }
    function create(){

        
        $data['action'] = site_url('Operator/create_action');
        $data['url_auto'] = site_url('Operator/listemployee');
        $data['cOperatorCode'] = set_value('cOperatorCode'); 
        $data['cNip'] = set_value('cNip'); 
        $data['vName'] = set_value('vName'); 
        
        $data['vOperatorName'] = set_value('vOperatorName'); 
        $data['iOperator'] = set_value('iOperator'); 
        $data['vDescription'] = set_value('vDescription');  
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Operator';  
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cOperatorCode  = $this->input->post('cOperatorCode',TRUE);
        $vOperatorName  = $this->input->post('vOperatorName',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $cNip      = $this->input->post('cNip',TRUE);

        $data['cOperatorCode'] = $cOperatorCode;
        $data['vOperatorName'] = $vOperatorName;
        $data['vDescription'] = $vDescription; 
        $data['cNip'] = $cNip;
        $data['dCreate'] = date('Y-m-d H:i:s');
        
        // validasi duplicate input
        $sqCek = 'select * from m_operator a where a.cOperatorCode="'.$cOperatorCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Operator/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Operator'); 
        }



    }
    function after_insert_process($last_id){ 
        /*auto number*/
        $nomor = "OP".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_operator SET cOperatorCode = '".$nomor."' WHERE iOperator=$last_id LIMIT 1";
        $query = $this->db->query( $sql ); 
    }

    function update($id){

        $sql='SELECT a.*, e.`vName` FROM m_operator a JOIN hrd.employee e ON e.cNip = a.cNip WHERE a.lDeleted=0 AND a.iOperator="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Operator');            
        }else{
            $data['iOperator'] = $dataD['iOperator']; 
            $data['cOperatorCode'] = $dataD['cOperatorCode'];  
            $data['cNip'] = $dataD['cNip']; 
            $data['vName'] = $dataD['cNip'].' - '.$dataD['vName']; 
            $data['vOperatorName'] = $dataD['vOperatorName'];  
            $data['vDescription'] = $dataD['vDescription']; 
            $data['cAction'] = 'update'; 
            $data['cController'] = 'Operator'; 
           
            $data['url_auto'] = site_url('Operator/listemployee');
            $data['action'] = site_url('Operator/update_action');
            $this->front_page('form',$data);

        }
 
    }

    function update_action(){
        $cOperatorCode  = $this->input->post('cOperatorCode',TRUE);
        $vOperatorName  = $this->input->post('vOperatorName');
        $cNip      = $this->input->post('cNip',TRUE);
        $vDescription      = $this->input->post('vDescription',TRUE); 
        $iOperator  = $this->input->post('iOperator',TRUE);

        
        //$data['iOperator'] = $dataD['iOperator']; 
        $data['cOperatorCode'] = $cOperatorCode; 
        $data['cNip'] = $cNip; 
        $data['vDescription'] = $vDescription;  
        $data['dupdate'] = date('Y-m-d H:i:s');

        // validasi duplicate input
        $sqCek = 'select * from m_operator a where a.cOperatorCode="'.$cOperatorCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_operator a where a.lDeleted=0 and a.iOperator="'.$iOperator.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vOperatorName==""){
            $data['vOperatorName'] = trim($dataD['vOperatorName']);
        }else{
            $data['vOperatorName'] = $vOperatorName;
        }

        $uniq_key = $dataD['cOperatorCode'];
        $uniq_input = $cOperatorCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Operator/update/'.$iOperator);

        }else{
            $this->db->where($this->pk, $iOperator);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Operator');

        }
    }

    function detail(){

        $sql='SELECT a.*, e.`vName` FROM m_operator a JOIN hrd.employee e 
            ON e.cNip = a.cNip WHERE a.lDeleted=0 AND a.iOperator="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iOperator'] = '-'; 
            $data['cOperatorCode'] = '-'; 
            $data['cNip'] = '-'; 
            $data['vName'] = '-'; 
            $data['vOperatorName'] = '-'; 
            $data['vDescription'] = '-'; 
        }else{
            $data['iOperator'] = $dataD['iOperator']; 
            $data['cOperatorCode'] = $dataD['cOperatorCode'];  
            $data['cNip'] = $dataD['cNip']; 
            $data['vName'] = $dataD['cNip'].' - '.$dataD['vName']; 
            $data['vOperatorName'] = $dataD['vOperatorName'];  
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
        redirect('Operator');
    }


   
}