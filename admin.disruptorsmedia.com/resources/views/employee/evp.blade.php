@extends('employee/partials/master')
@section('content')
<section class="secAbout secWithNav">
			<div class="container-fluid">
			@include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-8">
						<div class="bord_box d-flex justify-content-between align-items-center exp_box">
							<img src="{{asset('front/assets/images/round.png')}}" alt="">
							<div class="cont">
								<strong>Employee Enrollment Guide - LT Trust</strong>
								<p>Congratulations! Your company decided to offer a 401(k) as an employee benefit because they care about your future.</p>
								
							</div>
							<a href="javascript:;" class="theme_btn text-uppercase"><i class="fa-solid fa-download"></i>Explore</a>
						</div>
						<div class="evp_tabs bord_box">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="tabbable-panel">
											<div class="tabbable-line">
												<ul class="nav nav-tabs ">
													<li class="active">
														<a href="#tab_default_1" class="active" data-toggle="tab">
														Flexibility  </a>
													</li>
													<li>
														<a href="#tab_default_2" data-toggle="tab">
														Wages </a>
													</li>
													<li>
														<a href="#tab_default_3" data-toggle="tab">
														Family & Recognition </a>
													</li>
													<li>
														<a href="#tab_default_4" data-toggle="tab">
														Career growth</a>
													</li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane container active" id="tab_default_1">
														<div class="row">
															<div class="col-md-8">
																<p>
																	<h4>Flexibility </h4>
																</p>
																<p>
																	Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
																	<br>
																	Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
																</p>
																<ul>
																	<li class="d-flex justify-content-between"><strong class="w-25">Part time</strong>Sed ut perspiciatis unde omnis iste natus.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Flexitime</strong>Magni dolores eos qui ratione voluptatem sequi.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Compressed hours</strong>Architecto beatae vitae dicta sunt explicabo. </li>
																</ul>
															</div>
															<div class="col-md-4">
																<img src="{{asset('front/assets/images/side_bar.png')}}" alt="">
															</div>
														</div>
													</div>
													<div class="tab-pane container" id="tab_default_2">
														<div class="row">
															<div class="col-md-8">
																<p>
																	<h4>Wages </h4>
																</p>
																<p>
																	Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
																	<br>
																	Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
																</p>
																<ul>
																	<li class="d-flex justify-content-between"><strong class="w-25">Part time</strong>Sed ut perspiciatis unde omnis iste natus.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Flexitime</strong>Magni dolores eos qui ratione voluptatem sequi.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Compressed hours</strong>Architecto beatae vitae dicta sunt explicabo. </li>
																</ul>
															</div>
															<div class="col-md-4">
																<img src="{{asset('front/assets/images/side_bar.png')}}" alt="">
															</div>
														</div>
													</div>
													<div class="tab-pane container" id="tab_default_3">
														<div class="row">
															<div class="col-md-8">
																<p>
																	<h4>Family & Recognition </h4>
																</p>
																<p>
																	Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
																	<br>
																	Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
																</p>
																<ul>
																	<li class="d-flex justify-content-between"><strong class="w-25">Part time</strong>Sed ut perspiciatis unde omnis iste natus.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Flexitime</strong>Magni dolores eos qui ratione voluptatem sequi.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Compressed hours</strong>Architecto beatae vitae dicta sunt explicabo. </li>
																</ul>
															</div>
															<div class="col-md-4">
																<img src="{{asset('front/assets/images/side_bar.png')}}" alt="">
															</div>
														</div>
													</div>
													<div class="tab-pane container" id="tab_default_4">
														<div class="row">
															<div class="col-md-8">
																<p>
																	<h4>Career growth </h4>
																</p>
																<p>
																	Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
																	<br>
																	Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
																</p>
																<ul>
																	<li class="d-flex justify-content-between"><strong class="w-25">Part time</strong>Sed ut perspiciatis unde omnis iste natus.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Flexitime</strong>Magni dolores eos qui ratione voluptatem sequi.</li>
																	<li class="d-flex justify-content-between"><strong class="w-25">Compressed hours</strong>Architecto beatae vitae dicta sunt explicabo. </li>
																</ul>
															</div>
															<div class="col-md-4">
																<img src="{{asset('front/assets/images/side_bar.png')}}" alt="">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="bord_box">
							<h3>
							Proposition & benefits
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
							</h3>
							<div class="office_box">
								<div class="head_off">
									<div class="thumb">
										<img src="{{asset('front/assets/images/icon_heart.png')}}" alt="">
									</div>
									<div class="info">
										<h4>Health and safety for you <br>and your people </h4>
										<p>
											<span class="nbr">
												<span class="icon"><i class="fa-solid fa-phone"></i></span>
												<a href="tel:(201-325-0999)">201-325-0999</a>
											</span>
											<span class="time">Open 9-5pm</span>
										</p>
									</div>
								</div>
								<p class="loct">513 Summit Ave Union City NJ 07087 <span class="icon"><i class="fa-solid fa-location-dot"></i></span></p>
								<span class="icon_hash icon_download">
									<i class="fa-solid fa-download"></i>
								</span>
							</div>
							<div class="adresses">
								<h4>Street Adresses</h4>
								<div class="custom_scroll">
									<ul>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
											</span>
										</li>
										<li>
											<h5>1928 Milagro Corporation 913 18th ave Newark</h5>
											<div class="info">
												<span class="nbr">
													<span class="icon_call"><i class="fa-solid fa-phone"></i></span>
													<a href="tel:(973-371-2876)">973-371-2876</a>
												</span>
												<span class="icon"><i class="fa-solid fa-location-dot"></i></span>
											</div>
											<span class="icon_hash">
												<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
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