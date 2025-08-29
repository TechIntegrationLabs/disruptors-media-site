@extends('backend.partials.master')
@section('content')
<style>
       .remove_button_specialities ,.add_tags ,.add_teams {
            float: right;
            position: relative;
            bottom: 36px;
            width: 41px;
        }
</style>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Podcasts</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admindashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Podcast</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Edit</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title fs-3 fw-bolder"> Podcasts</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Form-->
                <form id="updateHeaderForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('edit_podcast_video',['id'=>$podcast->id])}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                    <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Video Title</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="video_title" id="video_title" placeholder="Enter Video Name" value="{{$podcast->video_title}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                    <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                            <label for="podcast_poster">Current Podcast Poster</label><br>
        @if($podcast->video_poster)
            <img src="{{ asset($podcast->video_poster) }}" alt="Podcast Poster" style="max-width: 200px; height: auto;">
        @else
            <p>No poster available.</p>
        @endif
                                <div class="fs-6 fw-bold mt-2 mb-3">Video Poster</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('')"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="podcast_poster" id="podcast_poster" accept=".png, .jpg, .jpeg,.svg">
                                        <input type="hidden" name="avatar_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="" data-bs-original-title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <div class="row mb-5">
             
                            <!--begin::Col-->
                            <div class="col-xl-3">
                            @if($podcast->video_url)
            <video width="320" height="240" controls>
                <source src="{{ asset($podcast->video_url) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @else
            <p>No video available.</p>
        @endif
                                <div class="fs-6 fw-bold mt-2 mb-3"> Podcast  Video</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
    <!--begin::Video input-->
                                <div class="video-input video-input-outline" data-kt-video-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <label class="btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-video-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change video">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="podcast_video" id="podcast_video" accept=".mp4,.mov,.avi,.mkv">
                                        <input type="hidden" name="video_remove">
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Video input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed video file types: mp4, mov, avi, mkv.</div>
                                <!--end::Hint-->
                            </div>

                            <!--end::Col-->
                        </div>

                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    @if ($errors->any())
                        <script>
                            $(document).ready(function() {
                                var errors = @json($errors->all());

                                errors.forEach(function(error) {
                                    // Display error in toaster notification using a library like Toastr
                                    toastr.error(error);
                                });
                            });
                        </script>
                    @endif
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="header_settings_btn">Save Changes</button>
                    </div>
                    <!--end::Card footer-->
                <input type="hidden"><div></div></form>
                <!--end:Form-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; // Maximum number of input fields
            var addButton = $('.add_tags'); // Add button selector
            var wrapper = $('.tag-container'); // Input field wrapper

            // Add input field
            $(addButton).click(function(){
                // Check if the maximum limit is reached
                if(wrapper.children('div').length < maxField){
                    // Add new input field
                    $(wrapper).append('<div><input class="form-control form-control-solid" type="text" placeholder="Enter Tag" name="tags[]" value=""/><a href="javascript:void(0);" class="remove_button_specialities"><img src="{{ asset('assets/media/trash-bin.png') }}"/></a></div>');
                } else {
                    // Display a toast error message if the maximum limit is reached
                    toastr.error('You have reached the maximum limit.',maxField);
                }
            });

            // Remove input field
            $(wrapper).on('click', '.remove_button_specialities', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); // Remove field html
            });
        });
    </script>
        <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; // Maximum number of input fields
            var addButton = $('.add_teams'); // Add button selector
            var wrapper = $('.team-container'); // Input field wrapper

            // Add input field
            $(addButton).click(function(){
                // Check if the maximum limit is reached
                if(wrapper.children('div').length < maxField){
                    // Add new input field
                    $(wrapper).append('<div><input class="form-control form-control-solid" type="text" placeholder="Enter Team Content" name="teams[]" value=""/><a href="javascript:void(0);" class="remove_button_specialities"><img src="{{ asset('assets/media/trash-bin.png') }}"/></a></div>');
                } else {
                    // Display a toast error message if the maximum limit is reached
                    toastr.error('You have reached the maximum limit.',maxField);
                }
            });

            // Remove input field
            $(wrapper).on('click', '.remove_button_specialities', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); // Remove field html
            });
        });
    </script>
@endsection
