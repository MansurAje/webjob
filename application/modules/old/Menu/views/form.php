<div class="panel panel-primary">
  <div class="panel-heading"> 
    <h3>Menu Form</h3>
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
  <input id="iMenu" value="<?php echo $iMenu ?>" name="iMenu" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cMenuCode" class="col-sm-2 control-label">Menu Code </label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control" id="cMenuCode" name="cMenuCode" required="required" placeholder="Menu Code" value="<?php echo $cMenuCode ?>">
      Auto Number
    </div>
  </div>

  <div class="form-group">
    <label for="iGroupMenu" class="col-sm-2 control-label">Group Menu</label>
    <div class="col-sm-8">
        <?php 
            $sql = "select * from nps.m_groupmenu a where a.lDeleted=0 ";
            $teams = $this->db->query($sql)->result_array();
            $o  = "<select name='iGroupMenu' id='iGroupMenu' class='form-control' required='required' >";            
            $o .= "<option  value=''>Select one</option>";
            foreach($teams as $v) {
                if ($v['iGroupMenu'] == $iGroupMenu) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$v['iGroupMenu']."'>".$v['vGroupMenuName']."</option>";
            }            
            $o .= "</select>";

            echo $o;
         ?>
    </div>
  </div>


  <div class="form-group">
    <label for="vMenuName" class="col-sm-2 control-label">Menu Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vMenuName" name="vMenuName" required="required" placeholder="Menu Name" value="<?php echo $vMenuName ?>" autofocus>
    </div>
  </div>

  <div class="form-group">
    <label for="vController" class="col-sm-2 control-label">Controller Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vController" name="vController" required="required" placeholder="Controller Name" value="<?php echo $vController ?>">
    </div>
  </div>

    <div class="form-group">
      <label for="iNeedLogin" class="col-sm-2 control-label">Need Authentication</label>
      <div class="col-sm-8">
        
          <?php 
              $lmarketing = array(''=>'Select One',1=>'Yes', 0=>'No');
              $o  = "<select name='iNeedLogin' id='iNeedLogin' class='form-control' required='required' >";            
              foreach($lmarketing as $k=>$v) {
                  if ($k == $iNeedLogin) $selected = " selected";
                  else $selected = "";
                  $o .= "<option {$selected} value='".$k."'>".$v."</option>";
              }            
              $o .= "</select>";

              echo $o;
           ?>
      </div>
    </div>



  


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
