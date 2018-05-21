<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Shift Form</h3>
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
  <input id="iShift" value="<?php echo $iShift ?>" name="iShift" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cShiftCode" class="col-sm-2 control-label">Shift Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cShiftCode2" name="cShiftCode2" required="required" placeholder="Shift Code" value="<?php echo $cShiftCode ?>">
      <input type="hidden" class="form-control" id="cShiftCode" name="cShiftCode" required="required" placeholder="Shift Code" value="<?php echo $cShiftCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vShiftName" class="col-sm-2 control-label">Shift Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vShiftName" name="vShiftName" required="required" placeholder="Shift Nama" value="<?php echo $vShiftName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8"> 
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
 