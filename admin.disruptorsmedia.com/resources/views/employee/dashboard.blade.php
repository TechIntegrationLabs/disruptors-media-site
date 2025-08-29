@extends('employee/partials/master')
@section('content')
<section class="secDashboard secWithNav">
		<div class="container-fluid">
			@include('employee/partials/sidebar-nav')

			<div class="row">
				<div class="col-12 col-md-4">
					<div class="user_info">
						<div class="back_cover">
							<img src="{{asset('front/assets/images/back_cover.png')}}" alt="">
						</div>
						<div class="info">
							<div class="avatar">
								<img src="{{asset('front/assets/images/user.png')}}" alt="">
							</div>
							<div class="txt">
								<h3>{{ Auth::user()->name }}</h3>
								<p>ID: {{ Auth::user()->id }}</p>
							</div>
						</div>
						<div class="descp">
							<ul>
								<li>
									<strong>Designation</strong>
									{{ Auth::user()->designation }}
								</li>
								<li>
									<strong>Phone</strong>
									<a href="tel:(+ (012) 345 6789)">+ 	{{ Auth::user()->phoneNumber }}</a>
								</li>
								<li>
									<strong>Email</strong>
									<a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a>
								</li>
								<li>
									<strong>Address</strong>
									1693 Alice Court, Annapolis MD 21401
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-5">
					<div class="announcements">
						<h3>
							<span class="icon">
								<img src="{{asset('front/assets/images/icon-announce.png')}}">
							</span>
							Announcements
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
						</h3>
						<div class="custom_scroll">
							<ul>
								<li>
									Reimbursement document submission due in 3 days
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li class="with_icon">
									<span class="icon">
										<i class="fa-regular fa-calendar-days"></i>
									</span>
									Time and attendance indicator
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Sed ut perspiciatis - Unde omnis
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Reimbursement document submission
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li class="with_icon">
									<span class="icon">
										<i class="fa-regular fa-calendar-days"></i>
									</span>
									Time and attendance indicator
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Reimbursement document submission due in 3 days
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Reimbursement document submission due in 3 days
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li class="with_icon">
									<span class="icon">
										<i class="fa-regular fa-calendar-days"></i>
									</span>
									Time and attendance indicator
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Sed ut perspiciatis - Unde omnis
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Reimbursement document submission due in 3 days
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Reimbursement document submission due in 3 days
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li class="with_icon">
									<span class="icon">
										<i class="fa-regular fa-calendar-days"></i>
									</span>
									Time and attendance indicator
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
								<li>
									Sed ut perspiciatis - Unde omnis
									<span class="schedule">20 October 2023 - 10:30 am</span>
									<a href="javascript:;" class="go_to">
										<i class="fa-solid fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="events_widget">
						<h3>
							Event & Calendar
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
							</span>
						</h3>
						<div class="calander">
							<!-- <img src="{{asset('front/assets/images/calander.png')}}" alt=""> -->
						      <div class="month">
						        <i class="fas fa-angle-left prev"></i>
						        <div class="date">
						          <h1></h1>
						          <p></p>
						        </div>
						        <i class="fas fa-angle-right next"></i>
						      </div>
						      <div class="weekdays">
						        <div>Sun</div>
						        <div>Mon</div>
						        <div>Tue</div>
						        <div>Wed</div>
						        <div>Thu</div>
						        <div>Fri</div>
						        <div>Sat</div>
						      </div>
						      <div class="days"></div>
						</div>
						<div class="events_schedule">
							<h4>Schedule <span class="counter">(3)</span></h4>
							<div class="custom_scroll">
								<ul class="evt_list">
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
									<li>
										Invitation - joining must
										<span class="schedule">20 October 2023 at 10:30 am</span>
										<span class="icon_hash">
											<img src="{{asset('front/assets/images/icon_hash.png')}}">
										</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    @endsection