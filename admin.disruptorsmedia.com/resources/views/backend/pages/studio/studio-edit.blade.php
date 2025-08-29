@extends('backend.partials.master')
@section('content')
<style>
    .existing-image {
    display: inline-block;
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
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Studio</h1>
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
                    <li class="breadcrumb-item text-muted">Studio</li>
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
                    <div class="card-title fs-3 fw-bolder"> Projects</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Form-->
                <form id="updateHeaderForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('update_work_studios',['id'=>$studio->id])}}" method="post" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body p-9">

                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Studio Name</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="studio_name" id="studio_name" placeholder="Enter Studio Name" value="{{$studio->studio_title}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>

                            <!--begin::Row-->
                            <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Studio Location</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="studio_location" id="studio_location" placeholder="Enter Location Name" value="{{$studio->location}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>

                            <!--begin::Row-->
                            <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Studio Pricing</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="studio_pricing" id="studio_pricing" placeholder="Enter Project Name" value="{{$studio->pricing_text}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>

                            <!--begin::Row-->
                            <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Studio Book now link</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="book_now_link" id="book_now_link" placeholder="Enter Project Name" value="{{$studio->booking_action_link}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>



                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Studio Message us link</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="studio_message_us_link" id="studio_message_us_link" placeholder="Enter Project Name" value="{{$studio->message_us_link}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--end::Row-->
                          <!--begin::Row-->
                          <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">About this space Content</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea id="about_this_space_content" name="about_this_space_content" class="tox-target">
                                        {{$studio->about_content}}
                                </textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->


                           <div class="row mb-5">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Project Feature Image</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 75%; background-image: url('{{asset('/'.$studio->feature_image)}}')"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="feature_image" id="feature_image" accept=".png, .jpg, .jpeg,.svg">
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


                         <!--begin::Row-->
                         <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Project Gallery Image</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <!-- Existing Images from ProjectImages table -->
       
                                    <!-- Fetch images for the current project category -->
                                    @php
                                        $images = \App\Models\StudioGallery::where('studio_id', $studio->id)->get();
                                    @endphp
                                    @foreach($images as $image)
                                        <div class="existing-image">
                                            <img class="mb-3" style="width:120px;" src="{{ asset('/'.$image->image) }}" alt="Existing Image">
                                            <!-- Add a delete button or checkbox here -->
                                            <!-- For example, a delete button -->
                                            <a href="{{ route('delete_studio_img', ['id' => $image->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                    @endforeach
                                   
                             
                                <!-- File Input for New Images -->
                                <input type="file" class="form-control form-control-solid" name="studio_gallery_images[]" id="studio_gallery_images" multiple>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                        </div>

                        <!--end::Row-->
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
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
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
            var maxField = 100; // Maximum number of input fields
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
            var teammaxField = 100; // Maximum number of input fields
            var teambutton = $('.add_team'); // Add button selector
            var teamwrapper = $('.team-container'); // Input field wrapper

            // Add input field
            $(teambutton).click(function(){
                // Check if the maximum limit is reached
                if(teamwrapper.children('div').length < teammaxField){
                    // Add new input field
                    $(teamwrapper).append('<div><input class="form-control form-control-solid" type="text" placeholder="Enter Team" name="teams[]" value=""/><a href="javascript:void(0);" class="remove_button_specialities"><img src="{{ asset('assets/media/trash-bin.png') }}"/></a></div>');
                } else {
                    // Display a toast error message if the maximum limit is reached
                    toastr.error('You have reached the maximum limit.',teammaxField);
                }
            });

            // Remove input field
            $(teamwrapper).on('click', '.remove_button_specialities', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); // Remove field html
            });
        });
    </script>
@endsection
