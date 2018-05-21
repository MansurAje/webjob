<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends MY_Controller {
	function __construct()
    {
        parent::__construct();
        /*$this->load->library('auth');
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }*/
       
    }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	

	function index(){
		$data['judul']='ini Judul';
		$this->front_page('beranda',$data);

		//$this->front_page('test',$data);
	}



	/*function logVisit(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
	    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	    $remote  = $_SERVER['REMOTE_ADDR'];

	    if(filter_var($client, FILTER_VALIDATE_IP))
	    {
	        $ip = $client;
	    }
	    elseif(filter_var($forward, FILTER_VALIDATE_IP))
	    {
	        $ip = $forward;
	    }
	    else
	    {
	        $ip = $remote;
	    }

	    $sql_cek = "select * from visit_counter a where a.ip = '".$ip."' and a.short_date = '".date('Y-m-d')."'";
	    $dCek = $this->db->query($sql_cek)->row_array();

	    if (empty($dCek)) {
	    	// insert counter
	    	$sql_i = "INSERT INTO `visit_counter` (ip,short_date,long_date,coun) VALUES('".$ip."','".date('Y-m-d')."','".date('Y-m-d H:i:s')."','1')";
	    	$this->db->query($sql_i);	
	    }
	    

	}*/


}
