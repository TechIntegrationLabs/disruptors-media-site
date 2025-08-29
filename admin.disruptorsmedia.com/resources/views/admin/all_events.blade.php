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

    <div class="container-fluid bord_box alluserinner">
        <div class="row">
            <div class="col-lg-9">
  <ul class="list-unstyled ">
                        @foreach($events as $key => $event)
                            <li>
                            <div class="message_box">
                                <span class="icon_hash">
                                        <a href="{{ route('admin.editEvent', $event->id) }}"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.deleteUser', $event->id) }}" method="POST" style="display: inline;">
                                            <input type="hidden" name="_token" value="oI8EezZiYOSNMl5kL9AUZH2U3P4oIqKHnPnHz1eZ">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                </span>
                                <img class="avatar" src="{{ $event->profilePicture ? asset('storage/' . $event->profilePicture) : asset('front/admin/assets/images/placeholder_image.jpeg') }}" alt="">
                                <div class="det">
                                <h4>{{ $event->event_title }}</h4>
                                <div class="desg y_txt">{{ $event->event_description }}</div>
                                </div>
                                <div class="date">
                                    <span>Start Date</span>
                                    <p>{{ $event->start_date }}</p>
                                </div>
                                <div class="date">
                                    <span>End Date</span>
                                    <p>{{ $event->end_date }}</p>
                                </div>
                                <div class="lives_in">
                               <span> LOCATION:</span>
                               <p>{{ $event->event_location }}</p>
                                </div>
                            </div>
                        </li>

                        @endforeach


                    </ul>
            </div>
            <div class="col-lg-3">
                <img class="" src="{{ asset('front/admin/assets/images/event_add.png') }}" alt="">
            </div>
        </div>
    </div>
</section>

@endsection
