  <!-- loading -->
  <script src="<?php echo base_url();?>assets/gantella/js/loading.js"></script>
  <!-- js for grafik -->
  <script src="<?php echo base_url();?>assets/gantella/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- bootstrap progress js -->
  <!-- <script src="<?php echo base_url();?>assets/gantella/js/progressbar/bootstrap-progressbar.min.js"></script> -->
  <!-- icheck -->
  <script src="<?php echo base_url();?>assets/gantella/js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/datepicker/daterangepicker.js"></script>
  <!-- chart js -->
  <!-- <script src="<?php echo base_url();?>assets/gantella/js/chartjs/chart.min.js"></script> -->
  <!-- sparkline -->
  <!-- <script src="<?php echo base_url();?>assets/gantella/js/sparkline/jquery.sparkline.min.js"></script> -->

  <script src="<?php echo base_url();?>assets/gantella/js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/date.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/gantella/js/flot/jquery.flot.resize.js"></script> -->
  <!-- pace -->
  <!-- <script src="<?php echo base_url();?>assets/gantella/js/pace/pace.min.js"></script>   -->

  <!-- Datatables-->
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/buttons.bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/jszip.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/pdfmake.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/vfs_fonts.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/buttons.html5.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/buttons.print.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.fixedHeader.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.keyTable.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/responsive.bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/gantella/js/datatables/dataTables.scroller.min.js"></script>

  <!-- pace -->
  <!-- <script src="<?php echo base_url();?>assets/gantella/js/pace/pace.min.js"></script> -->
  
  <!-- datatable -->
  <script>
  var handleDataTableButtons = function() {
      "use strict";
      0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [{
          extend: "copy",
          className: "btn-sm"
        }, {
          extend: "csv",
          className: "btn-sm"
        }, {
          extend: "excel",
          className: "btn-sm"
        }, {
          extend: "pdf",
          className: "btn-sm"
        }, {
          extend: "print",
          className: "btn-sm"
        }],
        responsive: !0
      })
    },
    TableManageButtons = function() {
      "use strict";
      return {
        init: function() {
          handleDataTableButtons()
        }
      }
    }();
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatable').dataTable();
    $('#datatable-keytable').DataTable({
      keys: true
    });
    $('#datatable-responsive').DataTable();
    $('#datatable-scroller').DataTable({
      ajax: "js/datatables/json/scroller-demo.json",
      deferRender: true,
      scrollY: 380,
      scrollCollapse: true,
      scroller: true
    });
    var table = $('#datatable-fixed-header').DataTable({
      fixedHeader: true
    });
  });
  TableManageButtons.init();
</script>
  <!-- /datatable -->



  <!-- datepicker -->
  <script type="text/javascript">
    $(document).ready(function() {

      var cb = function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
      }

      var optionSet1 = {
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: {
          days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        locale: {
          applyLabel: 'Submit',
          cancelLabel: 'Clear',
          fromLabel: 'From',
          toLabel: 'To',
          customRangeLabel: 'Custom',
          daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          firstDay: 1
        }
      };
      $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
      $('#reportrange').daterangepicker(optionSet1, cb);
      $('#reportrange').on('show.daterangepicker', function() {
        console.log("show event fired");
      });
      $('#reportrange').on('hide.daterangepicker', function() {
        console.log("hide event fired");
      });
      $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
      });
      $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
      });
      $('#options1').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
      });
      $('#options2').click(function() {
        $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
      });
      $('#destroy').click(function() {
        $('#reportrange').data('daterangepicker').remove();
      });
    });
  </script>
  <!-- /datepicker -->
  <script src="<?php echo base_url();?>assets/gantella/js/calendar/fullcalendar.min.js"></script>
  <script>
    $(window).load(function() {

      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      var started;
      var categoryClass;

      var calendar = $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
          $('#fc_create').click();

          started = start;
          ended = end

          $(".antosubmit").on("click", function() {
            var title = $("#title").val();
            if (end) {
              ended = end
            }
            categoryClass = $("#event_type").val();

            if (title) {
              calendar.fullCalendar('renderEvent', {
                  title: title,
                  start: started,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }
            $('#title').val('');
            calendar.fullCalendar('unselect');

            $('.antoclose').click();

            return false;
          });
        },
        eventClick: function(calEvent, jsEvent, view) {
          //alert(calEvent.title, jsEvent, view);

          $('#fc_edit').click();
          $('#title2').val(calEvent.title);
          categoryClass = $("#event_type").val();

          $(".antosubmit2").on("click", function() {
            calEvent.title = $("#title2").val();

            calendar.fullCalendar('updateEvent', calEvent);
            $('.antoclose2').click();
          });
          calendar.fullCalendar('unselect');
        },
        editable: true,
        events: [{
          title: 'All Day Event',
          start: new Date(y, m, 1)
        }, {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2)
        }, {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false
        }, {
          title: 'Lunch',
          start: new Date(y, m, d + 14, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false
        }, {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false
        }, {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/'
        }]
      });
    });
  </script>
