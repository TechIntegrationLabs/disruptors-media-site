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
    <div class="container-fluid bord_box ">
        <div class="row">
        <div class="col-lg-9">
          <div class="event_form_cont">
            <h3>
            Event & Calendar
            </h3>
            <form action="{{ route('admin.addevents') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="startDate">Start Date: <span>( Required )</span> </label>
                        <input type="date" id="startDate" name="startDate" required>
                    </div>
                    <div class="col-6">
                        <label for="endDate">End Date: </label>
                        <input type="date" id="endDate" name="endDate" required>
                    </div>
                    <div class="col-12">
                        <label for="startTime">Start Time: <br><span>If No Start Time Is Provided, Events Will Be Shown
                                As All-Day.</span></label>
                        <input type="time" id="startTime" name="startTime" required>
                    </div>
                    <div class="col-12">
                        <label for="endTime">End Time: </label>
                        <input type="time" id="endTime" name="endTime" required>
                    </div>
                    <div class="col-12">
                        <label for="eventTitle">Event Title: <span>( Required )</span></label>
                        <input type="text" id="eventTitle" name="eventTitle" required>
                    </div>
                    <div class="col-12">
                        <label for="eventDescription">Event Description:</label>
                        <textarea id="eventDescription" name="eventDescription" rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <label for="eventLocation">Event Location:</label>
                    <input type="text" id="eventLocation" name="eventLocation">
                </div>

                <input type="submit" value="Order By">
            </form>
          </div>
        </div>
        <div class="col-lg-3">
        <img class="" src="{{asset('front/admin/assets/images/event_add.png')}}" alt="">
        </div>
        </div>
    </div>
</section>

@endsection