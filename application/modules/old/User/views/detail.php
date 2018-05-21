<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>User</h3>
  </div> 
  <div class="panel-body"> 

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iPrv_user_data" value="<?php echo $iPrv_user_data ?>" name="iPrv_user_data" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="vUsername" class="col-sm-3 control-label">Username </label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vUsername" name="vUsername" required="required" placeholder="Machine Code" value="<?php echo $vUsername ?>">

    </div>
  </div>

  <div class="form-group">
    <label for="cNip" class="col-sm-3 control-label">NIP</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="cNip" name="cNip" required="required" placeholder="Machine Name" value="<?php echo $cNip ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vName" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vName" name="vName" required="required" placeholder="Machine Name" value="<?php echo $vName ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vGroupUserName" class="col-sm-3 control-label">Group</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vGroupUserName" name="vGroupUserName" required="required" placeholder="Machine Name" value="<?php echo $vGroupUserName ?>">
    </div>
  </div>


  
   
</form>
</div> 
