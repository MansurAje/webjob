<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>User Form</h3>
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
  <input id="iPrv_user_data" value="<?php echo $iPrv_user_data ?>" name="iPrv_user_data" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="vUsername" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vUsername" name="vUsername" required="required" placeholder="Username" value="<?php echo $vUsername ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="cNip" class="col-sm-2 control-label">NIP</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="cNip" name="cNip" required="required" placeholder="NIP" value="<?php echo $cNip ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="vName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="vName" name="vName" required="required" placeholder="Name" value="<?php echo $vName ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="iGroupUser" class="col-sm-2 control-label">Group User</label>
    <div class="col-sm-8">
        <?php 
            $sql = "select * from nps.m_groupuser a where a.lDeleted=0 ";
            $teams = $this->db->query($sql)->result_array();
            $o  = "<select name='iGroupUser' id='iGroupUser' class='form-control' required='required' >";            
            $o .= "<option  value=''>Select one</option>";
            foreach($teams as $v) {
                if ($v['iGroupUser'] == $iGroupUser) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$v['iGroupUser']."'>".$v['vGroupUserName']."</option>";
            }            
            $o .= "</select>";

            echo $o;
         ?>
    </div>
  </div>




  <div class="form-group">
    <label for="vPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" id="vPassword" name="vPassword" required="required" placeholder="Password">
    </div>
  </div>
  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button id="send" name="send" type="submit" class="btn btn-primary">Save</button>
      <a href="<?php echo base_url()?>/User/"><button type="button" class="btn btn-danger">Back</button></a>
    </div>
  </div>
</form>
</div> 


<script type="text/javascript">

  $('#cNip').keyup(function(e) { 
      var config = {
          source: '<?php echo $url_auto ?>',                    
          select: function(event, ui){
              $('#cNip').val(ui.item.id);
              $('#cNip2').val(ui.item.value);
              $('#vName').val(ui.item.vName);   
              return false;                           
          },
          minLength: 2,
          autoFocus: true,
          }; 
      $('#cNip').autocomplete(config);  
    
      $(this).blur(function(){
          if($('#cNip').val() == '') {
              $(this).val('');
          }           
      }); 
  });  
 
</script>
