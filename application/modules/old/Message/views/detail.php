<div class="panel panel-default">
 

  <div class="panel-body">
 

<form method="post" action="" class="form-horizontal"> 
 

  <div class="form-group">
    <label for="vName" class="col-sm-3 control-label">From</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="vName" name="vName" required="required" placeholder="" value="<?php echo $vName ?>"> 
    </div>
  </div>


  <div class="form-group">
    <label for="subject" class="col-sm-3 control-label">Subject</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="subject" name="subject" required="required" placeholder="" value="<?php echo $subject ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="created_at" class="col-sm-3 control-label">Time</label>
    <div class="col-sm-8">
      <input type="text" readonly class="form-control" id="created_at" name="created_at" required="required" placeholder="" value="<?php echo $created_at ?>">
    </div>
  </div>

  <div class="form-group">
    <label for="message" class="col-sm-3 control-label">Message</label>
    <div class="col-sm-8">
       <textarea disabled class="form-control" rows="5" id="message" name="message" placeholder="Description"><?php echo nl2br($message) ?></textarea>
    </div>
  </div>

  
</form>
</div> 
 