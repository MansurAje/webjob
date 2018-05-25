<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKDU Online</title>
  </head>
  
  <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js');?>"></script>  
  <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
  
<!--   <script type="text/javascript" src="<?php echo base_url('assets/js/base64.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jszip/jszip.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jszip/jszip-load.js');?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jszip/jszip-inflate.js');?>"></script>

  <script src="<?php echo base_url('assets/js/docxgen.js');?>"></script> -->
 <!--  <script src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
 <script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script> -->

 <script src="<?php echo base_url('assets/jquery-ui-1.12.1.custom/jquery-ui.min.js');?>"></script> 
 
  <script src="<?php echo base_url('node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
 
  <script src="<?php echo base_url('assets/DataTables/datatables.js');?>"></script>
  <script src="<?php echo base_url('assets/DataTables/datatables.min.js');?>"></script> 

  <script src="<?php echo base_url('assets/GuriddojqGrid/src/i18n/grid.locale-en.js');?>"></script>
  <script src="<?php echo base_url('assets/GuriddojqGrid/src/jquery.jqGrid.js');?>"></script>

  
  <!--untuk memanggil css-->
  <?php echo $css; ?>

  <body>

    <div id="load">Please wait ...</div>
    <audio id="notif_audio"><source src="<?php echo base_url('sounds/notify.ogg');?>" type="audio/ogg"><source src="<?php echo base_url('sounds/notify.mp3');?>" type="audio/mpeg"><source src="<?php echo base_url('sounds/notify.wav');?>" type="audio/wav"></audio>
    <!-- $header diambil dari core-->
    <?php echo $header; ?>

<style type="text/css">
  #modal1body {
    width: 580px;
  
  }

  


</style>    
<div class="container">

<div id="new-message-notif"></div>
  <div class="row">

      <?php echo $isi; ?>

      <!-- Modal -->
      <div id="modal1" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span id="modal1header">Modal Header</span></h4>
            </div>
            <div class="modal-body">
                <div id="modal1body">
                    <p>Some text in the modal.</p>    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>


  </div>
</div>
  
  <!-- <script type="text/javascript">
    $("#load").hide();
  </script> -->
<script type="text/javascript">
  $(document).ready(function() {
      $("#load").hide();
      $('.dataTables').DataTable();
  } );  
</script>
  

    <!-- $footer diambil dari core-->
    <?php echo $footer; ?>

    <!-- untuk memanggil js -->
    <?php echo  $js; ?>

  </body>
</html>




