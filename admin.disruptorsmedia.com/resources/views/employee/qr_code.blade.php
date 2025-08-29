@extends('employee/partials/master')
@section('content')
<section class="secQrCodes secBenefits secWithNav">
			<div class="container-fluid">
				@include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-8">
						<div class="announcements">
							<h3>
								<span class="icon">
									<img src="{{asset('front/assets/images/head_qr_icon.png')}}">
								</span>
								Scan QR Codes
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}">
								</span>
							</h3>
							<div class="custom_scroll qr_area">
								<div class="head_qr row">
									<div class="col-12 col-md-4 qr_left_anime">
										<img src="{{asset('front/assets/images/qr_left_anime.png')}}" alt="">
									</div>
									<div class="col-12 col-md-5">
										<div class="ctn">
											<h4>How to Sign Up</h4>
											<p>Scan the QR Code or visit app.onaroll.co/ <br>login to access your account!</p>
											<div class="ct_info">
												<p>
													<strong>Questions?</strong>
													Text us anytime:
												</p>
												<a href="tel:(855-459-0130)">
													<span class="icon"><i class="fa-solid fa-phone"></i></span>
													855-459-0130
												</a>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-3 qr_right_anime">
										<img src="{{asset('front/assets/images/qr_right_anime.png')}}" alt="">
									</div>
								</div>
								<div class="list_qr_codes">
									<h4>Scan QR Codes</h4>
									<ul>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box empty">
												
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="bord_box">
							<h3>
							Crew benefits
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
							</h3>
							<div class="office_box">
								<img src="{{asset('front/assets/images/logo.png')}}" alt="">
								<h4>
									AKE <br>
									ORE <br>
									ONEY!
								</h4>
							</div>

							<div class="grab">
								<h2>Grab extra shifts, make more money!</h2>
								<p><span class="count">01</span>Get more hours & earn shift bonuses! </p>
								<p><span class="count">02</span>Find help covering your shifts when you can’t work </p>
								<p><span class="count">03</span>See your schedule on your phone </p>
								<p><span class="count">04</span>Communicate with everyone in your store </p>
							</div>
							<div class="qr_codes">
								<div class="iphone">
									<img src="{{asset('front/assets/images/qr_iphone.png')}}" alt="">
									<p>Iphone (iOS)</p>
								</div>
								<div class="iphone">
									<img src="{{asset('front/assets/images/qr_andriod.png')}}" alt="">
									<p>Android</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection