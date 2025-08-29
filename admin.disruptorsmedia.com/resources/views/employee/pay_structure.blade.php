@extends('employee/partials/master')
@section('content')
<section class="secPay secWithNav">
		<div class="container-fluid">
            @include('employee/partials/sidebar-nav')
        <div class="row">
				<div class="col-12 col-md-4">
					<div class="bord_box">
						<h3>
							Organization people structure
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
							</span>
						</h3>
						<div class="custom_scroll people_box">
							<ul class="people_list">
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_1.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_2.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_3.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_4.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_5.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_1.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_2.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_3.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_4.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
								<li>
									<img class="thumb" src="{{asset('front/assets/images/people_5.png')}}" alt="">
									<h4>John doe</h4>
									<p>Assistant manager</p>
									<span class="icon_hash">
										<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
									</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="bord_box bord_bg">
						<h4 class="text-center">If you have not received a satisfactory response after reporting the incident.</h4>
						<div class="ct_info">
							<p>Please contact <br>Main Office</p>
							<a href="tel:(201-325-0999)"><span class="icon"><i class="fa-solid fa-phone"></i></span>201-325-0999.</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-5">
					<div class="announcements">
						<h3>
							<span class="icon">
								<img src="{{asset('front/assets/images/icon-announce')}}.png">
							</span>
							Organization pay structure
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
						</h3>
						<div class="custom_scroll">
							<ul>
								<li>
									EXEMPT
									<p>Exempt employees are paid on a salaried basis and are not eligible to receive overtime pay.</p>
								</li>
								<li>
									NONEXEMPT
									<p>Nonexempt employees are paid on an hourly basis and are eligible to receive overtime pay for overtime hours worked.</p>
								</li>
								<li>
									FULL-TIME EMPLOYEES
									<p>Regular full-time employees are those who are scheduled for and do work 30 or more hours per week.  </p>
								</li>
								<li>
									PART-TIME EMPLOYEES
									<p>Regular part-time employees are those scheduled for and work less than 30 hours per week</p>
								</li>
								<li>
									<h2>Salary basis safe harbor provision for exempt employees</h2>
									<h4>Exempt Employees</h4>
									<p>The Company designates each employee as either exempt or nonexempt in compliance with applicable federal and state law. Employees who are designated as exempt are paid a fixed salary regardless of the number of hours worked each week and are not entitled to overtime pay. The Company will not take any deductions from exempt employees' salaries except those allowed by applicable federal and state law. </p>
									<h4>Complaints</h4>
									<p>You should review each paycheck for errors. If you have questions about any deductions from your pay, believe improper deductions have been made from your pay, or believe that your pay is otherwise incorrect, you must report your concern to your manager or owner/operator immediately. The Company will promptly investigate all complaints of paycheck errors. If the Company has taken any improper deductions from your pay, or otherwise made any errors in paying you, it will promptly take corrective action, including reimbursing you for any improper deductions as soon as practicable. In addition, the Company will take reasonable steps to ensure that the error does not recur in the future. </p>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-3">
					<div class="bord_box">
						<div class="payday" style="background-image: url('assets/images/payday_bg.png');">
							<h4>Get That Payday Feeling <br>Whenever You Want!</h4>
							<div class="qr_text">
								<p>Fast  .  Flexible  .  Affordable</p>
								<img src="{{asset('front/assets/images/qr_payday.png')}}" alt="">
							</div>
						</div>
					</div>
					<div class="bord_box events_schedule">
						<h3>
							Pay history
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}" alt="">
							</span>
						</h3>
						<div class="custom_scroll">
							<ul class="evt_list">
								<li>
									<div class="invoice">
										<h4>Invoice#52311723</h4>
										<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
									</div>
									<div class="status_date">
										<p class="status yellow">
											Pending
										</p>
										<p class="date">20 October 2023</p>
									</div>
								</li>
								<li>
									<div class="invoice">
										<h4>Invoice#52311723</h4>
										<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
									</div>
									<div class="status_date">
										<p class="status green">
											Success
										</p>
										<p class="date">20 October 2023</p>
									</div>
								</li>
								<li>
									<div class="invoice">
										<h4>Invoice#52311723</h4>
										<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
									</div>
									<div class="status_date">
										<p class="status green">
											Success
										</p>
										<p class="date">20 October 2023</p>
									</div>
								</li>
								<li>
									<div class="invoice">
										<h4>Invoice#52311723</h4>
										<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
									</div>
									<div class="status_date">
										<p class="status green">
											Success
										</p>
										<p class="date">20 October 2023</p>
									</div>
								</li>
								<li>
									<div class="invoice">
										<h4>Invoice#52311723</h4>
										<a href="javascript:;" class="download"><i class="fa-solid fa-download"></i></a>
									</div>
									<div class="status_date">
										<p class="status green">
											Success
										</p>
										<p class="date">20 October 2023</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection