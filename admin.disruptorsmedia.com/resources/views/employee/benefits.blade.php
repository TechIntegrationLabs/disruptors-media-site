@extends('employee/partials/master')
@section('content')
<section class="secBenefits secWithNav">
			<div class="container-fluid">
			@include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-8">
						<div class="bord_box head_off">
							<h2 class="head_download">
								<span class="icon">
									<img src="{{asset('front/assets/images/crew_trainer.png')}}" alt="">
								</span>
								Crew trainer requirements
								<a href="javascript:;" class="download">
									<i class="fa-solid fa-download"></i>
								</a>
							</h2>
						</div>
						<div class="bord_box post_benefits">
							<h2>Swing Manager</h2>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
							<div class="d-flex tagline">
								<h4>Swing manager benefits</h4>
								<p>Magni dolores eos qui ratione voluptatem sequi.</p>
							</div>
						</div>
						<div class="bord_box post_benefits">
							<h2>General Manager</h2>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
							<div class="d-flex tagline">
								<h4>General manager benefits</h4>
								<p>Magni dolores eos qui ratione voluptatem sequi.</p>
							</div>
							<div class="d-flex tag_download">
								<h4>Download</h4>
								<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
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