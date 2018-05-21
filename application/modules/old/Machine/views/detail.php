<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Machine</h3>
  </div> 
  <div class="panel-body"> 

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iMachine" value="<?php echo $iMachine ?>" name="iMachine" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cMachineCode" class="col-sm-3 control-label">Machine Code </label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="cMachineCode" name="cMachineCode" required="required" placeholder="Machine Code" value="<?php echo $cMachineCode ?>">

    </div>
  </div>

  <div class="form-group">
    <label for="vMachineName" class="col-sm-3 control-label">Machine Name</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vMachineName" name="vMachineName" required="required" placeholder="Machine Name" value="<?php echo $vMachineName ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vFormatOutput" class="col-sm-3 control-label">Ouput Format</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vFormatOutput" name="vFormatOutput" required="required" placeholder="Ouput Format" value="<?php echo $vFormatOutput ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="iIndexStart" class="col-sm-3 control-label">Index Start</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="iIndexStart" name="iIndexStart" required="required" placeholder="Index Start" value="<?php echo $iIndexStart ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vSatuan" class="col-sm-3 control-label">Satuan</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vSatuan" name="vSatuan" required="required" placeholder="Satuan" value="<?php echo $vSatuan ?>">
    </div>
  </div>

  

  <div class="form-group">
    <label for="iIndexFinish" class="col-sm-3 control-label">Total Character</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="iIndexFinish" name="iIndexFinish" required="required" placeholder="Total Character" value="<?php echo $iIndexFinish ?>">
    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-8">
      <!-- <input type="password" class="form-control" id="vDescription" name="vDescription" required="required" placeholder="Password"> -->
      <textarea disabled class="form-control" rows="5" id="vDescription" name="vDescription" placeholder="Description"><?php echo nl2br($vDescription) ?></textarea>
    </div>
  </div>
   
</form>
</div> 
