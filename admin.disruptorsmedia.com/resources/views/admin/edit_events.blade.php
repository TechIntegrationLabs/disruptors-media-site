@extends('admin/partials/master')

@section('content')
<section class="event_sec">
    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Display success message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container-fluid bord_box">
        <div class="row">
            <div class="col-lg-9">
                <div class="event_form_cont">
                    <h3>Event & Calendar</h3>
                    <form action="{{ route('admin.updateEvent', $event->id) }}" method="post">
                        @csrf
                        @method('PUT') {{-- Use PUT method for update --}}
                        <div class="row">
                            <div class="col-6">
                                <label for="startDate">Start Date:</label>
                                <input type="date" id="startDate" name="start_date" value="{{ substr($event->start_date, 0, 10) }}" >
                            </div>
                            <div class="col-6">
                                <label for="endDate">End Date: </label>
                                <input type="date" id="endDate" name="end_date" value="{{ substr($event->end_date, 0, 10) }}" >
                            </div>
                            <div class="col-12">
                                <label for="startTime">Start Time: </label>
                                <input type="time" id="startTime" name="start_time" value="{{ date('H:i', strtotime($event->start_time)) }}" >
                            </div>
                            <div class="col-12">
                                <label for="endTime">End Time: </label>
                                <input type="time" id="endTime" name="end_time" value="{{ date('H:i', strtotime($event->end_time)) }}" >
                            </div>
                            <div class="col-12">
                                <label for="eventTitle">Event Title: </label>
                                <input type="text" id="eventTitle" name="event_title" value="{{ $event->event_title }}" >
                            </div>
                            <div class="col-12">
                                <label for="eventDescription">Event Description:</label>
                                <textarea id="eventDescription" name="event_description" rows="4" cols="50">{{ $event->event_description }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="eventLocation">Event Location:</label>
                                <input type="text" id="eventLocation" name="event_location" value="{{ $event->event_location }}">
                            </div>

                            <input type="submit" value="Update Event">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                <img class="" src="{{ asset('front/admin/assets/images/event_add.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

@endsection
