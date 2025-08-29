@extends('employee/partials/master')
@section('content')
<section class="secAbout secWithNav">
			<div class="container-fluid">
				@include('employee/partials/sidebar-nav')
				<div class="row">
					<div class="col-12 col-md-8">
						<div class="bord_box slider_col">
							<img src="{{asset('front/assets/images/abt_vector.png')}}" alt="">
							<h2>This is our story and how we began</h2>
							<p>How it all began... Back in 1992 Celest & Joe Quintana took a leap of faith and decided to start their training to open their first McD restaurant in North Bergen NJ. Now over 30 years later they own and operate 10 restaurants with their family in Essex, Hudson and Morris county. Celest was born a Spanish Immigrant who migrated to the US at 9 years old and was raised in Newark NJ where she met her husband Joe. Joe was also born and migrated from Brazil at the age of 10. They lived backyard to backyard in the Ironbound section of Newark NJ. They left careers as an entreprenuer in the clothing world and architect to start mcdonalds. They have 5 children(Jessica, Nelson, Joe, Dana & Fabiana) plus 6 beautiful grandchildren. Four of their children are now in the business and running the day to day operations. Jessica is an Owner operator while Nelson and Joe run the maintenace program. The youngest Fabiana works in a restaurant and helps with organization special events. You can see all present daily running the restaurants! They are all proud and strive daily to keep the McDonalds arches bright. They have a passion for people and running great restaurants</p>
							<img src="{{asset('front/assets/images/arrow_btm.png')}}" alt="">
						</div>
						<div class="bord_box about_tabs">
							<h3>
							Offices
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
							</h3>
							<!-- Demo header-->
							<section class="header about_offices_tabs custom_scroll">
								<div class="container py-4">
								    <div class="nav_lang">
							            <a href="javascript:;" class="eng_ac active">English</a>
							            <a href="javascript:;" class="spn_ac">Spanish</a>
							        </div>
									<div class="row lang_panel eng_panel active">
										<div class="col-md-3">
											<!-- Tabs nav -->
											<div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
												<div class="nav_head">
													<h3>Quintana Organization Vacation Policy</h3>
												</div>
												<a class="nav-link mb-3 p-3  active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
													<!-- <i class="fa fa-user-circle-o mr-2"></i> -->
													<span class="font-weight-bold">Summary</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
													<!-- <i class="fa fa-calendar-minus-o mr-2"></i> -->
													<span class="font-weight-bold">Eligible Employees</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
													<!-- <i class="fa fa-star mr-2"></i> -->
													<span class="font-weight-bold">Determining Eligibility</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Vacation Usage</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-leave-amount-tab" data-toggle="pill" href="#v-pills-leave-amount" role="tab" aria-controls="v-pills-leave-amount" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Leave Amount & Payment of Vacation Time</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-requesting-vacation-tab" data-toggle="pill" href="#v-pills-requesting-vacation" role="tab" aria-controls="v-pills-requesting-vacation" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Requesting Vacation Time</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-Carryover-tab" data-toggle="pill" href="#v-pills-Carryover" role="tab" aria-controls="v-pills-Carryover" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Carryover</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-pills-no-payout-tab" data-toggle="pill" href="#v-pills-no-payout" role="tab" aria-controls="v-pills-no-payout" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">No Payout at Termination</span>
												<i class="fa-solid fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-9">
											<!-- Tabs content -->
											<div class="tab-content" id="v-pills-tabContent">
												<div class="tab-pane fade  rounded  show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

    												<h4 class="font-italic mb-4">Summary:</h4>
    												<p class=" mb-2">After one year of employment, eligible employees who work an average of 35 hours or more per week will receive one week of paid vacation each year.</p>

												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

													<h4 class="font-italic mb-4">Eligible Employees:</h4>
													<p class=" mb-2">Non-exempt hourly employees (i.e., crew, maintenance workers, and shift managers) who have been employed by the company for 12 months and who work an average of 35 hours per week are eligible.</p>

												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

													<h4 class="font-italic mb-4">Determining Eligibility:</h4>
													<p class=" mb-2">On the employee’s anniversary date each year, the Company will look back at the employee’s average hours worked per week to determine eligibility. The employee must have worked an average of at least 35 hours per week to be eligible.</p>
												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
													<h4 class="font-italic mb-4">Vacation Usage:</h4>
													<p class=" mb-2">Employees can use vacation for any reason. Employees must take their vacation time in full week increments, in accordance with the Company’s workweek/payroll week (Wednesday-Tuesday). Vacation time may not be broken up into individual days. </p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-pills-leave-amount" role="tabpanel" aria-labelledby="v-pills-leave-amount-tab">
													<h4 class="font-italic mb-4">Leave Amount & Payment of Vacation Time:</h4>
													<p class=" mb-2">On the employee’s anniversary date, the Company will advance one week of paid vacation. When the employee takes his/her vacation week off, the employee will be paid an amount equal to the average hours the employee worked per week in the prior year, at the employee’s current hourly rate, and will receive the pay on the next regularly schedule payday.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-pills-requesting-vacation" role="tabpanel" aria-labelledby="v-pills-requesting-vacation-tab">
													<h4 class="font-italic mb-4">Requesting Vacation Time:</h4>
													<p class=" mb-2">Please be aware that, because of business needs and fairness to all of our employees, the Company is not able to automatically guarantee or grant all vacation requests. Employees are required to request the use of their vacation week 45 days prior to the requested date. Typically, requests will granted on a first come first serve basis, taking into consideration other staffing needs and rotation of time off for an around holiday weeks.

													To request to take their vacation week, employees must complete a vacation request form, available from their GM, and which must be returned to the GM.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-pills-Carryover" role="tabpanel" aria-labelledby="v-pills-Carryover-tab">
													<h4 class="font-italic mb-4">Carryover:</h4>
													<p class=" mb-2">At the end of the employee’s 12-month benefit period, the Company will not carryover any unused vacation. Employees must “use it or lose it” with respect to their vacation time each benefit year.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-pills-no-payout" role="tabpanel" aria-labelledby="v-pills-no-payout-tab">
													<h4 class="font-italic mb-4">No Payout at Termination:</h4>
													<p class=" mb-2">At termination of employment, if the employee has not taken his/her vacation week, the employee forfeits the vacation. The Company will not pay out any unused vacation at separation of employment, for any reason.</p>
												</div>
											</div>
										</div>
									</div>
									<div class="row lang_panel spn_panel">
										<div class="col-md-3">
											<!-- Tabs nav -->
											<div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
												<div class="nav_head">
													<h3>Política de Vacaciones de Organización Quintana</h3>
												</div>
												<a class="nav-link mb-3 p-3  active" id="v-pills-Resumen-tab" data-toggle="pill" href="#v-pills-Resumen" role="tab" aria-controls="v-Resumen-home" aria-selected="true">
													<!-- <i class="fa fa-user-circle-o mr-2"></i> -->
													<span class="font-weight-bold">Resumen</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Empleados-elegibles-tab" data-toggle="pill" href="#v-Empleados-elegibles" role="tab" aria-controls="v-Empleados-elegibles" aria-selected="false">
													<!-- <i class="fa fa-calendar-minus-o mr-2"></i> -->
													<span class="font-weight-bold">Empleados elegibles</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Determinar-la-elegibilidad-tab" data-toggle="pill" href="#v-Determinar-la-elegibilidad" role="tab" aria-controls="v-Determinar-la-elegibilidad" aria-selected="false">
													<!-- <i class="fa fa-star mr-2"></i> -->
													<span class="font-weight-bold">Determinar la elegibilidad</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Uso-de-vacaciones-tab" data-toggle="pill" href="#v-Uso-de-vacaciones" role="tab" aria-controls="v-Uso-de-vacaciones" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Uso de vacaciones</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Monto-de-la-licencia-tab" data-toggle="pill" href="#v-Monto-de-la-licencia" role="tab" aria-controls="v-Monto-de-la-licencia" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Monto de la licencia y pago del tiempo de vacaciones</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Solicitar-tiempo-tab" data-toggle="pill" href="#v-Solicitar-tiempo" role="tab" aria-controls="v-Solicitar-tiempo" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Solicitar tiempo de vacaciones</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Continuar-tab" data-toggle="pill" href="#v-Continuar" role="tab" aria-controls="v-Continuar" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Continuar</span>
												<i class="fa-solid fa-arrow-right"></i></a>

												<a class="nav-link mb-3 p-3 " id="v-Sin-pago-tab" data-toggle="pill" href="#v-Sin-pago" role="tab" aria-controls="v-Sin-pago" aria-selected="false">
													<!-- <i class="fa fa-check mr-2"></i> -->
													<span class="font-weight-bold">Sin pago al finalizar</span>
												<i class="fa-solid fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-9">
											<!-- Tabs content -->
											<div class="tab-content" id="v-pills-tabContent">
												<div class="tab-pane fade  rounded  show active p-5" id="v-pills-Resumen" role="tabpanel" aria-labelledby="v-pills-Resumen-tab">

    												<h4 class="font-italic mb-4">Resumen:</h4>
													<p class=" mb-2">Después de un año de empleo, los empleados elegibles que trabajen un promedio de 35 horas o más por semana recibirán una semana de vacaciones pagadas cada año.</p>

												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-Empleados-elegibles" role="tabpanel" aria-labelledby="v-Empleados-elegibles-tab">

													<h4 class="font-italic mb-4">Empleados elegibles:</h4>
													<p class=" mb-2">Son elegibles los empleados por horas no exentos (ej: personal, trabajadores de mantenimiento y jefes de turno) que hayan sido empleados por la empresa durante 12 meses y que trabajen un promedio de 35 horas por semana.</p>

												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-Determinar-la-elegibilidad" role="tabpanel" aria-labelledby="v-Determinar-la-elegibilidad-tab">

													<h4 class="font-italic mb-4">Determinar la elegibilidad:</h4>
													<p class=" mb-2">Cada año, en la fecha del aniversario del empleado, la Compañía revisará el promedio de horas trabajadas por semana del empleado para determinar la elegibilidad. El empleado debe haber trabajado un promedio de al menos 35 horas por semana para ser elegible.</p>
													
												</div>
												
												<div class="tab-pane fade  rounded  p-5" id="v-Uso-de-vacaciones" role="tabpanel" aria-labelledby="v-Uso-de-vacaciones-tab">

													<h4 class="font-italic mb-4">Uso de vacaciones:</h4>
													<p class=" mb-2">Los empleados pueden utilizar las vacaciones por cualquier motivo. Los empleados deben tomar su tiempo de vacaciones en incrementos semanales completos, de acuerdo con la semana laboral/semana de nómina de la Compañía (miércoles a martes). El tiempo de vacaciones no podrá dividirse en días individuales.</p>

												</div>
												<div class="tab-pane fade  rounded  p-5" id="v-Monto-de-la-licencia" role="tabpanel" aria-labelledby="v-Monto-de-la-licencia-tab">

													<h4 class="font-italic mb-4">Monto de la licencia y pago del tiempo de vacaciones:</h4>
													<p class=" mb-2">En la fecha del aniversario del empleado, la Compañía adelantará una semana de vacaciones pagadas. Cuando el empleado se toma su semana libre de vacaciones, se le pagará una cantidad igual al promedio de horas que trabajó por semana durante el año anterior, a la tarifa por hora actual del empleado, y recibirá el pago en el siguiente horario regular. día de paga.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-Solicitar-tiempo" role="tabpanel" aria-labelledby="v-Solicitar-tiempo-tab">
													<h4 class="font-italic mb-4">Solicitar tiempo de vacaciones:</h4>
													<p class=" mb-2">Tenga en cuenta que, debido a las necesidades comerciales y la equidad para todos nuestros empleados, la Compañía no puede garantizar ni otorgar automáticamente todas las solicitudes de vacaciones. Los empleados están obligados a solicitar el uso de su semana de vacaciones con 45 días de antelación a la fecha solicitada. Por lo general, las solicitudes se otorgarán por orden de llegada, teniendo en cuenta otras necesidades de personal y la rotación del tiempo libre durante unas semanas de vacaciones.

													Para solicitar tomar su semana de vacaciones, los empleados deben completar un formulario de solicitud de vacaciones, disponible en su gerente general, y que debe devolverse al gerente general.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-Continuar" role="tabpanel" aria-labelledby="v-Continuar-tab">
													<h4 class="font-italic mb-4">Continuar:</h4>
													<p class=" mb-2">Al final del período de beneficios de 12 meses del empleado, la Compañía no transferirá ninguna vacación no utilizada. Los empleados deben “usarlo o perderlo” con respecto a su tiempo de vacaciones cada año de beneficios.</p>
												</div>

												<div class="tab-pane fade  rounded  p-5" id="v-Sin-pago" role="tabpanel" aria-labelledby="v-Sin-pago-tab">
													<h4 class="font-italic mb-4">Sin pago al finalizar:</h4>
													<p class=" mb-2">Al terminar el empleo, si el empleado no ha tomado su semana de vacaciones, perderá las vacaciones. La Compañía no pagará las vacaciones no utilizadas tras la separación del empleo, por ningún motivo.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="bord_box">
							<h3>
							Offices
							<span class="icon_hash">
								<img src="{{asset('front/assets/images/icon_hash.png')}}">
							</span>
							</h3>
							<div class="office_box">
								<div class="head_off">
									<div class="thumb">
										<img src="{{asset('front/assets/images/logo.png')}}" alt="">
									</div>
									<div class="info">
										<h4>Quintana Office</h4>
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
								<span class="icon_hash">
									<img src="{{asset('front/assets/images/icon_hash.png')}}">
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
												<img src="{{asset('front/assets/')}}images/icon_hash.png" alt="">
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