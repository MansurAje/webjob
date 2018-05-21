<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login_model','model');

       


    }
  
    public function index()
    {        
        if(!$this->session->userdata('loggedin'))
        {   
          //  redirect('Login');
        }else{
            redirect('Home');
        }

        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('<p class="text-danger text-center">*', '</p>');
        $this->form_validation->set_rules('username_vUsername', 'Username', 'required|xss_clean|trim|htmlspecialchars');
        $this->form_validation->set_rules('vPasswords', 'vPassword', 'required|xss_clean|trim|htmlspecialchars');
            
        if ($this->form_validation->run() == FALSE)
	    {
            //$data['sub_unit'] = $this->model->get_sub_unit("sub_unit");  
            $data['judul'] = 'judul';  
            $this->load->view('content',$data);
	    }
        else{   
        
            if($this->check_login() == TRUE){
                // echo "<script>alert('login berhasil')</script>";
                //$this->home();
                redirect('/Home');
            }
            else{
              $this->session->set_flashdata('login_error','error message');
              redirect('Login');
            }
        }    
    }

    public function proses(){

        if($this->check_login() == TRUE){
            // echo "<script>alert('login berhasil')</script>";
            //$this->home();
            redirect('/Home');
        }
        else{
          $this->session->set_flashdata('login_error','error message');
          redirect('Login');
        }


    }

    
    

    public function check_login()
    {
		$vUsername    = $this->input->post('username_vUsername');
        $vPassword = $this->input->post('passwords');
		//$vPassword_encrypt = sha1(md5(trim($vPassword)));
        $vPassword_encrypt = sha1(md5(trim($vPassword))) ;  

        /*echo $vUsername;
        echo $vPassword_encrypt ;
        echo "kesini";
        exit;*/
        
        $query = $this->model->check_login($vUsername,$vPassword_encrypt);
        if( $query->num_rows() > 0 )
        {
		    $row = $query->row(1);
		    $data = array(
		      'vUsername'           => $row->vUsername,
		      'vName'        => $row->vName,
              'cNip'        => $row->cNip,
              'loggedin'        => 1,
              'iGroupUser'        => $row->iGroupUser,
		    );
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function logout()
    {
	if($this->session->userdata('vUsername') != '')
	{
	    $this->session->sess_destroy();
	    redirect('/Home');
	}
	else
	    redirect('/Home');
    }
}