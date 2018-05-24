<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class apply extends MY_Controller {
	function __construct()
    {
        parent::__construct();

    }


	function index(){
		$data['judul']='ini Judul';
		$this->front_page('apply',$data);

		//$this->front_page('test',$data);
	}

}
