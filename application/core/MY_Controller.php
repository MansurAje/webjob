<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
    
    function front_page($content, $data = NULL){

        $data['ses_vName'] = $this->session->userdata('vName_id');
        $data['ses_vUsername'] = $this->session->userdata('vUsername');

        $data['header'] = $this->load->view('templates/frontend/header', $data, TRUE);
        $data['css'] = $this->load->view('templates/frontend/css', $data, TRUE);
        $data['isi'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('templates/frontend/footer', $data, TRUE);
        $data['js'] = $this->load->view('templates/frontend/js', $data, TRUE);
        
        $this->load->view('templates/frontend/main', $data);
    }

    function back_page($content, $data = NULL){
        $data['ses_vName'] = $this->session->userdata('vName_id');
        $data['ses_vUsername'] = $this->session->userdata('vUsername');
        
        $data['header'] = $this->load->view('templates/backend/header', $data, TRUE);
        $data['css'] = $this->load->view('templates/backend/css', $data, TRUE);
        $data['isi'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('templates/backend/footer', $data, TRUE);
        $data['js'] = $this->load->view('templates/backend/js', $data, TRUE);
        
        $this->load->view('templates/backend/main', $data);
    }
}