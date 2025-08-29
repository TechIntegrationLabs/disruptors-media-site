<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    @include('employee/partials/head')
</head>
<body>
    <section class="secLogin" style="background-image: url('{{ 'front/assets/images/login_bg.png' }}');">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="loing_form">
                        <div class="txt">
                            <h1>Welcome to Quintana <br><span class="clr_yellow">McDonald's</span></h1>
                            <p>Log In to your account</p>
                        </div>
                        <form id="loginForm" action="{{ route('admin.checkCredentials') }}" method="post">
                            @csrf
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
                                <button type="button" id="loginBtn" class="btn btn_submit">Login</button>
                            </div>
                        </form>
                        <div class="dont_have">
                            <p>Don't have an account? <a href="javascript:;">Register</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="logo">
                        <img src="{{ asset('front/assets/images/logo.png') }}" alt="Logo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
$(document).ready(function () {
    $('#loginBtn').click(function () {
        var email = $('#email').val();
        var password = $('#password').val();

        if (password.trim() === '') {
            $('#passwordError').html('Password is required.');
            return;
        } else {
            $('#passwordError').text('');
        }

        $.ajax({
            type: 'POST',
            url: '{{ route('admin.checkCredentials') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'email': email,
                'password': password
            },
            success: function (response, textStatus, xhr) {
    if (xhr.status === 200) { // Success status
        $('#passwordError').text('');
        $('#successMessage').html(response.message);

        // Check if the response contains a redirect location
        if (response.redirect) {
            window.location.href = response.redirect; // Use the correct property name
        }
    } else {
        $('#passwordError').html(response.error);
        $('#successMessage').text('');
    }
},
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status === 401) {
                    $('#passwordError').html("Invalid Email Or Password.");
                } else {
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
