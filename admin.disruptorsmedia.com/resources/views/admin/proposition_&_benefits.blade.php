@extends('admin/partials/master')
@section('content')
<section class="secBenefits">
			<div class="container-fluid">
				<div class="row">
                <div class="col-lg-9">
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
                            <div class="d-flex justify-content-between ">
                            <h2>Swing Manager</h2>
                                <div class="btn_ben">
                                <a href="javascript:;" class="theme_btn ">Edit</a>
                                <a href="javascript:;" class="theme_btn ">Delete</a>
                                </div>
                            </div>
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
							<div class="d-flex tagline">
								<h4>Swing manager benefits</h4>
								<p>Magni dolores eos qui ratione voluptatem sequi.</p>
							</div>
                          
						</div>
						<div class="bord_box post_benefits">
                        <div class="d-flex justify-content-between ">
                            <h2>General manager</h2>
                                <div class="btn_ben">
                                <a href="javascript:;" class="theme_btn ">Edit</a>
                                <a href="javascript:;" class="theme_btn ">Delete</a>
                                </div>
                            </div>
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
					<div class="col-12 col-md-3">
						<div class="bord_box side_img">
						
							<div class="side_img">
								<img src="{{asset('front/admin/assets/images/ben_side.png')}}" alt="">
								
							</div>

						
						</div>
					</div>
				</div>
			</div>
		</section>
        @endsection