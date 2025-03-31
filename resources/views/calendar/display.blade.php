@extends('layouts.app')
@section('content')

@include('calendar.modalbooking')
<div id="calendar"></div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar(calendarEl, {
      plugins: [ dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title'
        },
        slotDuration: '00:10:00',
        defaultDate: '2023-02-22',
        editable: true,
        events: '{{ route('calendar.json') }}',
        dateClick: function(info) {
            $('#starttime').val(info.date.toISOString().substring(11,16));
            $('#bookingDate').val(info.date.toISOString().substring(0,10));
            $('#fullCalModal').modal('show');
            
        }
        
      });
      $(function () {
    $('body').on('click', '#submitButton', function (e) {
        $(this.form).submit();
        $('#fullCalModal').modal('hide');
    });
});
     calendar.render();
  });
</script>
@endsection