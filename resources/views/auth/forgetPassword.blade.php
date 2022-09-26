<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forget password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
    <link rel="icon" href="{{asset('home/image/favicon.png')}}" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <script src="https://kit.fontawesome.com/8f48d37969.js" crossorigin="anonymous"></script>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="home/customerLogin/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="home/customerLogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="home/customerLogin/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('home/image/home1.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
			    <form action="" method="post">
					{{csrf_field()}}
					<span class="login100-form-title p-b-49">
						Forgot Password
					</span>
					@include('layouts.alertProfile')
					<p class="input01">Please enter your email to be able to change the password for your account.</p>
					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100"><b>Email:</b></span>
						<input class="input100" type="text" name="email" placeholder="Input your email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
						@error('email')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="flex-col-c p-t-155">

						<button type="submit"class="btn btn-primary">
							Confirm Email
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('home/customerLogin/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('home/customerLogin/daterangepicker/daterangepicker.js')}}vendor/"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/js/main.js')}}"></script>

</body>
</html>