@extends('admin/partials/master')
@section('content')
<section class="event_sec">
    <div class="container-fluid bord_box">
        <div class="row">
            <div class="col-lg-9">
                <div class="event_form_cont">
                    <h3>
                        Create QR Codes
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


                    <form id="registrationForm" action="{{ route('qrcodes.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="firstName"> Data for QR Code:<span>( Required )</span></label>
                                <input type="text" name="data" id="data" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="lname">Logo URL : <span>(optional)</span></label>
                                <input type="url" name="logo_url" id="logo_url" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="email">Link<span>( Required )</span></label>
                                <input type="url" name="link" id="link" class="form-control" required>
                            </div>
                        </div>

                        <input type="submit" value="Create QR">
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
