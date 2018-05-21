<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Machine Form</h3>
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
  <input id="iMachine" value="<?php echo $iMachine ?>" name="iMachine" required="required" type="hidden">
  <!-- hidden panel -->
  <div class="form-group">
    <label for="iJenis_proses" class="col-sm-2 control-label">Process</label>
    <div class="col-sm-8">
      <?php 
        if($cAction != 'insert'){

      ?>
        <div class="col-sm-8 "><?php echo $vNama_proses ?></div>
        <input id="iJenis_proses" value="<?php echo $iJenis_proses ?>" name="iJenis_proses" required="required" type="hidden">

      <?php 
        }else{
            
            $sql = "select * from m_jenis_proses a where a.lDeleted=0";
            $teams = $this->db->query($sql)->result_array();
            $o  = "<select name='iJenis_proses' id='iJenis_proses' class='form-control pros' required='required' >";            
            $o .= "<option  value=''>Select one</option>";
            foreach($teams as $v) {
                if ($v['iJenis_proses'] == $iJenis_proses) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$v['iJenis_proses']."'>".$v['vNama_proses']."</option>";
            }            
            $o .= "</select>";

            echo $o;
        }
      ?>

       
    </div>
  </div>

  <div class="form-group">
    <label for="cMachineCode" class="col-sm-2 control-label">Machine Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cMachineCode2" name="cMachineCode2" required="required" placeholder="Machine Code" value="<?php echo $cMachineCode ?>">
      <input type="hidden" class="form-control" id="cMachineCode" name="cMachineCode" required="required" placeholder="Machine Code" value="<?php echo $cMachineCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vMachineName" class="col-sm-2 control-label">Machine Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vMachineName" name="vMachineName" required="required" placeholder="Machine Name" value="<?php echo $vMachineName ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vFormatOutput" class="col-sm-2 control-label">Ouput Format</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vFormatOutput" name="vFormatOutput" required="required" placeholder="Ouput Format" value="<?php echo $vFormatOutput ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="iIndexStart" class="col-sm-2 control-label">Index Start</label>
    <div class="col-sm-8">
      <input type="text" class="form-control angka2" id="iIndexStart" name="iIndexStart" required="required" placeholder="Index Start" value="<?php echo $iIndexStart ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="iIndexFinish" class="col-sm-2 control-label">Total Character</label>
    <div class="col-sm-8">
      <input type="text" class="form-control angka2" id="iIndexFinish" name="iIndexFinish" required="required" placeholder="Total Character" value="<?php echo $iIndexFinish ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vSatuan" class="col-sm-2 control-label">Satuan</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vSatuan" name="vSatuan" required="required" placeholder="Satuan" value="<?php echo $vSatuan ?>">
    </div>
  </div>
 
  <div class="form-group">
    <label for="vDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8">
      <!-- <input type="password" class="form-control" id="vDescription" name="vDescription" required="required" placeholder="Password"> -->
      <textarea class="form-control" rows="5" id="vDescription" name="vDescription" placeholder="Description"><?php echo nl2br($vDescription) ?></textarea>
    </div>
  </div>
  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button id="send" name="send" type="submit" class="btn btn-primary">Save</button>
      <a href="<?php echo base_url().$cController.'/'?>"><button type="button" class="btn btn-danger">Back</button></a>
    </div>
  </div>
</form>
</div> 

<script type="text/javascript">
$(".angka2").keyup(function(){
    this.value = this.value.replace(/[^0-9\.]/g,"");
  })
$(".angka2").css('text-align','right'); 
 
 </script>