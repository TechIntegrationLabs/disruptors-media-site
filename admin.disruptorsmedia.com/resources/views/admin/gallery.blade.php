@extends('admin/partials/master')
@section('content')
<section class="gallery_sec">
    <div class="container-fluid bord_box ">
        <div class="row">
            <div class="col-lg-12">
                <div class="event_form_cont">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-uppercase">
                            Gallery
                        </h3>
                        <a href="javascript:;" class="theme_btn">Add Photo</a>
                    </div>
                    <br>
                    <div class="gallery">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-4 col_1">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/1.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/2.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/3.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/4.png')}}" alt="">
                                </div>
                                <div class="col-4 col_2">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/5.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/6.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/7.png')}}" alt="">
                                </div>
                                <div class="col-4 col_1">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/8.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/9.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/10.png')}}" alt="">
                                    <img class="img" src="{{asset('front/admin/assets/images/gallery/11.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection