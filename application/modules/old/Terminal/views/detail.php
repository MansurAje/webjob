<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Terminal</h3>
  </div> 

  <div class="panel-body">
 

  <form method="post" action="" class="form-horizontal">
    <!-- hidden panel -->
    <input id="iTerminal" value="<?php echo $iTerminal ?>" name="iTerminal" required="required" type="hidden">
    <!-- hidden panel -->

    <div class="form-group">
      <label for="cTerminalCode" class="col-sm-3 control-label">Terminal Code </label>
      <div class="col-sm-8">
        <input disabled type="text" class="form-control" id="cTerminalCode2" name="cTerminalCode2" required="required" placeholder="Terminal Code" value="<?php echo $cTerminalCode ?>">
        <input readonly type="hidden" class="form-control" id="cTerminalCode" name="cTerminalCode" required="required" placeholder="Terminal Code" value="<?php echo $cTerminalCode ?>">
      </div>
    </div>

    <div class="form-group">
      <label for="vTerminalName" class="col-sm-3 control-label">Terminal Nama</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control" id="vTerminalName" name="vTerminalName" required="required" placeholder="Terminal Nama" value="<?php echo $vTerminalName ?>"> 
      </div>
    </div>


    <div class="form-group">
      <label for="vIpAddress" class="col-sm-3 control-label">Ip Address</label>
      <div class="col-sm-8"> 
        <textarea class="form-control" readonly rows="5" id="vIpAddress" name="vIpAddress" placeholder="IP Address"><?php echo nl2br($vIpAddress) ?></textarea>
      </div>
    </div>
     
  </form>
  </div> 
 