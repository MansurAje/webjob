<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_model
{
    function __construct()
    {
         date_default_timezone_set("Asia/Jakarta");
         parent::__construct();
    }
    
    function check_login($vUsername,$vPassword_encrypt)
    {
        /*$db = $this->load->database('app_core',TRUE);
        $where_vUsername = array('vUsername' => $vUsername, 'vPassword' => $vPassword_encrypt);
        
        $db->where($where_vUsername);
        $query = $db->get('prv_user_data',1);*/

        //$sql = 'select * from prv_user_data a where a.vUsername="'.$vUsername.'" and a.vPassword="'.$vPassword_encrypt.'"  ';
        $sql = 'select a.* 
                from prv_user_data a 
                #join hrd.employee b on b.cNip=a.cNip
                where a.cNip="'.$vUsername.'" and a.vPassword="'.$vPassword_encrypt.'" ';

        $query = $this->db->query($sql);

        /*echo $sql;
        exit;*/
        
        return $query;
    }

    function get_Sub_unit($tbl)
    {
        $db = $this->load->database('app_core',TRUE);
        $query = $this->db->get($tbl);
        return $query;
    }

    function insertData($table,$arr)
    {       
        $query = $this->db->insert($table,$arr);
        return $query;
    }

    function getData($table,$arr)
    {       
        $query = $this->db->get_where($table,$arr);
        return $query;
    }
}