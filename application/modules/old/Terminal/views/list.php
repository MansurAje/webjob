
<style type="text/css">
  .rttengah{
    text-align: center;
  }
</style>
<div class="panel panel-primary">
<div class="panel-heading">
  <h3>Terminal Lists</h3>
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
  <?php if($akses['iCreate']==1){?>
  <div class="btn-group" role="group" aria-label="...">
    <a href="<?php echo base_url()?>Terminal/create"><button type="button" class="btn btn-primary">Add New Record</button></a>
  </div>
  <?php } ?>
  <br>
  <br>
  <!-- Table -->
  <table class="dataTables table table-bordered table-striped table-hover table-responsive">
    <thead>
      <tr>
        <th class="rttengah" style="width:5%;">No</th>
        <th class="rttengah" style="width:15%;">Terminal Code</th>
        <th class="rttengah" style="width:15%;">Terminal Nama</th>  
        <th class="rttengah" style="width:30%;">Ip Address</th>
        <th class="rttengah" style="width:15%;">Action</th>
        
      </tr>
    </thead>
    <tbody>
          <?php 
              $i=1;
              foreach ($lists as $list ) {
          ?>
            <tr>
              

              <td align="right"><?php echo $i ?></td>
              <td><?php echo $list['cTerminalCode']?></td> 
              <td><?php echo $list['vTerminalName']?></td>
              <td><?php echo $list['vIpAddress']?></td>
              <td align="center">
                <div class="btn-group" role="group" aria-label="...">
                  
                  <a style="cursor:pointer" data-toggle="modal" data-target="#modal1" class="detail_terminal" id="<?php echo $list['iTerminal'];?>">
                    <span type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-search"></span></span></a>
                  <?php if($akses['iUpdate']==1){?>
                  <a href="<?php echo base_url();?>Terminal/update/<?php echo $list['iTerminal']?>">
                    <span type="button" class="btn btn-warning" >
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span>
                  </span>
                  </a>
                  <?php } ?>
                  <?php if($akses['iDelete']==1){?>
                   <a href="<?php echo base_url();?>Terminal/delete/<?php echo $list['iTerminal']?>">
                    <span type="button" class="btn btn-warning" >
                    <span class="glyphicon glyphicon-trash" aria-hidden="true" onclick="javascript: return confirm('Yakin hapus ??')"></span>
                    </span>
                  </a>
                  <?php } ?>


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
            $('.detail_terminal').on('click',function(){
              var dataString = { 
                id : $(this).attr('id')
              };
              
              $( "#load" ).show();

              $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Terminal/detail');?>",
                  data: dataString,
                  cache : false,
                  success: function(response){

                    $( "#load" ).hide();

                    //if(data.success == true){

                      $("#modal1header").html('Detail');
                      $("#modal1body").html(response);
                     
                    //} 
                
                  } ,error: function(xhr, status, error) {
                    alert(error);
                  },

              });


            });
            

/*script dibawah untuk membuat width modal 100%*/
/*  $('#modal1').off();
  $('#modal1').on('shown.bs.modal', function () {
      $(this).find('.modal-dialog').css({width:'auto',
                                 height:'auto', 
                                'max-height':'100%'});
  });*/
</script>
    