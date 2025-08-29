<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>{{ $title }}</title>
		<meta charset="utf-8" />
		<meta name="description" content="Distruptors Admin Panel" />
		<meta name="keywords" content="Distruptors Admin Panel" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Distruptors Admin Panel" />
		<meta property="og:url" content="{{ $title }}" />
		<meta property="og:site_name" content="{{ $title }}" />
		<link rel="canonical" href="{{ config('app.url') }}" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/logo.svg') }}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
			
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
						    
						    <div class="text-center mb-10">
						    
    						    <a href="{{ route('admin-login') }}" class="py-9 mb-5">
    								<img alt="Logo" src="{{ asset('assets/media/logos/logo.svg') }}" class="h-60px" />
    							</a>
    							<!--end::Logo-->
    							<!--begin::Title-->
    							
    						    
						    </div>
						    
							<!--begin::Form-->
							<form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('admin.checkCredentials') }}">
								<!--begin::Heading-->
                                @csrf
								<!--begin::Heading-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Label-->
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" id="email" type="text" name="email" autocomplete="off" />
										@error('email')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
									<!--end::Input-->
								</div>
								<!--end::Input group-->
								<!--begin::Input group-->
								<div class="fv-row mb-10">
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack mb-2">
										<!--begin::Label-->
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
										<!--end::Label-->
										<!--begin::Link-->
										
										<!--end::Link-->
                                        <span id="successMessage"></span>
                                         <span id="passwordError"></span>
									</div>
									<!--end::Wrapper-->
									<!--begin::Input-->
									<input class="form-control form-control-lg form-control-solid" id="password" type="password" name="password" autocomplete="off" />
									<!--end::Input-->
									<div class="text-end">
									<a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
									</div>
									@error('password')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
								</div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="loginBtn" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Sign In</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<!--end::Footer-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>