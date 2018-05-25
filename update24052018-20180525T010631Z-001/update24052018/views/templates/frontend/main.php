<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>webjob.wika.co.id</title>

    <!--untuk memanggil css-->
    <?php echo $css; ?>
    <script src="<?php echo base_url('assets/js/webfont.js');?>"></script>
  </head>
  <body>

    <div class="fix-header" id="home">
      <div class="w-container">
        <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400"></div>
      </div>
    </div>

    <div class="fixed-header">
      <?php echo $header; ?>
    </div>

    

    <?php echo $isi; ?>


    <!-- untuk memanggil js -->
    <?php echo  $js; ?>


  

    <!-- $footer diambil dari core-->
    <?php echo $footer; ?>

	
  </body>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2018-03-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2018-03-01',
        },
        {
          title: 'Long Event',
          start: '2018-03-07',
          end: '2018-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2018-03-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2018-03-11',
          end: '2018-03-13'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T10:30:00',
          end: '2018-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2018-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2018-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2018-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2018-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2018-03-13T07:00:00'
        }
      ]
    });

  });

</script>
<style>


 #calendar {
  max-width: 900px;
  margin: 0 auto;
 }

</style>

</html>




