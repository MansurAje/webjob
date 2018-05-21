<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Shift</h3>
  </div> 
<div class="panel-body">
  

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iShift" value="<?php echo $iShift ?>" name="iShift" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cShiftCode" class="col-sm-3 control-label">Shift Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cShiftCode2" name="cShiftCode2" required="required" placeholder="Shift Code" value="<?php echo $cShiftCode ?>">
      <input readonly type="hidden" class="form-control" id="cShiftCode" name="cShiftCode" required="required" placeholder="Shift Code" value="<?php echo $cShiftCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vShiftName" class="col-sm-3 control-label">Shift Nama</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vShiftName" name="vShiftName" required="required" placeholder="Shift Nama" value="<?php echo $vShiftName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-8"> 
      <textarea class="form-control" readonly rows="5" id="vDescription" name="vDescription" placeholder="Description"><?php echo nl2br($vDescription) ?></textarea>
    </div>
  </div>
   
  </div>
</form>
</div> 
 