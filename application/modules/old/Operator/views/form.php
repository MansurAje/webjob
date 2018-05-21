<div class="panel panel-primary">
  <div class="panel-heading">
    <h3>Operator Form</h3>
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
  <input id="iOperator" value="<?php echo $iOperator ?>" name="iOperator" required="required" type="hidden">
  <!-- hidden panel -->

  <div class="form-group">
    <label for="cOperatorCode" class="col-sm-2 control-label">Operator Code </label>
    <div class="col-sm-8">
      <input disabled type="text" class="form-control" id="cOperatorCode2" name="cOperatorCode2" required="required" placeholder="Operator Code" value="<?php echo $cOperatorCode ?>">
      <input type="hidden" class="form-control" id="cOperatorCode" name="cOperatorCode" required="required" placeholder="Operator Code" value="<?php echo $cOperatorCode ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="cNip" class="col-sm-2 control-label">NIP</label>
    <div class="col-sm-8">
      <input type="hidden" class="form-control cNip" id="cNip" name="cNip" required="required" placeholder="NIP" value="<?php echo $cNip ?>"> 
      <input type="text" class="form-control cNip2" autofocus="true" id="cNip2" name="cNip2" required="required" placeholder="NIP" value="<?php echo $vName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="vOperatorName" class="col-sm-2 control-label">Nick Name</label>
    <div class="col-sm-8">
      <input type="text" class="form-control vOperatorName" id="vOperatorName" name="vOperatorName" required="required" placeholder="Operator Name" value="<?php echo $vOperatorName ?>">
    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8"> 
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


<script type="text/javascript">

  $('.cNip2').keyup(function(e) { 
      var config = {
          source: '<?php echo $url_auto ?>',                    
          select: function(event, ui){
              $('.cNip').val(ui.item.id);
              $('.cNip2').val(ui.item.value);
              $('.vOperatorName').val(ui.item.vNickName);   
              return false;                           
          },
          minLength: 2,
          autoFocus: true,
          }; 
      $('.cNip2').autocomplete(config);  
      $(this).keypress(function(e){
          if(e.which != 13 ) {
              if(e.which != 9 ) {
               $('#cNip').val('');
              }
          }           
      });
      $(this).blur(function(){
          if($('.cNip').val() == '') {
              $(this).val('');
          }           
      }); 
  });  
 
</script>

 
 