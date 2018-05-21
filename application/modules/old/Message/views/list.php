
<style type="text/css">
  .rttengah{
    text-align: center;
  }
</style>
<div class="panel panel-default">
<div class="panel-heading">
  <h3>Message</h3>
<div>
<hr> 

  <div class="panel-body">
  <!-- Table -->
  <table class="dataTables table table-bordered table-striped table-hover table-responsive">
    <thead>
      <tr>
        <th class="rttengah" style="width:20%;">From</th>
        <th class="rttengah" style="width:40%;">Subject</th>
        <th class="rttengah" style="width:15%;">Time</th>  
        <th class="rttengah" style="width:8%;">Action</th>
        
      </tr>
    </thead>
    <tbody>
          <?php 
              $i=1;
              foreach ($lists as $list ) { 
                $bold1='';
                $bold2='';
                if($list['istat']!=1){$bold1 ='<b>';$bold2 ='</b>';}
                ?>

                  <tr> 
                    <td><?php echo $bold1.$list['vName'].$bold2?></td>
                    <td><?php echo $bold1.$list['subject'].$bold2?></td>
                    <td><?php echo $bold1.$list['created_at'].$bold2?></td> 
                    <td align="center">
                      <div class="btn-group" role="group" aria-label="...">
                        <a style="cursor:pointer" data-toggle="modal" data-target="#modal1" class="detail_message" id="<?php echo $list['id'];?>"><span class="glyphicon glyphicon-search"></span></a>
                      </div>
                    </td> 
                  </tr>
                <?php 
                    $i++;  
                  }
                ?>
    </tbody>
  </table>
</div>
</div>





<script type="text/javascript">
      $('.detail_message').on('click',function(){
        var dataString = { 
          id : $(this).attr('id')
        };
        
        $( "#load" ).show();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('message/detail');?>",
            data: dataString,
            cache : false,
            success: function(response){

              $( "#load" ).hide(); 
                $("#modal1header").html('Message');
                $("#modal1body").html(response); 
          
            } ,error: function(xhr, status, error) {
              alert(error);
            },

        });


      });
            
 
</script>
    
