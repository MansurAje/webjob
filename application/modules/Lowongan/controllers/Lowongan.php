<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends MY_Controller {
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
		$this->front_page('lowongan',$data);

		//$this->front_page('test',$data);
	}



	


}
