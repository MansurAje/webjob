<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Operator </h3>
  </div> 
  <br>
   <div class="panel-body">

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iOperator" value="<?php echo $iOperator ?>" name="iOperator" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cOperatorCode" class="col-sm-3 control-label">Operator Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cOperatorCode2" name="cOperatorCode2" required="required" placeholder="Operator Code" value="<?php echo $cOperatorCode ?>">
      <input readonly type="hidden" class="form-control" id="cOperatorCode" name="cOperatorCode" required="required" placeholder="Operator Code" value="<?php echo $cOperatorCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="cNip" class="col-sm-3 control-label">NIP</label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control cNip" id="cNip" name="cNip" required="required" placeholder="NIP" value="<?php echo $cNip ?>"> 
      <input readonly type="text" class="form-control cNip2" autofocus="true" id="cNip2" name="cNip2" required="required" placeholder="NIP" value="<?php echo $vName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="vOperatorName" class="col-sm-3 control-label">Nick Name</label>
    <div class="col-sm-8">
      <input readonly type="text" class="form-control vOperatorName" id="vOperatorName" name="vOperatorName" required="required" placeholder="Operator Name" value="<?php echo $vOperatorName ?>">
    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-3 control-label">Description</label>
    <div class="col-sm-8"> 
      <textarea disabled class="form-control" rows="5" id="vDescription" name="vDescription" placeholder="Description"><?php echo nl2br($vDescription) ?></textarea>
    </div>
  </div>
  
 
</form>
</div> 


 