@extends('admin/partials/master')
@section('content')
<section class="event_sec">
    <div class="container-fluid bord_box">
        <div class="row">
            <div class="col-lg-9">
                <div class="event_form_cont">
                    <h3>
                        User Registration
                    </h3>

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


                    <form id="registrationForm" action="{{ route('register-user') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="firstName"> First Name: <span>( Required )</span></label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="col-6">
                                <label for="lname">Last Name: <span>( Required )</span></label>
                                <input type="text" id="lname" name="lname" required>
                            </div>
                            <div class="col-6">
                                <label for="email">Email Address: <span>( Required )</span></label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="col-6">
                                <label for="phoneNumber">Phone Number:</label>
                                <input type="tel" id="phoneNumber" name="phoneNumber">
                            </div>

                            <div class="col-12">
                                <label for="password">Password: <span>( Required )</span></label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="col-12">
                                <label for="password">Confirm password: <span>( Required )</span></label>
                                <input type="password" id="password" name="password_confirmation" required>
                            </div>
                            <div class="col-12">
                                <label for="profilePicture">Profile Picture:</label>
                                <div class="prof_img_div">

                                    <input type="file" id="profilePicture" name="profilePicture" accept="image/*"
                                        onchange="previewImage(this)">
                                    <img id="preview"
                                        src="{{ asset('front/admin/assets/images/placeholder_image.jpeg') }}"
                                        alt="Profile Picture Preview" width="100">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="designation">Designation:</label>
                                <input type="text" id="designation" name="designation">
                            </div>
                            <div class="col-6">
                                <label for="joined">Joined Date:</label>
                                <input type="date" id="joined" name="joined">
                            </div>
                            <div class="col-6">
                                <label for="lives">Lives:</label>
                                <input type="text" id="lives" name="lives">
                            </div>
                        </div>

                        <input type="submit" value="Create User">
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                <img class="" src="{{ asset('front/admin/assets/images/event_add.png') }}" alt="">
            </div>
        </div>
    </div>
</section>
<script>
function previewImage(input) {
    var preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = 'placeholder.jpg'; // If no file selected, show placeholder image
    }
}
</script>
@endsection