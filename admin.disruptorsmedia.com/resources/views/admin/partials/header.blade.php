<header class="header admin_head" id="masthead">
	<div class="container-fluid">
		<nav class="navbar d-flex">
			<div class="navbar-brand">
				<a href="javascript:;">
					<img src="{{asset('front/admin/assets/images/head_logo.png')}}" alt="Logo">
				</a>
			</div>
			<div class="nav-content d-flex">
				<h4>Employee dashboard</h4>
				<div class="xtra_link">
					<div class="search_div">
						<form action="">
							<div class="field">
								<input type="text" name="search" id="search" class="form-control" placeholder="Search">
							</div>
						</form>
					</div>
					<a href="javascript:;" class="message">
						<img src="{{asset('front/admin/assets/images/icon_message.png')}}" alt="">
					</a>
					<a href="javascript:;" class="notifications">
						<img src="{{asset('front/admin/assets/images/icon-notification.png')}}" alt="">
					</a>
					<a href="javascript:;" class="employee">
						<img src="{{asset('front/admin/assets/images/user_avatar.png')}}" alt="">
						{{ Auth::user()->username }}
						<span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
					</a>
					<div class="employee_box" style="display: none;">
							<div class="d-flex">
								<div class="img_box">
								<img src="{{asset('front/admin/assets/images/user.png')}}" alt="">
								<a href="javaacript:;"><i class="fa-solid fa-pen"></i></a>
								</div>
								<div class="details_acc">
									<h3>{{ Auth::user()->username }}</h3>
									<hr>
									<ul class="d-flex list-unstyled">
										<li>
											<span>Designation</span>
											<strong>Executive Chef</strong>
										</li>
										<li>
											<span>Email</span>
											<strong>{{ Auth::user()->email }}</strong>
										</li>
									</ul>
									<div class="call_box">
										<div class="d-flex">
                                        <span class="icon"><i class="fa-solid fa-phone"></i>phone</span>
                                        <a href="tel:{{ Auth::user()->phone }}">{{ Auth::user()->phone }}</a>
										</div>
										<span class="icon"><i
                                    class="fa-solid fa-location-dot"></i></span>
									</div>

								</div>
							</div>
						</div>
					<a href="javascript:;" class="head_qr">
						<img src="{{asset('front/admin/assets/images/head_qr.png')}}" alt="">
					</a>
					<div class="head_qr_box" style="display: none;">
					<div class="d-flex">
					<img src="{{asset('front/admin/assets/images/qr_left_anime.png')}}" alt="">
					<div class="cont">
						<h3>How to sign up</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
						<div class="border_box d-flex">
							<div class="cont_cl">
								<strong>Questions?</strong>
								<span>Text us anytime:</span>
							</div>
							<div class="theme_btn">
							<i class="fa-solid fa-phone"></i>855-459-0130
							</div>
						</div>
					</div>
					<img src="{{asset('front/admin/assets/images/qr_right_anime.png')}}" class="qr_img" alt="">
					</div>
				</div>
				</div>
			</div>
		</nav>
	</div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" ></script>
<script>
$('.nav-content a.head_qr').click(function() {
    $('.head_qr_box').toggle();
});
$('.employee').click(function() {
    $('.employee_box').toggle();
});

</script>
