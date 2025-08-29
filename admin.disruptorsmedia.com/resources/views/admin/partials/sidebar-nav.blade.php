<div class="sidebar_admin">
	<div class="menu">
		<span class="icon_hash">
			<img src="{{asset('front/admin/assets/images/icon_hash.png')}}">
		</span>
		<ul class="list-unstyle m-0 p-0">
			<hr>
			<strong>Main</strong>
			<li class="nav-item active">
				<a href="{{route('admindashboard')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/Icon _box.png')}}" alt="">
				</span>
				<span class="txt">Dashboard</span>
				</a>
			</li>
			<hr>
				<strong>User Management</strong>
			<!--<li class="nav-item ">-->
			<!--	<a href="{{route('/admin/adduser')}}" class="nav-link">-->
			<!--	<span class="icon">-->
			<!--		<img src="{{asset('front/admin/assets/images/nav_icon_5.png')}}" alt="">-->
			<!--	</span>-->
			<!--	<span class="txt">Employee</span>-->
			<!--	</a>-->
			<!--</li>-->
			<li class="nav-item ">
				<a href="{{route('/admin/all_user')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/nav_icon_5.png')}}" alt="">
				</span>
				<span class="txt">Employees</span>
				</a>
			</li>
			<hr>
			<strong>Web apps</strong>
			
			<li class="nav-item">
				<a href="{{route('allevents')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/icon_cal.png')}}" alt="">
				</span>
				<span class="txt">Event & Calendar</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('/admin/qr_code')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/Icon_qrcode.png')}}" alt="">
				</span>
				<span class="txt">QR Code</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('/admin/gallery')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/Icon_qrcode.png')}}" alt="">
				</span>
				<span class="txt">Gallery</span>
				</a>
			</li>
			<li class="nav-item">
				<a href="{{route('/admin/newsletter')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/Icon_qrcode.png')}}" alt="">
				</span>
				<span class="txt">News Letter</span>
				</a>
			</li>
			
			<li class="nav-item">
				<a href="{{route('/admin/benefits')}}" class="nav-link">
				<span class="icon">
					<img src="{{asset('front/admin/assets/images/nav_icon_3.png')}}" alt="">
				</span>
				<span class="txt">Proposition & benefits</span>
				</a>
			</li>
			
		</ul>
        <div class="logout">
            <a href="{{ route('admin.logout') }}">
                <span class="icon">
                    <img src="{{ asset('front/assets/images/icon_logout.png') }}" alt="">
                </span>
            </a>
        </div>
	</div>
</div>