<?php
class Auth { 	
	  private $_ci;
    private $sess_auth;
    function __construct() {
        $this->_ci=&get_instance();
        $sess_auth = $this->_ci->session->userdata();

    }

    function user() {
      
      $sql = 'select a.* 
                from prv_user_data a 
                join hrd.employee b on b.cNip=a.cNip
                where a.cNip="'.$this->_ci->session->userdata('cNip').'" 
                and a.lDeleted = 0
              ';

      $data = $this->_ci->db->query($sql)->row_array();

      return $data;
	  }

    function checkAcl($controller,$cekmodul){
      $dt = array();
      $sql = 'SELECT td.`iRead`,td.`iUpdate`,td.`iCreate`, td.`iDelete` FROM `t_privilege` tp 
          JOIN `t_privilege_detail` td ON tp.`iPrivilege` = td.`iPrivilege`
          JOIN `m_menu` m ON m.`iMenu` = td.`iMenu`
          WHERE tp.`lDeleted` = 0 AND td.`lDeleted` = 0 AND m.`lDeleted` = 0 AND
          td.`iRead` = 1 AND m.`vController` = "'.$controller.'" AND tp.`iGroupUser` = "'.$cekmodul.'"';
      $cek = $this->_ci->db->query($sql)->row_array();
      if(empty($cek['iRead']) or $cek['iRead']==0){
        return $dt;
      }else{
        return $cek;
      }
      
    }
  
	
}
