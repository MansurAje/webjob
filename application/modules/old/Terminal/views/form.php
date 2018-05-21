<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Terminal Form</h3>
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
  <input id="iTerminal" value="<?php echo $iTerminal ?>" name="iTerminal" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cTerminalCode" class="col-sm-2 control-label">Terminal Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cTerminalCode2" name="cTerminalCode2" required="required" placeholder="Terminal Code" value="<?php echo $cTerminalCode ?>">
      <input type="hidden" class="form-control" id="cTerminalCode" name="cTerminalCode" required="required" placeholder="Terminal Code" value="<?php echo $cTerminalCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vTerminalName" class="col-sm-2 control-label">Terminal Nama</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vTerminalName" name="vTerminalName" required="required" placeholder="Terminal Nama" value="<?php echo $vTerminalName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="vIpAddress" class="col-sm-2 control-label">Ip Address</label>
    <div class="col-sm-8"> 
      <textarea class="form-control" rows="5" id="vIpAddress" name="vIpAddress" placeholder="IP Address"><?php echo nl2br($vIpAddress) ?></textarea>
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
 