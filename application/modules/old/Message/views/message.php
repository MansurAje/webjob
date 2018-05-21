  <div class="table-responsive">
    <table id="mytable" class="table table-bordred table-striped">
      <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Subject</th>
        <th>Time</th>
        <th>Read</th>
      </thead>
      <tbody id="message-tbody">
           
        <?php
                  
           if($message->num_rows() > 0){
                
              foreach($message->result() as $row){
                  
        ?>
                  
              <tr>
                <td><?php echo $row->name;?></td>
                <td><?php echo $row->email;?></td>
                <td><?php echo $row->subject;?></td>
                <td><?php echo $row->created_at;?></td>
                <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="<?php echo $row->id;?>"><span class="glyphicon glyphicon-search"></span></a></td>
              </tr>
        <?php
              
              }
                  
                  
           } else {
                  
        ?>
                  
                  <tr id="no-message-notif">
                    <td colspan="5" align="center"><div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only"></span> No message</div>
                    </td>
                  </tr>
                  
        <?php
           }
        ?>
      </tbody>
    </table>

  </div>

    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">✕</button>
                <h4>Detail Message</h4>
            </div>
            
            <div class="modal-body" style="text-align:center;">
              <div class="row-fluid">
               <div class="span10 offset1">
                 <div id="modalTab">
                   <div class="tab-content">
                     <div class="tab-pane active" id="about">

                      <center>
                       <p class="text-left">
                        <b>Name</b> : <span id="show_name"></span><br />
                        <b>Email</b> : <span id="show_email"></span><br />
                        <b>Subject</b> : <span id="show_subject"></span><br />
                        <b>Message</b> : <span id="show_message"></span><br />
                       </p>
                       <br>
                     </center>
            
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  

  <script>
    $(document).ready(function(){

      $("#load").hide();

       $(document).on("click",".detail-message",function() {
        
        $( "#load" ).show();

         var dataString = { 
                id : $(this).attr('id')
              };

          $.ajax({
              type: "POST",
              url: "<?php echo base_url('message/detail');?>",
              data: dataString,
              dataType: "json",
              cache : false,
              success: function(data){

                $( "#load" ).hide();

                if(data.success == true){

                  $("#show_name").html(data.name);
                  $("#show_email").html(data.email);
                  $("#show_subject").html(data.subject);
                  $("#show_message").html(data.message);

                  var socket = io.connect( 'http://'+window.location.hostname+':3000' );
                  
                  socket.emit('update_count_message', { 
                    update_count_message: data.update_count_message
                  });

                } 
            
              } ,error: function(xhr, status, error) {
                alert(error);
              },

          });

      });

    });

    var socket = io.connect( 'http://'+window.location.hostname+':3000' );

    socket.on( 'new_count_message', function( data ) {
    
        $( "#new_count_message" ).html( data.new_count_message );
        $('#notif_audio')[0].play();

    });

    socket.on( 'update_count_message', function( data ) {

        $( "#new_count_message" ).html( data.update_count_message );
      
    });

    socket.on( 'new_message', function( data ) {
    
        $( "#message-tbody" ).prepend('<tr><td>'+data.name+'</td><td>'+data.email+'</td><td>'+data.subject+'</td><td>'+data.created_at+'</td><td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="'+data.id+'"><span class="glyphicon glyphicon-search"></span></a></td></tr>');
        $( "#no-message-notif" ).html('');
        $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>New message ...</div>');
    });

  </script>

