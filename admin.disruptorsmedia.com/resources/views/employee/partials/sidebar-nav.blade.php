<div class="sidebar">
	<div class="menu">
		<ul>
			<li class="nav-item active">
				<a href="{{route('dashboard')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_1.png')}}" alt="">
				</span>
				<span class="txt">Home</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('about')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_2.png')}}" alt="">
				</span>
				<span class="txt">About</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('evp')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_3.png')}}" alt="">
				</span>
				<span class="txt">Benefits</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('benefits')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_4.png')}}" alt="">
				</span>
				<span class="txt">Manager Benefits</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('pay_structure')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_5.png')}}" alt="">
				</span>
				<span class="txt">Pay Structure</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('events')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/assets/images/nav_icon_6.png')}}" alt="">
				</span>
				<span class="txt">Events</span>
				</a>
			</li>
		</ul>
	</div>
	<div class="side_qr">
		<a href="javascript:;">
			<span class="icon">
				<img src="{{asset('front/assets/images/side_qr.png')}}" alt="">
								
			</span>
			<span class="txt">scan <br>QR Codes</span>
		</a>
	</div>
    <div class="logout">
        <a href="{{ route('logout') }}">
            <span class="icon">
                <img src="{{ asset('front/assets/images/icon_logout.png') }}" alt="">
            </span>
        </a>
    </div>
</div>