<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'message';
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

  
        $this->table = 'message';
        $this->pk ='id';
        
               
    }


	function index(){ 
        $sql = "SELECT DISTINCT(e.`vName`), m.* , md.`istat` FROM `message` m 
            JOIN hrd.`employee` e ON e.`cNip` = m.`vfrom` 
            JOIN message_detail md ON md.`id` = m.`id`
            WHERE md.`cNip` ='".$this->user['cNip']."'";

        // $sql = "SELECT m.*, e.`vName` FROM `message` m 
        // JOIN hrd.`employee` e ON e.`cNip` = m.`vfrom` WHERE 
        // m.`vfrom` LIKE '%".$this->user['cNip']."%' OR 
        // m.`vto` LIKE '%".$this->user['cNip']."%' OR 
        // m.`vcc` LIKE '%".$this->user['cNip']."%' 
        // ORDER BY m.id DESC  
        // ";

        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;  
		$this->front_page('list',$data); 
	}

    function detail(){
        $squpdate = "UPDATE message m SET m.`read_status` = 1 WHERE m.`id` = '".$this->input->post('id')."'";
        $this->db->query($squpdate);

        $squpdate2 = "UPDATE `message_detail` md SET md.`istat` = 1 WHERE 
            md.`id` = '".$this->input->post('id')."' AND md.`cNip` = '".$this->user['cNip']."'";
        $this->db->query($squpdate2);
         
        $sql='SELECT m.*, e.`vName` FROM `message` m 
                JOIN hrd.`employee` e ON e.`cNip` = m.`vfrom` WHERE  m.id="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['vName'] = '-';   
            $data['subject'] = '-';   
            $data['created_at'] = '-';   
            $data['message'] = '-';              
        }else{
            $data['vName'] = $dataD['vName'];   
            $data['subject'] = $dataD['subject']; 
            $data['created_at'] = $dataD['created_at']; 
            $data['message'] = $dataD['message'];  
        }

        $dt = $this->load->view('detail',$data, TRUE);
        echo $dt;

    }

	 

}