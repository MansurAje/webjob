<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Group Menu</h3>
  </div> 
  <div class="panel-body"> 

<form method="post" action="" class="form-horizontal">
  <div class="form-group">
    <label for="cGroupMenuCode" class="col-sm-3 control-label">Group Menu Code </label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" id="cGroupMenuCode" name="cGroupMenuCode" required="required" placeholder="Group Menu Code" value="<?php echo $cGroupMenuCode ?>">
      
    </div>
  </div>

  <div class="form-group">
    <label for="vGroupMenuName" class="col-sm-3 control-label">Group Menu Name</label>
    <div class="col-sm-4">
      <input type="text" readonly class="form-control" id="vGroupMenuName" name="vGroupMenuName" required="required" placeholder="Group Menu Name" value="<?php echo $vGroupMenuName ?>" autofocus>
    </div>
  </div>

  <div class="form-group">
    <label for="iJenis" class="col-sm-3 control-label">Menu Type</label>
    <div class="col-sm-4">
        <?php 
            $lmarketing = array(''=>'Select One',1=>'Master Data', 2=>'Transaction');
         ?>
        <input type="text" readonly class="form-control" id="vGroupMenuName" name="vGroupMenuName" required="required" placeholder="Group Menu Name" value="<?php echo $lmarketing[$iJenis] ?>" autofocus>

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
