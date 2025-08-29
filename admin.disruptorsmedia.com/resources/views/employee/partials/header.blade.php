<header class="header" id="masthead">
	<div class="container-fluid">
		<nav class="navbar d-flex">
			<div class="navbar-brand">
				<a href="javascript:;">
					<img src="{{asset('front/assets/images/head_logo.png')}}" alt="Logo">
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
					<a href="{{route('messages')}}" class="message">
						<img src="{{asset('front/assets/images/icon_message.png')}}" alt="">
					</a>
					<a href="{{route('notification')}}" class="notifications">
						<img src="{{asset('front/assets/images/icon-notification.png')}}" alt="">
					</a>
					<a href="javascript:;" class="employee">
						<img src="{{asset('front/assets/images/user_avatar.png')}}" alt="">
						Jhone Doe
						<span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
					</a>
					<a href="{{route('qrcode')}}" class="head_qr">
						<img src="{{asset('front/assets/images/head_qr.png')}}" alt="">
					</a>					
				</div>
			</div>
		</nav>
	</div>
</header>