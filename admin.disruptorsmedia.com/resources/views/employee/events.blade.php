@extends('employee/partials/master')

@section('content')

<section class="secMessages secWithNav">
    <div class="container-fluid">
        @include('employee/partials/sidebar-nav')
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="announcements half_bord">
                    <h3>
                        <span class="icon">
                            <img src="{{ asset('front/assets/images/icon-announce.png') }}" alt="">
                        </span>
                        Events & Calendar
                        <span class="icon_hash">
                            <img src="{{ asset('front/assets/images/icon_hash.png') }}" alt="">
                        </span>
                    </h3>
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="bord_box evt_main">
                    <h3>
                        Events
                        <span class="icon_hash">
                            <img src="{{ asset('front/assets/images/icon_hash.png') }}" alt="">
                        </span>
                    </h3>
                    <div class="events_schedule">
                        <h4>Schedule <span class="counter">({{ count($events ?? []) }})</span></h4>
                        <div class="custom_scroll">
                            <ul class="evt_list">
                                @forelse($events as $event)
                                <li>
                                    {{ $event->event_title }} - {{ $event->event_location }}
                                    <span class="schedule">
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('j F Y') }}
                                        - {{ \Carbon\Carbon::parse($event->end_date)->format('l') }}
                                    </span>
                                    <span class="icon_hash">
                                        <img src="{{ asset('front/assets/images/icon_hash.png') }}" alt="">
                                    </span>
                                </li>
                                @empty
                                <li>No events available</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="bord_box half_bord">
                    <div class="monthly_news" style="background-image: url('{{ asset('front/assets/images/month_bg.png') }}');">
                        <h4>Monthly newsletter <span class="icon_hash"><img
                                    src="{{ asset('front/assets/images/icon_hash.png') }}" alt=""></span></h4>
                        <h2>Get That Payday Feeling <br>Whenever You Want!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
jQuery(document).ready(function($) {
    // Fetch events and dates from the database
    $.ajax({
        url: '/events',
        type: 'GET',
        dataType: 'json',
        success: function (response) {           
            var eventes = response.events;
            var eventsArray = [];
            eventes.forEach(function (index) {
                var eventObject = {
                    title: index.event_title, 
                    start: index.start_date, 
                    end: index.end_date, 
                    popup: {
                        title: index.event_title,
                        descri: 'This is the description',
                    },
                    backgroundColor:"#000",
                };
                eventsArray.push(eventObject);
            });
            try {
                $('#calendar').fullCalendar({
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: eventsArray, // Use your actual data here
                    eventRender: function (event, element) {
                        var currentDate = moment();
                        var eventDate = moment(event.start);
                        if (eventsArray.specialDates && data.specialDates.includes(eventDate.format('YYYY-MM-DD'))) {
                            element.css('background-color', 'green');
                        }
                    },

                    // eventRender: function (event, element) {
                    //     var currentDate = moment();
                    //     var eventStartDate = moment(event.start);
                    //     var eventEndDate = moment(event.end);

                    //     if (
                    //         (eventsArray.specialDates && data.specialDates.includes(eventStartDate.format('YYYY-MM-DD'))) ||
                    //         (eventsArray.specialDates && data.specialDates.includes(eventEndDate.format('YYYY-MM-DD')))
                    //     ) {
                    //         element.css('background-color', 'green');
                    //     }
                    // },
                    eventClick: function(info) {
                        console.log("Infor",info.title);
                        // Customizing the pop-up content
                        var title = info.title;
                        var descri = info.descri;
                        alert("Title: " + title + "\nDescription: " + descri);
                    }
                });
            } catch (error) {
                console.error('Error initializing FullCalendar: ' + error);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error fetching events and dates: ' + error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
        }
    });
});

</script>
