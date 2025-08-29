@extends('employee/partials/master')
@section('content')
<section class="secNotifications secWithNav">
			<div class="container-fluid">
				@include('employee/partials/sidebar-nav')
				<div class="announcements notify half_bord">
					<h3>
						<span class="icon">
							<img src="{{asset('front/assets/images/icon_notify.png')}}">
						</span>
						Notifications
						<span class="icon_hash">
							<img src="{{asset('front/assets/images/icon_hash.png')}}">
						</span>
					</h3>
					<div class="notify_search">
						<p>You have 6 notifications to go through</p>
						<div class="search_div">
							<form action="">
								<div class="field">
									<input type="text" class="form-control" name="search" id="search_message" placeholder="Search..">
								</div>
							</form>
						</div>
					</div>
					<div class="custom_scroll">
						<div class="notify_list">
							<h5>Today</h5>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">1h ago</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">2h ago</span>
							</div>
						</div>
						<div class="notify_list">
							<h5>Yesterday</h5>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">Yesterday</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">Yesterday</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">Yesterday</span>
							</div>
						</div>
						<div class="notify_list">
							<h5>20. October</h5>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">20. October</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">20. October</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">20. October</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">20. October</span>
							</div>
							<div class="notify_box">
								<img class="thumb" src="{{asset('front/assets/images/message_avatar.png')}}" alt="">
								<h4>Drone survey results</h4>
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
								</span>
								<span class="time_ago">20. October</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection