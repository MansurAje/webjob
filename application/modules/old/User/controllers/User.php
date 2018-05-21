<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'User';
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

 

        $this->table = 'prv_user_data';
        $this->pk ='iPrv_user_data';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }

        //$this->load->model('user_model','model');
    }
    
    function index()
    {
        $sql = 'select * 
                    from prv_user_data a 
                    join m_groupuser b on b.iGroupUser=a.iGroupUser
                    where a.lDeleted=0
                    and b.lDeleted=0
                    ';
        //echo $sql;
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
                $row['vName']    = trim(ucwords(strtolower($line['vName'])));  
                array_push($data, $row);
            }
        } 
                    
        echo json_encode($data);
        exit;   
 
    }*/


    function create(){

        $data['cAction'] = 'insert'; 
        $data['cController'] = 'User'; 
        $data['action'] = site_url('User/create_action');
        $data['vUsername'] = set_value('vUsername'); 
        $data['vName'] = set_value('vName'); 
        $data['cNip'] = set_value('cNip'); 
        $data['iGroupUser'] = set_value('iGroupUser'); 

        
        
        $data['url_auto'] = site_url('User/listemployee');

        $data['iPrv_user_data'] = set_value('iPrv_user_data'); 
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $vUsername  = $this->input->post('vUsername',TRUE);
        $vPassword  = $this->input->post('vPassword',TRUE);
        $vName      = $this->input->post('vName',TRUE);
        $cNip      = $this->input->post('cNip',TRUE);
        $iGroupUser      = $this->input->post('iGroupUser',TRUE);

        
        

        $data['vUsername'] = $vUsername;
        $data['vPassword'] = sha1(md5(trim($vPassword)));
        $data['vName'] = $vName;
        $data['cNip'] = $cNip;
        $data['iGroupUser'] = $iGroupUser;

        
        
        // validasi duplicate input
        $sqCek = 'select * from prv_user_data a where a.vUsername="'.$vUsername.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('User/create');
        }else{
            
            $this->db->insert($this->table, $data);
            $this->session->set_flashdata('success','Data saved successfully');
            redirect('User'); 
        }



    }

    function update($id){

        $sql='select * from prv_user_data a where a.lDeleted=0 and a.iPrv_user_data="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('User');            
        }else{
            $data['cAction'] = 'update'; 
            $data['cController'] = 'User';
            $data['iPrv_user_data'] = $dataD['iPrv_user_data']; 
            $data['vUsername'] = $dataD['vUsername']; 
            $data['vName'] = $dataD['vName']; 
            $data['cNip'] = $dataD['cNip']; 
            $data['iGroupUser'] = $dataD['iGroupUser']; 
            
            $data['url_auto'] = site_url('User/listemployee');

            $data['action'] = site_url('User/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $vUsername  = $this->input->post('vUsername',TRUE);
        $cNip  = $this->input->post('cNip',TRUE);
        $vPassword  = $this->input->post('vPassword');
        $vName      = $this->input->post('vName',TRUE);
        $iPrv_user_data  = $this->input->post('iPrv_user_data',TRUE);
        $iGroupUser  = $this->input->post('iGroupUser',TRUE);

        
        //$data['iPrv_user_data'] = $dataD['iPrv_user_data']; 
        $data['vUsername'] = $vUsername; 
        $data['vName'] = $vName; 
        $data['cNip'] = $cNip; 
        $data['iGroupUser'] = $iGroupUser; 

        

        
        // validasi duplicate input
        $sqCek = 'select * from prv_user_data a where a.vUsername="'.$vUsername.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from prv_user_data a where a.lDeleted=0 and a.iPrv_user_data="'.$iPrv_user_data.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vPassword==""){
            $data['vPassword'] = trim($dataD['vPassword']);
        }else{
            $data['vPassword'] = sha1(md5(trim($vPassword)));
        }

        $uniq_key = $dataD['vUsername'];
        $uniq_input = $vUsername;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('User/update/'.$iPrv_user_data);

        }else{
            $this->db->where($this->pk, $iPrv_user_data);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('User');

        }
    }

    function detail(){

        
        $sql='select * 
                from prv_user_data a 
                join m_groupuser b on b.iGroupUser=a.iGroupUser
                where a.lDeleted=0 
                and a.iPrv_user_data="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iPrv_user_data'] = '-'; 
            $data['vUsername'] = '-'; 
            $data['cNip'] = '-'; 
            $data['vName'] = '-'; 
            $data['vGroupUserName'] = '-'; 
        }else{
            $data['iPrv_user_data'] = $dataD['iPrv_user_data']; 
            $data['vUsername'] = $dataD['vUsername']; 
            $data['cNip'] = $dataD['cNip']; 
            $data['vName'] = $dataD['vName'];  
            $data['vGroupUserName'] = $dataD['vGroupUserName'];  
        }

        $dt = $this->load->view('detail',$data, TRUE);
        echo $dt; 

    }

    /*function detail(){

        $detail = $this->db->select('*')->from($this->table)->where($this->pk,$this->input->post('id'))->get()->row();

        if($detail){

            //$this->db->where($this->pk,$this->input->post('id'))->update('message',array('read_status'=>1));

            $arr['name'] = $detail->name;
            $arr['email'] = $detail->email;
            $arr['subject'] = $detail->subject;
            $arr['message'] = $detail->message;
            $arr['created_at'] = $detail->created_at;
            //$arr['update_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
           // $arr['success'] = true;

        } else {

           // $arr['success'] = false;
        }

        
        
        //echo json_encode($arr);
        echo "ulala";

    }*/


    function delete($id)
    {
        $this->db->where($this->pk, $id);
        $data = array('lDeleted'=>1);
        $this->db->update($this->table,$data);
        
        $this->session->set_flashdata('success', 'Data deleted successfully');
        redirect('User');
    }


   
}