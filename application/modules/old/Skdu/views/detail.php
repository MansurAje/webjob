<div class="panel panel-primary">
  <div class="panel-heading"> 
    <h3>SKDU Form</h3>
  </div>
  <div class="panel-body">
  <?php if($this->session->flashdata('success')){?>
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        <?php echo $this->session->flashdata('success') ?>
    </div>
  <?php }?>
  <?php if($this->session->flashdata('error')){?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $this->session->flashdata('error') ?>
    </div>
  <?php }?>

<form method="post" action="<?php echo $action ?>" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iSkdu" value="<?php echo $iSkdu ?>" name="iSkdu" readonly="readonly" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cSkduCode" class="col-sm-2 control-label">SKDU Code </label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control" id="cSkduCode" name="cSkduCode" readonly="readonly" placeholder="Skdu Code" value="<?php echo $cSkduCode ?>">
      Auto Number
    </div>
  </div>

  <div class="form-group">
    <label for="vSkduNo" class="col-sm-2 control-label">SKDU No</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vSkduNo" readonly="readonly" name="vSkduNo" placeholder="SKDU No" value="<?php echo $vSkduNo ?>" autofocus>
    </div>
  </div>
  
  <div class="form-group">
    <label for="dTglBuat" class="col-sm-2 control-label">Tanggal Pembuatan SKDU</label>
    <div class="col-sm-4">
      <input type="text" class="form-control datepicker" id="dTglBuat" name="dTglBuat" readonly="readonly" placeholder="Tanggal Pembuatan SKDU" value="<?php echo $dTglBuat ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vPengNama" class="col-sm-2 control-label">Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vPengNama" name="vPengNama" readonly="readonly" placeholder="Nama Pengusaha" value="<?php echo $vPengNama ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vPengNik" class="col-sm-2 control-label">NIK</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vPengNik" name="vPengNik" readonly="readonly" placeholder="NIK Pengusaha" value="<?php echo $vPengNik ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vPengNik" class="col-sm-2 control-label">Tempat / Tgl Lahir</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="vPengTempat" name="vPengTempat" readonly="readonly" placeholder="Tempat Lahir" value="<?php echo $vPengTempat ?>" >
    </div>
    <div class="col-sm-4">
      <input type="text" class="form-control datepicker" id="dPengLahir" name="dPengLahir" readonly="readonly" placeholder="Tanggal Lahir" value="<?php echo $dPengLahir ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vPengKerja" class="col-sm-2 control-label">Pekerjaan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vPengKerja" name="vPengKerja" readonly="readonly" placeholder="Pekerjaan" value="<?php echo $vPengKerja ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vPengAlamat" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="vPengAlamat" name="vPengAlamat" readonly="readonly" placeholder="Alamat Pengusaha" ><?php echo nl2br($vPengAlamat) ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="vUsName" class="col-sm-2 control-label">Nama Usaha</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vUsName" name="vUsName" readonly="readonly" placeholder="Nama Usaha" value="<?php echo $vUsName ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vUsJenis" class="col-sm-2 control-label">Jenis Usaha</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vUsJenis" name="vUsJenis" readonly="readonly" placeholder="Jenis Usaha" value="<?php echo $vUsJenis ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vUsBentuk" class="col-sm-2 control-label">Bentuk Usaha</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vUsBentuk" name="vUsBentuk" readonly="readonly" placeholder="Bentuk Usaha" value="<?php echo $vUsBentuk ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vUsAlamat" class="col-sm-2 control-label">Alamat</label>
    <div class="col-sm-8">
      <textarea class="form-control" id="vUsAlamat" name="vUsAlamat" readonly="readonly" placeholder="Alamat Usaha" ><?php echo nl2br($vUsAlamat) ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="iUsKaryawan" class="col-sm-2 control-label">Jumlah Karyawan</label>
    <div class="col-sm-2">
      <input type="text" class="form-control numeric" id="iUsKaryawan" name="iUsKaryawan" readonly="readonly" placeholder="Jumlah Karyawan" value="<?php echo $iUsKaryawan ?>" >
    </div>
  </div>


  <div class="form-group">
    <label for="vRefDari" class="col-sm-2 control-label">Diterima Dari</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vRefDari" name="vRefDari" readonly="readonly" placeholder="Diterima Dari" value="<?php echo $vRefDari ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="vRefNo" class="col-sm-2 control-label">Referensi No</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vRefNo" name="vRefNo" readonly="readonly" placeholder="Referensi No" value="<?php echo $vRefNo ?>" >
    </div>
  </div>

  <div class="form-group">
    <label for="iPejabat" class="col-sm-2 control-label">TTD Pejabat</label>
    <div class="col-sm-8">
        <?php 
            $sql = "select * from m_pejabat a where a.lDeleted=0  and a.iPejabat='".$iPejabat."' ";
            $v = $this->db->query($sql)->row_array();
            echo $v['cNip'].' - '.$v['vPejabatName'];
         ?>
    </div>
  </div>


</form>
</div> 

