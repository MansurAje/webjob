<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Group User</h3>
  </div> 
  <div class="panel-body"> 

<form method="post" action="" class="form-horizontal">
  <div class="form-group">
    <label for="cGroupUserCode" class="col-sm-3 control-label">Group User Code </label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" id="cGroupUserCode" name="cGroupUserCode" required="required" placeholder="Group Menu Code" value="<?php echo $cGroupUserCode ?>">
      
    </div>
  </div>

  <div class="form-group">
    <label for="vGroupUserName" class="col-sm-3 control-label">Group User Name</label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" id="vGroupUserName" name="vGroupUserName" required="required" placeholder="Group Menu Name" value="<?php echo $vGroupUserName ?>" autofocus>
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
