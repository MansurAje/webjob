<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Skdu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->user = $this->auth->user();  
        $this->modul   = 'Skdu';
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

 
        $this->table = 'm_machine';
        $this->pk ='iMachine';

        $this->table = 't_skdu';
        $this->pk ='iSkdu';
        
        if(!$this->session->userdata('loggedin'))
        {   
            redirect('login');
        }

        //$this->load->model('menu_model','model');
    }
    
    function index()
    {
        $sql = 'select a.*,b.vPejabatName
                from t_skdu a 
                join m_pejabat b on a.iPejabat=b.iPejabat
                where a.lDeleted=0
                and b.lDeleted=0
                order by a.iSkdu DESC ';
        $datas = $this->db->query($sql)->result_array();
        $data['lists'] = $datas;
        $data['akses']= $this->acl; 

        $this->front_page('list',$data);
    }

    function create(){
        /*
            Data formulir   
            cSkduCode   
            dPenglahir  1991-12-21
            iPejabat    13
            iSkdu   
            iUsKaryawan 1000
            send    
            vPengAlamat Jl+Muchtar+Raya+No+110
            vPengKerja  Karyawan+Swasta
            vPengNama   Mansur
            vPengNik    3209152112910001
            vPengTempat Cirebon
            vRefDari    Kecamatan+Pinang
            vRefNo  111-22-33
            vSkduNo 111
            vUsAlamat   Jl+Muchtar+Raya+No+111
            vUsBentuk   Perseroan+Terbatas
            vUsJenis    Perdagangan
            vUsName PT+Hiro+Sejahtera

        */

        
        $data['action'] = site_url('Skdu/create_action');
        $data['iSkdu'] = set_value('iSkdu'); 
        $data['cAction'] = 'insert'; 
        $data['cController'] = 'Skdu'; 

        
        $data['cSkduCode'] = set_value('cSkduCode'); 
        $data['dPenglahir'] = set_value('dPenglahir'); 
        $data['iPejabat'] = set_value('iPejabat'); 
        $data['iSkdu'] = set_value('iSkdu'); 
        $data['iUsKaryawan'] = set_value('iUsKaryawan'); 
        $data['vPengAlamat'] = set_value('vPengAlamat'); 
        $data['vPengKerja'] = set_value('vPengKerja'); 
        $data['vPengNama'] = set_value('vPengNama'); 
        $data['vPengNik'] = set_value('vPengNik'); 

        $data['vRefDari'] = set_value('vRefDari'); 
        $data['vRefNo'] = set_value('vRefNo'); 

        $data['vSkduNo'] = set_value('vSkduNo'); 
        $data['vUsAlamat'] = set_value('vUsAlamat'); 
        $data['vUsBentuk'] = set_value('vUsBentuk'); 
        $data['vUsJenis'] = set_value('vUsJenis'); 
        $data['vUsName'] = set_value('vUsName'); 
        
        $data['vController'] = set_value('vController'); 

        $data['dTglBuat'] = set_value('dTglBuat'); 
        $data['dTglExpired'] = set_value('dTglExpired'); 
        
        
        
        
        
        
        
        $this->front_page('form',$data);


    }

    function create_action(){
        /*
            Data formulir   
            cSkduCode   
            dPenglahir  1991-12-21
            iPejabat    13
            iSkdu   
            iUsKaryawan 1000
            send    
            vPengAlamat Jl+Muchtar+Raya+No+110
            vPengKerja  Karyawan+Swasta
            vPengNama   Mansur
            vPengNik    3209152112910001
            vPengTempat Cirebon
            vRefDari    Kecamatan+Pinang
            vRefNo  111-22-33
            vSkduNo 111
            vUsAlamat   Jl+Muchtar+Raya+No+111
            vUsBentuk   Perseroan+Terbatas
            vUsJenis    Perdagangan
            vUsName PT+Hiro+Sejahtera

        */
        $cSkduCode  = $this->input->post('cSkduCode',TRUE);
        $dPenglahir  = $this->input->post('dPenglahir',TRUE);
        $iPejabat      = $this->input->post('iPejabat',TRUE);
        $iSkdu      = $this->input->post('iSkdu',TRUE);
        $iUsKaryawan      = $this->input->post('iUsKaryawan',TRUE);

        $vPengAlamat      = $this->input->post('vPengAlamat',TRUE);
        $vPengKerja      = $this->input->post('vPengKerja',TRUE);
        $vPengNama      = $this->input->post('vPengNama',TRUE);
        $vPengNik      = $this->input->post('vPengNik',TRUE);
        $vPengTempat      = $this->input->post('vPengTempat',TRUE);
        $vPengTempat      = $this->input->post('dPengLahir',TRUE);
        
        $vRefDari      = $this->input->post('vRefDari',TRUE);
        $vRefNo      = $this->input->post('vRefNo',TRUE);

        $vSkduNo      = $this->input->post('vSkduNo',TRUE);
        $vUsAlamat      = $this->input->post('vUsAlamat',TRUE);
        $vUsBentuk      = $this->input->post('vUsBentuk',TRUE);
        $vUsJenis      = $this->input->post('vUsJenis',TRUE);
        $vUsName      = $this->input->post('vUsName',TRUE);

        $dTglBuat      = $this->input->post('dTglBuat',TRUE);
        $dTglExpired = date('Y-m-d', strtotime('+1 years', strtotime($dTglBuat))); // durasi sampai 5 tahun

        

        $data['cSkduCode'] = $cSkduCode;
        $data['dPenglahir'] = $dPenglahir;
        $data['iPejabat'] = $iPejabat;
        $data['iSkdu'] = $iSkdu;
        $data['iUsKaryawan'] = $iUsKaryawan;
        
        $data['vPengAlamat'] = $vPengAlamat;
        $data['vPengKerja'] = $vPengKerja;
        $data['vPengNama'] = $vPengNama;
        $data['vPengNik'] = $vPengNik;
        $data['vPengTempat'] = $vPengTempat;
        $data['dPengLahir'] = $vPengLahir;
        
        $data['vRefDari'] = $vRefDari;
        $data['vRefNo'] = $vRefNo;

        $data['vSkduNo'] = $vSkduNo;
        $data['vUsAlamat'] = $vUsAlamat;
        $data['vUsBentuk'] = $vUsBentuk;
        $data['vUsJenis'] = $vUsJenis;
        $data['vUsName'] = $vUsName;

        $data['dCreate'] = date('Y-m-d H:i:s');
        $data['cCreated'] = $this->user['cNip'];

        $data['dTglBuat'] = $dTglBuat; 
        $data['dTglExpired'] = $dTglExpired; 

        
        // validasi duplicate input
        $sqCek = 'select * from t_skdu a where a.vSkduNo="'.$vSkduNo.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        if ($dCek >0) {
            $this->session->set_flashdata('error','Failed to save, (Duplicate Data)');
            redirect('Skdu/create');
        }else{
            
            $this->db->insert($this->table, $data);

            $last_id=$this->db->insert_id();
            $this->after_insert_process($last_id);

            $this->session->set_flashdata('success','Data saved successfully');
            redirect('Skdu'); 
        }



    }
    function after_insert_process($last_id){

        /*auto number*/
        $nomor = "SKDU".str_pad($last_id, 5, "0", STR_PAD_LEFT);
        $sql = "UPDATE t_skdu SET cSkduCode = '".$nomor."' WHERE iSkdu=$last_id LIMIT 1";
        $query = $this->db->query( $sql );


    }

    function update($id){

        $sql='select * from t_skdu a where a.lDeleted=0 and a.iSkdu="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        //print_r($dataD);
        if (empty($dataD)) {
            $this->session->set_flashdata('message', 'Record not found');
            redirect('Skdu');            
        }else{
            $data['iSkdu'] = $dataD['iSkdu']; 
            $data['cSkduCode'] = $dataD['cSkduCode'] ;
            
            $data['dPengLahir'] = $dataD['dPengLahir'];
            $data['iPejabat'] = $dataD['iPejabat'];
            $data['iSkdu'] = $dataD['iSkdu'];
            $data['iUsKaryawan'] = $dataD['iUsKaryawan'];
            
            $data['vPengAlamat'] = $dataD['vPengAlamat'];
            $data['vPengKerja'] = $dataD['vPengKerja'];
            $data['vPengNama'] = $dataD['vPengNama'];
            $data['vPengNik'] = $dataD['vPengNik'];
            $data['vPengTempat'] = $dataD['vPengTempat'];
            $data['dPengLahir'] = $dataD['dPengLahir'];
            
            
            $data['vRefDari'] = $dataD['vRefDari'];
            $data['vRefNo'] = $dataD['vRefNo'];

            $data['vSkduNo'] = $dataD['vSkduNo'];
            $data['vUsAlamat'] = $dataD['vUsAlamat'];
            $data['vUsBentuk'] = $dataD['vUsBentuk'];
            $data['vUsJenis'] = $dataD['vUsJenis'];
            $data['vUsName'] = $dataD['vUsName'];

            

            $data['dTglBuat'] = $dataD['dTglBuat'];; 
            

            

            $data['cAction'] = 'update'; 
            $data['cController'] = 'Skdu'; 

            $data['action'] = site_url('Skdu/update_action');
            $this->front_page('form',$data);

        }

    
    }

    function update_action(){
        $iSkdu  = $this->input->post('iSkdu',TRUE);
        $cSkduCode  = $this->input->post('cSkduCode',TRUE);
        $dPenglahir  = $this->input->post('dPenglahir',TRUE);
        $iPejabat      = $this->input->post('iPejabat',TRUE);
        $iUsKaryawan      = $this->input->post('iUsKaryawan',TRUE);

        $vPengAlamat      = $this->input->post('vPengAlamat',TRUE);
        $vPengKerja      = $this->input->post('vPengKerja',TRUE);
        $vPengNama      = $this->input->post('vPengNama',TRUE);
        $vPengNik      = $this->input->post('vPengNik',TRUE);
        $vPengTempat      = $this->input->post('vPengTempat',TRUE);
        $dPengLahir      = $this->input->post('dPengLahir',TRUE);
        
        $vRefDari      = $this->input->post('vRefDari',TRUE);
        $vRefNo      = $this->input->post('vRefNo',TRUE);

        $vSkduNo      = $this->input->post('vSkduNo',TRUE);
        $vUsAlamat      = $this->input->post('vUsAlamat',TRUE);
        $vUsBentuk      = $this->input->post('vUsBentuk',TRUE);
        $vUsJenis      = $this->input->post('vUsJenis',TRUE);
        $vUsName      = $this->input->post('vUsName',TRUE);

        $dTglBuat      = $this->input->post('dTglBuat',TRUE);
        $dTglExpired = date('Y-m-d', strtotime('+5 years', strtotime($dTglBuat))); // durasi sampai 5 tahun

        

        $data['cSkduCode'] = $cSkduCode;
        $data['dPenglahir'] = $dPenglahir;
        $data['iPejabat'] = $iPejabat;
        $data['iSkdu'] = $iSkdu;
        $data['iUsKaryawan'] = $iUsKaryawan;
        
        $data['vPengAlamat'] = $vPengAlamat;
        $data['vPengKerja'] = $vPengKerja;
        $data['vPengNama'] = $vPengNama;
        $data['vPengNik'] = $vPengNik;
        $data['vPengTempat'] = $vPengTempat;
        $data['dPengLahir'] = $dPengLahir;
        
        $data['vRefDari'] = $vRefDari;
        $data['vRefNo'] = $vRefNo;

        $data['vSkduNo'] = $vSkduNo;
        $data['vUsAlamat'] = $vUsAlamat;
        $data['vUsBentuk'] = $vUsBentuk;
        $data['vUsJenis'] = $vUsJenis;
        $data['vUsName'] = $vUsName;

        $dTglBuat      = $this->input->post('dTglBuat',TRUE);
        $dTglExpired = date('Y-m-d', strtotime('+1 years', strtotime($dTglBuat))); // durasi sampai 5 tahun
        $data['dTglBuat'] = $dTglBuat; 
        $data['dTglExpired'] = $dTglExpired; 

        
        $data['dUpdate'] = date('Y-m-d H:i:s');
        $data['cUpdate'] = $this->user['cNip'];


        
        

        // validasi duplicate input
        $sqCek = 'select * from t_skdu a where a.vSkduNo="'.$vSkduNo.'" ';
        $dCek =  $this->db->query($sqCek)->num_rows();

        //old data
        $sql='select * from t_skdu a where a.lDeleted=0 and a.iSkdu="'.$iSkdu.'" ';
        $dataD = $this->db->query($sql)->row_array();        

        

        $uniq_key = $dataD['vSkduNo'];
        $uniq_input = $vSkduNo;

        if ( ($dCek >0) and ($uniq_key<>$uniq_input)  ) {
            $this->session->set_flashdata('error', 'Failed to save, (Duplicate Data)');
            redirect('Skdu/update/'.$iSkdu);

        }else{
            $this->db->where($this->pk, $iSkdu);
            $this->db->update($this->table, $data);
            $this->session->set_flashdata('success', 'Data saved successfully');
            redirect('Skdu');

        }
    }

    /*public function indexx()
    {
        $data = [];
        //load the view and saved it into $html variable
        $html=$this->load->view('test', $data, true);
        //$html= $this->load->view('403',$data,true); 

        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";

        //load mPDF library
        $this->load->library('m_pdf');

       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");       
    }*/

    function tanggal_indo($tanggal)
    {
        $bulan = array (1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    }





    function cetak($id){

        
        $sql='select * 
                from t_skdu a 
                join m_pejabat b on b.iPejabat=a.iPejabat
                where a.lDeleted=0 
                and a.iSkdu="'.$id.'" ';
        $dataD = $this->db->query($sql)->row_array();

        $data['terbilang'] = $this->terbilang($dataD['iUsKaryawan']);
        $data['dataD'] = $dataD;
        $data['controller']=$this; 
        //load the view and saved it into $html variable
        $html=$this->load->view('v_cetak', $data, true);
        //$html= $this->load->view('403',$data,true); 

        //this the the PDF filename that user will get to download
        $pdfFilePath = "SKDU_".$dataD['cSkduCode'].".pdf";

        //load mPDF library
        $this->load->library('m_pdf');

       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);

        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");       

    }

        
    function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->kekata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
    }     
        return $temp;
}


function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim($this->kekata($x));
    } else {
        $hasil = trim($this->kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}


    function detail(){

        
        $sql='select * 
                from t_skdu a 
                join m_pejabat b on b.iPejabat=a.iPejabat
                where a.lDeleted=0 
                and a.iSkdu="'.$this->input->post('id').'" ';
        $dataD = $this->db->query($sql)->row_array();

        if (empty($dataD)) {
            $data['iSkdu'] = '-'; 
            $data['cSkduCode'] ='-'; 
            
            $data['dPengLahir'] ='-'; 
            $data['iPejabat'] ='-'; 
            $data['iSkdu'] ='-'; 
            $data['iUsKaryawan'] ='-'; 
            
            $data['vPengAlamat'] ='-'; 
            $data['vPengKerja'] ='-'; 
            $data['vPengNama'] ='-'; 
            $data['vPengNik'] ='-'; 
            $data['vPengTempat'] ='-'; 
            $data['dPengLahir'] ='-'; 
            
            
            $data['vRefDari'] ='-'; 
            $data['vRefNo'] ='-'; 

            $data['vSkduNo'] ='-'; 
            $data['vUsAlamat'] ='-'; 
            $data['vUsBentuk'] ='-'; 
            $data['vUsJenis'] ='-'; 
            $data['vUsName'] ='-'; 

            $data['dTglBuat'] ='-'; 
        }else{
            $data['iSkdu'] = $dataD['iSkdu']; 
            $data['cSkduCode'] = $dataD['cSkduCode'] ;
            
            $data['dPengLahir'] = $dataD['dPengLahir'];
            $data['iPejabat'] = $dataD['iPejabat'];
            $data['iSkdu'] = $dataD['iSkdu'];
            $data['iUsKaryawan'] = $dataD['iUsKaryawan'];
            
            $data['vPengAlamat'] = $dataD['vPengAlamat'];
            $data['vPengKerja'] = $dataD['vPengKerja'];
            $data['vPengNama'] = $dataD['vPengNama'];
            $data['vPengNik'] = $dataD['vPengNik'];
            $data['vPengTempat'] = $dataD['vPengTempat'];
            $data['dPengLahir'] = $dataD['dPengLahir'];
            
            
            $data['vRefDari'] = $dataD['vRefDari'];
            $data['vRefNo'] = $dataD['vRefNo'];

            $data['vSkduNo'] = $dataD['vSkduNo'];
            $data['vUsAlamat'] = $dataD['vUsAlamat'];
            $data['vUsBentuk'] = $dataD['vUsBentuk'];
            $data['vUsJenis'] = $dataD['vUsJenis'];
            $data['vUsName'] = $dataD['vUsName'];

            

            $data['dTglBuat'] = $dataD['dTglBuat'];; 
        }

        $dt = $this->load->view('detail',$data, TRUE);
        echo $dt; 

    }


    function delete($id)
    {
        $this->db->where($this->pk, $id);
        $data = array('lDeleted'=>1);
        $this->db->update($this->table,$data);
        
        $this->session->set_flashdata('success', 'Data deleted successfully');
        redirect('Skdu');
    }


   
}