<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Group User Form</h3>
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
  <input id="iGroupUser" value="<?php echo $iGroupUser ?>" name="iGroupUser" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cGroupUserCode" class="col-sm-2 control-label">Group User Code </label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control" id="cGroupUserCode" name="cGroupUserCode" required="required" placeholder="Group User Code" value="<?php echo $cGroupUserCode ?>">
      Auto Number
    </div>
  </div>

  <div class="form-group">
    <label for="vGroupUserName" class="col-sm-2 control-label">Group User Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vGroupUserName" name="vGroupUserName" required="required" placeholder="Group User Name" value="<?php echo $vGroupUserName ?>" autofocus>
    </div>
  </div>

  <!-- <div class="form-group">
    <label for="iJenis" class="col-sm-2 control-label">Menu Type</label>
    <div class="col-sm-8">
      
        <?php 
            $lmarketing = array(''=>'Select One',1=>'Master Data', 2=>'Transaction');
            $o  = "<select name='iJenis' id='iJenis' class='form-control' required='required' >";            
            foreach($lmarketing as $k=>$v) {
                if ($k == $iJenis) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$k."'>".$v."</option>";
            }            
            $o .= "</select>";

            echo $o;
         ?>
    </div>
  </div> -->


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