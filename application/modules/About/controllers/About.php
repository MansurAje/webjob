<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {
	function __construct()
    {
        parent::__construct();

    }


	function index(){
		$data['judul']='ini Judul';
		$this->front_page('about_us',$data);

		//$this->front_page('test',$data);
	}

}
