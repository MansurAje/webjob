<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Core extends MX_Controller {
    
    
    function __construct()
    {
        parent::__construct();
	   //$this->load->config('jm_url');
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('core_model',"model");
    }
    
    // ------------------------- get all
    function get_all($tbl,$database,$order_by = 'id desc',$limit = NULL,$offset = NULL)
    {
        $query = $this->model->get_all($tbl,$database,$order_by,$limit,$offset);
        return $query;
    }
    function get_all_pagination($tbl,$database,$per_page,$segment,$url)
    {
        $query = $this->model->get_all_pagination($tbl,$database,$per_page,$segment,$url);
        return $query;
    }
        
    // ------------------------- get where
    function get_where($tbl,$database,$array,$limit = NULL,$offset = NULL)
    {
        $query = $this->model->get_where($tbl,$database,$array,$limit,$offset);
        return $query;
    } 
    function get_wheres($tbl,$database,$array,$limit = NULL,$offset = NULL)
    {
        $query = $this->model->get_wheres($tbl,$database,$array,$limit,$offset);
        return $query;
    }
    
    // ------------------------- get where join
    function getJoin($tbl1,$tbl2,$join_by,$database,$array)
    {
        $query = $this->model->getJoin($tbl1,$tbl2,$join_by,$database,$array);
        return $query;
    }

    function getJoins($tbl1,$tbl2,$tbl3,$join_by,$join_bys,$database,$array)
    {
        $query = $this->model->getJoins($tbl1,$tbl2,$tbl3,$join_by,$join_bys,$database,$array);
        return $query;
    }

    function hitungNrr($tbl1,$tbl2,$tbl3,$tbl4,$join_by,$join_bys,$join_byes,$database,$array)
    {
        $query = $this->model->hitungNrr($tbl1,$tbl2,$tbl3,$tbl4,$join_by,$join_bys,$join_byes,$database,$array);
        return $query;   
    }

    function getWhere($tbl,$database,$array)
    {
        $query = $this->model->getWhere($tbl,$database,$array);
        return $query;
    }

    function getAll($tbl,$database)
    {
        $query = $this->model->getAll($tbl,$database);
        return $query;
    }
    
    function dataExist($nama_tbl,$kolom_unik,$nilai_unik)
    {
        $query = $this->model->dataExist($nama_tbl,$kolom_unik,$nilai_unik);
        return $query;
    }

    function insert($tbl,$database,$arr)
    {
        $this->model->insert($tbl,$database,$arr);
    }
    
    function update($tbl,$database,$arr,$id)
    {
        $this->model->update($tbl,$database,$arr,$id);
    }
     function update_where($tbl,$database,$arr,$where,$value)
    {
	    $this->model->update_where($tbl,$database,$arr,$where,$value);
    }
    
    function delete($tbl,$database,$param,$id)
    {
        $this->model->delete($tbl,$database,$param,$id);
    }
    
    // HELPER
    function rupiah($angka){
    $angka= number_format($angka, 0, ".","."); 
    return $angka;
    }
    
    function voucher($nilai)
    { 
	 $voucher = 
	    substr($nilai,0,4) . ' - ' . 
	    substr($nilai,4,4) . ' - ' . 
	    substr($nilai,8,4). ' - ' . 
	    substr($nilai,12,4). ' - ' . 
	    substr($nilai,16,4). ' - ' . 
	    substr($nilai,20,4);
        
        
	return $voucher;
    }

    function generateMax($tbl,$database,$id)
    {
        $query = $this->model->generateMax($tbl,$database,$id);
        return $query;
    }

    function generateID($tbl,$database,$id_unsur,$offset)
    {
        $query = $this->model->generateID($tbl,$database,$id_unsur,$offset);
        return $query;
    }
 
    function getMax($tbl,$database,$email)
    {
        $query = $this->model->getMax($tbl,$database,$email);
        return $query;
    }

    function manualQuery($q,$database)
    {
        $query = $this->model->manualQuery($q,$database);
        return $query;
    }
}