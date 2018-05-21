<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pejabat extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Pejabat';
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

 

        $this->table = 'm_pejabat';
        $this->pk ='iPejabat';
        
              
        //$this->load->model('Pejabat_model','model');
    }
    
    function index()
    {
        $sql = 'select * from m_pejabat a 
                where a.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 
        
        $this->front_page('list',$data);
    }
    /*function listemployee(){
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
 
    }*/
    function create(){

        
        $data['action'] = site_url('Pejabat/create_action');
        $data['url_auto'] = site_url('Pejabat/listemployee');
        $data['cPejabatCode'] = set_value('cPejabatCode'); 
        $data['cNip'] = set_value('cNip'); 
        $data['vName'] = set_value('vName'); 
        
        $data['vPejabatName'] = set_value('vPejabatName'); 
        $data['iPejabat'] = set_value('iPejabat'); 
        $data['vDescription'] = set_value('vDescription');  
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Pejabat';  
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $cPejabatCode  = $this->input->post('cPejabatCode',TRUE);
        $vPejabatName  = $this->input->post('vPejabatName',TRUE);
        $vDescription  = $this->input->post('vDescription',TRUE);
        $cNip      = $this->input->post('cNip',TRUE);

        $data['cPejabatCode'] = $cPejabatCode;
        $data['vPejabatName'] = $vPejabatName;
        $data['vDescription'] = $vDescription; 
        $data['cNip'] = $cNip;
        $data['dCreate'] = date('Y-m-d H:i:s');
        
        // validasi duplicate input
        $sqCek = 'select * from m_pejabat a where a.cPejabatCode="'.$cPejabatCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Pejabat/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Pejabat'); 
        }



    }
    function after_insert_process($last_id){ 
        /*auto number*/
        $nomor = "OP".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE m_pejabat SET cPejabatCode = '".$nomor."' WHERE iPejabat=$last_id LIMIT 1";
        $query = $this->db->query( $sql ); 
    }

    function update($id){

        $sql='SELECT a.* FROM m_pejabat a where a.lDeleted=0 AND a.iPejabat="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Pejabat');            
        }else{
            $data['iPejabat'] = $dataD['iPejabat']; 
            $data['cPejabatCode'] = $dataD['cPejabatCode'];  
            $data['cNip'] = $dataD['cNip']; 
            $data['vName'] = $dataD['cNip'].' - '.$dataD['vName']; 
            $data['vPejabatName'] = $dataD['vPejabatName'];  
            $data['vDescription'] = $dataD['vDescription']; 
            $data['cAction'] = 'update'; 
            $data['cController'] = 'Pejabat'; 
           
            $data['url_auto'] = site_url('Pejabat/listemployee');
            $data['action'] = site_url('Pejabat/update_action');
            $this->front_page('form',$data);

        }
 
    }

    function update_action(){
        $cPejabatCode  = $this->input->post('cPejabatCode',TRUE);
        $vPejabatName  = $this->input->post('vPejabatName');
        $cNip      = $this->input->post('cNip',TRUE);
        $vDescription      = $this->input->post('vDescription',TRUE); 
        $iPejabat  = $this->input->post('iPejabat',TRUE);

        
        //$data['iPejabat'] = $dataD['iPejabat']; 
        $data['cPejabatCode'] = $cPejabatCode; 
        $data['cNip'] = $cNip; 
        $data['vDescription'] = $vDescription;  
        $data['dupdate'] = date('Y-m-d H:i:s');

        // validasi duplicate input
        $sqCek = 'select * from m_pejabat a where a.cPejabatCode="'.$cPejabatCode.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from m_pejabat a where a.lDeleted=0 and a.iPejabat="'.$iPejabat.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vPejabatName==""){
            $data['vPejabatName'] = trim($dataD['vPejabatName']);
        }else{
            $data['vPejabatName'] = $vPejabatName;
        }

        $uniq_key = $dataD['cPejabatCode'];
        $uniq_input = $cPejabatCode;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Pejabat/update/'.$iPejabat);

        }else{
            $this->db->where($this->pk, $iPejabat);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Pejabat');

        }
    }

    function detail(){

        $sql='SELECT a.*
            #, e.`vName` 
            FROM m_pejabat a 
            #JOIN hrd.employee e ON e.cNip = a.cNip 
            WHERE a.lDeleted=0 AND a.iPejabat="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iPejabat'] = '-'; 
            $data['cPejabatCode'] = '-'; 
            $data['cNip'] = '-'; 
            $data['vName'] = '-'; 
            $data['vPejabatName'] = '-'; 
            $data['vDescription'] = '-'; 
        }else{
            $data['iPejabat'] = $dataD['iPejabat']; 
            $data['cPejabatCode'] = $dataD['cPejabatCode'];  
            $data['cNip'] = $dataD['cNip']; 
            $data['vName'] = $dataD['cNip']; 
            $data['vPejabatName'] = $dataD['vPejabatName'];  
            $data['vDescription'] = $dataD['vDescription'];  
        }

        $dt = $this->load->view('detail',$data, TRUE);
        echo $dt; 

    }


    function delete($id)
    {   
        $cNip =$this->user['cNip'] ;
        $now = date('Y-m-d H:i:s');
        $this->db->where($this->pk, $id);
        $data = array('lDeleted'=>1,'cUpdate'=>$cNip,'dupdate'=>$now);
        $this->db->update($this->table,$data);
        
        $this->session->set_flashdata('success', 'Data deleted successfully');
        redirect('Pejabat');
    }


   
}