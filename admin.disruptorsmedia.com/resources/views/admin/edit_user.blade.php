@extends('admin/partials/master')
@section('content')
<section class="event_sec">
    <div class="container-fluid bord_box">
        <div class="row">
            <div class="col-lg-9">
                <div class="event_form_cont">
                    <h3>User Update</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="registrationForm" action="{{ route('admin.updateUser', $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT') {{-- Use PUT method for updating data --}}
    <div class="row">
        <div class="col-6">
            <label for="name">Name: <span>( Required )</span></label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="col-6">
            <label for="lname">Last Name: <span>( Required )</span></label>
            <input type="text" id="lname" name="lname" value="{{ $user->lname }}" required>
        </div>
        <div class="col-6">
            <label for="email">Email Address: <span>( Required )</span></label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="col-6">
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="{{ $user->phoneNumber }}">
        </div>
        <div class="col-6">
            <label for="password">Password: <span>( Leave blank to keep current password )</span></label>
            <input type="password" id="password" name="password" value="">
        </div>
        <div class="col-6">
            <label for="profilePicture">Profile Picture:</label>
            <input type="file" id="profilePicture" name="profilePicture">
        </div>
        <div class="col-6">
            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" value="{{ $user->designation }}">
        </div>
        <div class="col-6">
            <label for="joined">Joined Date:</label>
            <input type="date" id="joined" name="joined" value="{{ $user->joined }}">
        </div>
        <div class="col-6">
            <label for="lives">Lives:</label>
            <input type="text" id="lives" name="lives" value="{{ $user->lives }}">
        </div>
    </div>
    <input type="submit" value="Update User">
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