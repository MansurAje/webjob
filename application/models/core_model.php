<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Core_model extends CI_model
{
    function __construct()
    {
        parent::__construct();
        
    }
    
    // ################ GET ALL ###########################3
    function get_all($tbl,$database,$order_by,$limit,$offset)
    {
	$db = $this->load->database($database,TRUE);
        $db->order_by($order_by);
        $query = $db->get($tbl,$limit,$offset);
        return $query;
    }
    
    function get_all_pagination($tbl,$database,$per_page,$segment,$url)
    {
	$db = $this->load->database($database,TRUE);
            $this->load->library('pagination');
            $config['base_url']   = base_url().$url;
            $config['total_rows'] = $db->count_all($tbl);
            $config['per_page']   = $per_page;
            $config['uri_segment'] = $segment;
            $config['full_tag_open'] = '<div class="pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['prev_link'] = '<i class="fa fa-angle-left"></i> Previous';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next <i class="fa fa-angle-right"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['first_link'] = '<i class="fa fa-angle-double-left"></i> First';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last <i class="fa fa-angle-double-right"></i>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';   
            $this->pagination->initialize($config);
            $db->order_by("id", "asc");
            $query = $db->get($tbl,$config['per_page'],$this->uri->segment($segment));
            return $query; 
    }
     
     // ########################### GET WHERE #############################3
    function get_where($tbl,$database,$array,$limit,$offset)
    {
    $db = $this->load->database($database,TRUE);
        $db->order_by("id_unsur","desc");
        $query = $db->get_where($tbl,$array,$limit,$offset);
        return $query;
    }
    
    function get_wheres($tbl,$database,$array,$limit,$offset)
    {
	$db = $this->load->database($database,TRUE);
        $db->order_by("id","desc");
        $query = $db->get_where($tbl,$array,$limit,$offset);
        return $query;
    }

    function getWhere($tbl,$database,$array)
    {
        $db = $this->load->database($database,TRUE);
        // $db->order_by("id","desc");
        $query = $db->get_where($tbl,$array);
        return $query;
    }
            
    function delete($tbl,$database,$param,$id)
    {
	$db = $this->load->database($database,TRUE);
        $db->where($param, $id);
        $db->delete($tbl);
    }
    
  function getJoin($tbl1,$tbl2,$join_by,$database,$array)
    {
    $db = $this->load->database($database,TRUE);
        $db->select('*');
        $db->from($tbl1);
        $db->join($tbl2, $join_by);
        $where = $array;
        $db->where($where);
        $query = $db->get();
        return $query;
    }

  function hitungNrr($tbl1,$tbl2,$tbl3,$tbl4,$join_by,$join_bys,$join_byes,$database,$array)
    {
    $db = $this->load->database($database,TRUE);
        $db->select('u.id_unsur, u.nama_unsur, SUM(d.skor) as skor, COUNT(type) AS type');
        $db->from($tbl1);
        $db->join($tbl2, $join_by);
        $db->join($tbl3, $join_bys);
        $db->join($tbl4, $join_byes);
        $where = $array;
        $db->where($where);
        $db->group_by('d.nomor_soal');
        $query = $db->get();
        return $query;
    }

  function getJoins($tbl1,$tbl2,$tbl3,$join_by,$join_bys,$database,$array)
    {
    $db = $this->load->database($database,TRUE);
        $db->select('*');
        $db->from($tbl1);
        $db->join($tbl2, $join_by);
        $db->join($tbl3, $join_bys);
        $where = $array;
        $db->where($where);
        $query = $db->get();
        return $query;
    }

   function getAll($tbl,$database)
   {
        $db = $this->load->database($database,TRUE);
        $query = $this->db->get($tbl);
        return $query;       
   }

    function insert($tbl,$database,$arr)
    {
	$db = $this->load->database($database,TRUE);
        $data = $arr;
        $db->insert($tbl,$data);        
    }
    
    function dataExist($nama_tbl,$kolom_unik,$nilai_unik)
    {
        $r = $this->db->query("SELECT * FROM $nama_tbl WHERE $kolom_unik = '$nilai_unik'");
        return $r->num_rows() > 0 ? TRUE : FALSE;
    }
    
    function update($tbl,$database,$arr,$id)
    {
    $db = $this->load->database($database,TRUE);
        $data = $arr;
    $db->where('id', $id);
    $db->update($tbl, $data);
    }
    
    function update_where($tbl,$database,$arr,$where,$value)
    {
	$db = $this->load->database($database,TRUE);
        $data = $arr;
	$db->where($where,$value);
	$db->update($tbl, $data);
    }
    
    function get_sum($tbl,$database,$sum)
    {
    $db = $this->load->database($database,TRUE);
    $db->select_sum($sum);
    $query = $db->get($tbl);
    return $query;
    }    

    function generateMax($tbl,$database,$id)
    {
        $db = $this->load->database($database,TRUE);
        $q = $db->query("select MAX($id) as max from $tbl");
        foreach ($q->result() as $key) {
            # code...
            $id_max = $key->max;
        }
        return $id_max;
    }

    function generateID($tbl,$database,$id_unsur,$offset)
    {
        $db = $this->load->database($database,TRUE);
        $q = $db->query("select MAX(RIGHT($id_unsur,$offset)) as kd_max from $tbl");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%02s", $tmp);
            }
        }
        else
        {
            $kd = "U1";
        }   
        return "U".$kd;

    }

    function getMax($tbl,$database,$email)
    {   
        $db = $this->load->database($database,TRUE);
        $query = $db->query("select MAX(id) as id from $tbl where email =  '$email'");
        return $query;
    }

    function manualQuery($q,$database)
    {
        $db = $this->load->database($database,TRUE);
        $query = $db->query($q);
        return $query;
    }
    

}