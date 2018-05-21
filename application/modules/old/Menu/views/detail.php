<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Menu</h3>
  </div> 
  <div class="panel-body"> 

<form method="post" action="" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iMenu" value="<?php echo $iMenu ?>" name="iMenu" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="vMenuName" class="col-sm-3 control-label">Menu Name </label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vMenuName" name="vMenuName" required="required" placeholder="Machine Code" value="<?php echo $vMenuName ?>">

    </div>
  </div>

  <div class="form-group">
    <label for="vController" class="col-sm-3 control-label">Controller</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vController" name="vController" required="required" placeholder="Machine Name" value="<?php echo $vController ?>">
    </div>
  </div>



  <div class="form-group">
    <label for="vGroupMenuName" class="col-sm-3 control-label">Group</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vGroupMenuName" name="vGroupMenuName" required="required" placeholder="Machine Name" value="<?php echo $vGroupMenuName ?>">
    </div>
  </div>

    <div class="form-group">
      <label for="iNeedLogin" class="col-sm-3 control-label">Need Authentication</label>
      <div class="col-sm-4">
          <?php 
              $lmarketing = array(''=>'Select One',1=>'Yes', 0=>'No');
           ?>
          <input type="text" readonly class="form-control" id="vGroupMenuName" name="vGroupMenuName" required="required" placeholder="Group Menu Name" value="<?php echo $lmarketing[$iNeedLogin] ?>" autofocus>

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
