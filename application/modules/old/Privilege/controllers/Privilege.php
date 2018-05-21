<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Privilege extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Privilege';
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

 

        $this->table = 't_privilege';
        $this->pk ='iPrivilege';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('Login');
        }

        //$this->load->model('Privilege_model','model');
    }
    
    function index()
    {
        $sql = 'select a.*,b.vGroupUserName
                from t_privilege a 
                join m_groupuser b on a.iGroupUser=b.iGroupUser
                where a.lDeleted=0
                and b.lDeleted=0';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){

        
        $data['action'] = site_url('Privilege/create_action');
        $data['vDescription'] = set_value('vDescription'); 
        $data['iGroupUser'] = set_value('iGroupUser'); 
        $data['iPrivilege'] = set_value('iPrivilege'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Privilege'; 
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        $vDescription  = $this->input->post('vDescription',TRUE);
        $iGroupUser      = $this->input->post('iGroupUser',TRUE);

        $data['vDescription'] = $vDescription;
        $data['iGroupUser'] = $iGroupUser;
        

        
        
        // validasi duplicate input
        $sqCek = 'select * from t_privilege a where a.iGroupUser="'.$iGroupUser.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Privilege/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id,$_POST);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Privilege'); 
        }



    }
    
    function after_insert_process($id,$post){

        /*auto number*/
       /* $nomor = "MN".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE t_privilege SET iGroupUser = '".$nomor."' WHERE iPrivilege=$last_id LIMIT 1";
        $query = $this->db->query( $sql );*/

        foreach ($post['iMenu'] as $key => $value) {
            
            $data['iPrivilege']= $id;
            $data['iMenu'] = $value;

            $data['iCreate'] = $post['iCreate'][$value];
            $data['iUpdate'] = $post['iUpdate'][$value];
            $data['iRead'] = $post['iRead'][$value];
            $data['iDelete'] = $post['iDelete'][$value];

            $data['dCreate'] = date('Y-m-d H:i:s');
            $data['cCreated'] = $this->session->userdata('cNip');

            
            $this->db->insert('t_privilege_detail', $data);

        }


    }

    function update($id){

        $sql='select * from t_privilege a where a.lDeleted=0 and a.iPrivilege="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Privilege');            
        }else{
            $data['iPrivilege'] = $dataD['iPrivilege']; 
            $data['vDescription'] = $dataD['vDescription']; 
            $data['iGroupUser'] = $dataD['iGroupUser']; 

            
            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Privilege'; 

            $data['action'] = site_url('Privilege/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $vDescription  = $this->input->post('vDescription');
        $iPrivilege  = $this->input->post('iPrivilege',TRUE);
        $iGroupUser  = $this->input->post('iGroupUser',TRUE);

        
        //$data['iPrivilege'] = $dataD['iPrivilege']; 
        $data['iGroupUser'] = $iGroupUser; 
        
        // validasi duplicate input
        $sqCek = 'select * from t_privilege a where a.iGroupUser="'.$iGroupUser.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from t_privilege a where a.lDeleted=0 and a.iPrivilege="'.$iPrivilege.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        /*jika field password tidak diisi maka, gunakan password lama*/
        if($vDescription==""){
            $data['vDescription'] = trim($dataD['vDescription']);
        }else{
            $data['vDescription'] = $vDescription;
        }

        $uniq_key = $dataD['iGroupUser'];
        $uniq_input = $iGroupUser;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Privilege/update/'.$iPrivilege);

        }else{
            $this->db->where($this->pk, $iPrivilege);
            $this->db->update($this->table, $data);

            $this->after_update_process($iPrivilege,$_POST);

            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Privilege');

        }
    }

    function after_update_process($id,$post){
        
        /*delete auth sebelumnya*/
        //$this->db->where('iPrivilege', $id);
        //$this->db->delete('t_privilege_detail');
        /*delete auth sebelumnya*/

        foreach ($post['iMenu'] as $key => $value) {
            
            $data['iPrivilege']= $id;
            $data['iMenu'] = $value;

            if( isset($post['iCreate'][$value])){
                $iCreate = 1;
            }else{
                $iCreate = 0;
            }

            if( isset($post['iUpdate'][$value])){
                $iUpdate = 1;
            }else{
                $iUpdate = 0;
            }

            if( isset($post['iRead'][$value])){
                $iRead = 1;
            }else{
                $iRead = 0;
            }

            if( isset($post['iDelete'][$value])){
                $iDelete = 1;
            }else{
                $iDelete = 0;
            }

            $data['iCreate'] = $iCreate;
            $data['iUpdate'] = $iUpdate;
            $data['iRead'] = $iRead;
            $data['iDelete'] = $iDelete;

            $data['dupdate'] = date('Y-m-d H:i:s');
            $data['cUpdate'] = $this->session->userdata('cNip');

            $cekexist = 'select * 
                        from t_privilege_detail a 
                        where a.lDeleted=0 
                        and a.iPrivilege="'.$id.'"
                        and a.iMenu="'.$value.'"
                        ';
            $dEx =  $this->db->query($cekexist);

            if($dEx->num_rows() > 0){
                $dDex = $dEx->row_array();
                $this->db->where('iPrivilege_detail',  $dDex['iPrivilege_detail']);
                $this->db->update('t_privilege_detail', $data);

            }else{
                $this->db->insert('t_privilege_detail', $data);    
            }
            

        }
        
        


    }

    function detail(){

        $detail = $this->db->select('*')->from($this->table)->where($this->pk,$this->input->post('id'))->get()->row();

        if($detail){

            //$this->db->where($this->pk,$this->input->post('id'))->update('message',array('read_status'=>1));

            /*$arr['name'] = $detail->name;
            $arr['email'] = $detail->email;
            $arr['subject'] = $detail->subject;
            $arr['message'] = $detail->message;
            $arr['created_at'] = $detail->created_at;*/
            //$arr['update_count_message'] = $this->db->where('read_status',0)->count_all_results('message');
           // $arr['success'] = true;

        } else {

           // $arr['success'] = false;
        }

        
        
        //echo json_encode($arr);
        echo "ulala";

    }


    function delete($id)
    {
        $this->db->where($this->pk, $id);
        $data = array('lDeleted'=>1);
        $this->db->update($this->table,$data);
        
        $this->session->set_flashdata('success', 'Data deleted successfully');
        redirect('Privilege');
    }


   
}