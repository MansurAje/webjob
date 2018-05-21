<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Pejabat </h3>
  </div> 
  <br>
   <div class="panel-body">

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iPejabat" value="<?php echo $iPejabat ?>" name="iPejabat" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cPejabatCode" class="col-sm-3 control-label">Pejabat Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cPejabatCode2" name="cPejabatCode2" required="required" placeholder="Pejabat Code" value="<?php echo $cPejabatCode ?>">
      <input readonly type="hidden" class="form-control" id="cPejabatCode" name="cPejabatCode" required="required" placeholder="Pejabat Code" value="<?php echo $cPejabatCode ?>">
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
    <label for="vPejabatName" class="col-sm-3 control-label">Nick Name</label>
    <div class="col-sm-8">
      <input readonly type="text" class="form-control vPejabatName" id="vPejabatName" name="vPejabatName" required="required" placeholder="Pejabat Name" value="<?php echo $vPejabatName ?>">
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


 