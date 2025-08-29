@extends('admin/partials/master')
@section('content')
<section class="admin_dashboard">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="bord_box admin_dash_box d-flex justify-content-between align-items-center exp_box">
                    <div class="cont">
                        <h6>New users</h6>
                        <h3>{{$user_count}}</h3>
                        <div class="icon_cont">
                             <i class="fa-solid fa-arrow-up"></i>
                        </div>
                    </div>
                    <img src="{{asset('front/admin/assets/images/lines.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bord_box admin_dash_box d-flex justify-content-between align-items-center exp_box">
                    <div class="cont">
                        <h6>Events</h6>
                        <h3>{{$events}}</h3>
                        <div class="icon_cont">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>
                    </div>
                    <img src="{{asset('front/admin/assets/images/round_lines.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bord_box admin_dash_box d-flex justify-content-between align-items-center exp_box">
                    <div class="cont">
                        <h6>QR Codes</h6>
                        <h3>{{$events}}</h3>
                        <div class="icon_cont">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>
                    </div>
                    <img src="{{asset('front/admin/assets/images/curve.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="bord_box half_bord message_list admin_msg">
                    <h3>
                    Inbox
                        <span class="icon_hash">
                            <img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
                        </span>
                    </h3>

                    <ul class="list-unstyled ">

                    @foreach ($users as $user)

                        <li>
                            <div class="message_box">
                                <span class="icon_hash">
                                    <img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
                                </span>
                                <img class="avatar" src="{{asset('front/admin/assets/images/message_avatar.png')}}" alt="">
                                <h4>John Doe</h4>
                                <p>
                                    <span class="txt">
                                        Lorem Ipsum is simply...
                                    </span>
                                    <span class="date">
                                        20.October
                                    </span>
                                </p>
                            </div>
                        </li>
                        @endforeach               

                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
            <div class="bord_box half_bord message_list admin_msg dashboard_user">
                    <h3>
                    Users
                        <span class="icon_hash">
                            <img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
                        </span>
                    </h3>

                    <ul class="list-unstyled ">

                    @foreach ($users as $user)
                        <li>
                            <div class="message_box">
                                <span class="icon_hash">
                                    <img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
                                </span>
                              <img  class="avatar" src="{{ $user->profilePicture ? asset('storage/' . $user->profilePicture) : asset('front/admin/assets/images/placeholder_image.jpeg') }}" alt="">

                             
                                <div class="det">
                                <h4>{{$user->name}}</h4>
                                <div class="desg y_txt">{{ $user->designation }}</div>
                                </div>
                                <div class="date">
                                    <span>Joined</span>
                                    <p>{{ \Carbon\Carbon::parse($user->joined)->format('F d, Y') }}</p>
                                </div>
                                <div class="lives_in">
                               <span> LIVES:</span>
                               <p>{{ $user->lives }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach            

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection