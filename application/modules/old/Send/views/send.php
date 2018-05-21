<div class="col-md-6 col-md-offset-3">
<div class="well well-sm">
  <form class="form-horizontal">
  <fieldset>
    <legend class="text-center">Contact us</legend>
    <div class="form-group">
      <label class="col-md-3 control-label" for="name">Name</label>
      <div class="col-md-9">
        <input id="name" type="text" placeholder="Your name" class="form-control" autofocus>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="email">E-mail</label>
      <div class="col-md-9">
        <input id="email" type="email" placeholder="Your email" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="subject">Subject</label>
      <div class="col-md-9">
        <input id="subject" type="text" placeholder="Your subject" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label" for="message">Your message</label>
      <div class="col-md-9">
        <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12 text-right">
        <button type="button" id="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
  </form>
</div>
</div>

<script>
  $(document).ready(function(){

		$("#load").hide();

    $("#submit").click(function(){
      
      $( "#load" ).show();

       var dataString = { 
              name : $("#name").val(),
              email : $("#email").val(),
              subject : $("#subject").val(),
              message : $("#message").val()
            };

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('send/submit');?>",
            data: dataString,
            dataType: "json",
            cache : false,
            success: function(data){

              $( "#load" ).hide();
              $("#name").val('');
              $("#email").val('');
              $("#subject").val('');
              $("#message").val('');

              if(data.success == true){

                $("#notif").html(data.notif);

                var socket = io.connect( 'http://'+window.location.hostname+':3000' );

                socket.emit('new_count_message', { 
                  new_count_message: data.new_count_message
                });

                socket.emit('new_message', { 
                  name: data.name,
                  email: data.email,
                  subject: data.subject,
                  created_at: data.created_at,
                  id: data.id
                });

              } else if(data.success == false){

                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#subject").val(data.subject);
                $("#message").val(data.message);
                $("#notif").html(data.notif);

              }
          
            } ,error: function(xhr, status, error) {
              alert(error);
            },

        });

    });

  });
</script>