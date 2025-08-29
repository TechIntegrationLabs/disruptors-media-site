@extends('admin/partials/master')
@section('content')
<section class="secQrCodes secBenefits ">
			<div class="container-fluid">
				<div class="row">
                <div class="col-lg-9">
						<div class="announcements">
							<h3>
								<span class="icon">
									<img src="{{asset('front/admin/assets/images/head_qr_icon.png')}}">
								</span>
								Scan QR Codes
								<span class="icon_hash">
									<img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
								</span>
							</h3>
							<div class="custom_scroll qr_area">
								<div class="head_qr row">
									<div class="col-12 col-md-4 qr_left_anime">
										<img src="{{asset('front/admin/assets/images/qr_left_anime.png')}}" alt="">
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
										<img src="{{asset('front/admin/assets/images/qr_right_anime.png')}}" alt="">
									</div>
								</div>
								<div class="list_qr_codes">
									<h4>Scan QR Codes</h4>
									<ul>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
												<h5>Next iPhone</h5>
											</div>
										</li>
										<li>
											<div class="qr_box">
												<img src="{{asset('front/admin/assets/images/qr_list_1.png')}}" alt="">
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
					<div class="col-12 col-md-3">
						<div class="bord_box side_img">
						
							<div class="side_img">
								<img src="{{asset('front/admin/assets/images/qr_side.png')}}" alt="">
								
							</div>

						
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection