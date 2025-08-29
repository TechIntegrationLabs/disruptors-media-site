<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$title}}</title>
	 @include('employee/partials/head') 
</head>
<body>
	<section class="secLogin" style="background-image: url('{{'front/assets/images/login_bg.png'}}');">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-md-5">
					<div class="loing_form">
						<div class="txt">
							<h1>Welcome to Quintana <br><span class="clr_yellow">McDonald's</span></h1>
							<p>Log In to your account</p>
						</div>
						<form action="" method="post" class="login" autocomplete="false">
							<div class="input-field">
								<label for="email">Email Address</label>
								<span class="field icon_email">
									<input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
								</span>
							</div>
							<div class="input-field">
								<label for="password">Password</label>
								<span class="field icon_password">
									<input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
								</span>
								<p class="forgot_password">
									<a href="javascript:;" class="link">Forgot password?</a>
								</p>
								<span id="successMessage"></span>
								<span id="passwordError"></span>	
							</div>
							<div class="ip-btn">
								<!-- <input type="submit" name="submit" value="Login" class="btn btn_submit"> -->
								<a href="{{route('dashboard')}}" class="btn btn_submit">Login</a>
							</div>
						</form>		
						<div class="dont_have">
							<p>Don't have an account? <a href="javascript:;">Register</a></p>
						</div>				
					</div>
				</div>
				<div class="col-12 col-md-7">
					<div class="logo">
						<img src="{{asset('front/assets/images/logo.png')}}" alt="Logo">
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function () {
    $('#password').on('keyup', function () {
 
        var email = $('#email').val();
        var password = $(this).val();


        if (password.trim() === '') {
            $('#passwordError').html('Password is required.');
            return;
        } else {
            $('#passwordError').text('');
        }


        $.ajax({
            type: 'POST',
            url: '{{ route('checkCredentials') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'email': email,
                'password': password
            },
            success: function (response, textStatus, xhr) {
                if (xhr.status === 200) {
                    // Success response
                    $('#passwordError').text('');
                    $('#successMessage').html(response.message);
                    $('.login_btn').show();
                } else {
                    // Error response with status code 200 (this might be an unexpected case)
                    $('#passwordError').html(response.error);
                    $('#successMessage').text('');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                // AJAX request failed
                if (xhr.status === 401) {
                    // Unauthorized (invalid password) response
                    $('#passwordError').html("Invalid Email Or Password.");
                } else {
                    // Other errors
                    console.error("Error:", xhr.responseText);
                    $('#passwordError').text('An error occurred while processing the request.');
                }
                $('#successMessage').text('');
            }
        });
    });
});






</script>
</body>
</html>