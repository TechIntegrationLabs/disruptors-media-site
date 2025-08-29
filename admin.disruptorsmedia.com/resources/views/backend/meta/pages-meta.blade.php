@extends('backend.partials.master')
@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">Seo Settings</h1>
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
                    <li class="breadcrumb-item text-muted">Seo</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Update Website Meta</li>
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
                    <div class="card-title fs-3 fw-bolder">Website Meta Settings</div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Form-->
                <form id="updateHeaderForm" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('update_website_meta',['id'=>$edit_website_meta->id])}}"  method="post"  novalidate="novalidate">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                     
                          <!--begin::Row-->
                                    <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Homepage Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="homepage_meta_title" id="homepage_meta_title" placeholder="Enter Homepage Meta Title" value="{{ $edit_website_meta->home_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Home Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="home_meta_description" name="home_meta_description" class="form-control">{{$edit_website_meta->home_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                        
                          <!--begin::Row-->
                                   <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Work Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="work_meta_title" id="work_meta_title" placeholder="Enter Work Meta Title" value="{{ $edit_website_meta->work_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Work Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="work_meta_description" name="work_meta_description" class="form-control">{{$edit_website_meta->work_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                        
                          <!--begin::Row-->
                                 <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Services Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="services_meta_title" id="services_meta_title" placeholder="Enter Services Meta Title" value="{{ $edit_website_meta->services_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Services Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="services_meta_description" name="services_meta_description" class="form-control">{{$edit_website_meta->services_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                          <!--begin::Row-->
                                  <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">About Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="about_meta_title" id="about_meta_title" placeholder="Enter About Meta Title" value="{{ $edit_website_meta->about_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">About Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="about_meta_description" name="about_meta_description" class="form-control">{{$edit_website_meta->about_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                          <!--begin::Row-->
                                   <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Gallery Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="gallery_meta_title" id="gallery_meta_title" placeholder="Enter Gallery Meta Title" value="{{ $edit_website_meta->gallery_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Gallery Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="gallery_meta_description" name="gallery_meta_description" class="form-control">{{$edit_website_meta->gallery_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                          <!--begin::Row-->
                                 <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Faq Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="faq_meta_title" id="faq_meta_title" placeholder="Enter Faq Meta Title" value="{{ $edit_website_meta->faq_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Faq Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="faq_meta_description" name="faq_meta_description" class="form-control">{{$edit_website_meta->faq_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                          <!--begin::Row-->
                                <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Contact Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="contact_meta_title" id="contact_meta_title" placeholder="Enter >Contact Meta Title" value="{{ $edit_website_meta->contact_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Contact Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="contact_meta_description" name="contact_meta_description" class="form-control">{{$edit_website_meta->contact_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>


                             <!--begin::Row-->
                                <!--begin::Row-->
                                <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Podcast Meta Title</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="podcast_meta_title" id="podcast_meta_title" placeholder="Enter >Podcast Meta Title" value="{{ $edit_website_meta->podcast_meta_title }}">
                                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Podcast Meta Description</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <textarea style="height: 300px;" id="podcast_meta_description" name="podcast_meta_description" class="form-control">{{$edit_website_meta->podcast_meta_description}}</textarea>
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        
                    </div>
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
                    <!--end::Card body-->
                    <!--begin::Card footer-->
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

@endsection
