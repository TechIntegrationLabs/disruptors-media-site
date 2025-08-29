@extends('employee/partials/master')
@section('content')
<section class="secMessages secWithNav">
			<div class="container-fluid">
				@include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="bord_box half_bord">
							<h3>
							Messages
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
							</h3>
							<div class="search_message search_div">
								<form action="">
									<div class="field">
										<input type="text" class="form-control" name="search" id="search_message" placeholder="Search..">
									</div>
								</form>
							</div>
							<div class="message_list">
								<ul>
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
									<li>
										<div class="message_box">
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}">
											</span>
											<img class="avatar" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
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
								</ul>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-8">
						<div class="announcements half_bord bg_red">
							<h3>
								<span class="icon">
									<img src="{{asset('front/assets/images/head_qr_icon.png')}}">
								</span>
								Scan QR Codes
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}">
								</span>
							</h3>
							<div class="row msg_profile">
								<div class="col-12 col-md-7">
									<div class="message_area">
										<div class="msg_block recieve">
											<div class="thumb">
												<img src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
											</div>
											<div class="t_block">
												<p>Sed ut perspiciatis unde omnis iste natus <br> error sit voluptatem</p>
											</div>
										</div>
										<div class="msg_block sent">
											<div class="t_block">
												<p>Totam rem aperiam, eaque ipsa quae ab illo <br> inventore veritatis et quasi architecto</p>
											</div>
											<div class="thumb">
												<img src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
											</div>
										</div>
										<div class="time_stamp">
											<span class="time">Sep 4</span>
										</div>
										<div class="msg_block recieve">
											<div class="thumb">
												<img src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
											</div>
											<div class="t_block">
												<p>unde omnis iste <br> natus error</p>
											</div>
										</div>
										<div class="msg_block sent">
											<div class="t_block">
												<p>Inventore veritatis et <br> quasi architecto.</p>
											</div>
											<div class="thumb">
												<img src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
											</div>
										</div>
										<div class="type_message">
											<input type="text" class="form-control" name="type_message" placeholder="Your Message">
											<input type="submit" name="submit" class="btn_submit" value="">
										</div>
									</div>
								</div>
								<div class="col-12 col-md-5">
									<div class="bord_box half_bord text-center">
										<img src="{{asset('front/assets/images/prof_bg.png')}}" alt="">
									</div>
									<div class="profile_box">
										<div class="thumb">
											<img src="{{asset('front/assets/images/user_profile.png')}}" alt="">
										</div>
										<div class="ctn text-center">
											<p>John doe</p>
											<p class="clr-yellow">Lorem Ipsum</p>
										</div>
										<div class="email">
											<a href="mailto:(johndoe@gmail.com)">johndoe@gmail.com</a>
										</div>
										<div class="notes">
											<p>
												<strong>Note:</strong>
												Sed ut perspiciatis unde omnis iste natus error sit.
											</p>
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