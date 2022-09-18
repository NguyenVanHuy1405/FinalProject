<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login for customer</title>
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
			    <form action="{{URL::to('/createUserAccount')}}" method="post">
					{{csrf_field()}}
					<span class="login100-form-title p-b-49">
						Login
					</span>
					@include('layouts.alertProfile')
					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Name</span>
						<input class="input100" type="text" name="name" placeholder="Input your name">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
						@error('name')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Input your username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
						@error('email')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>

					<div class="wrap-input100 validate-input">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Input your password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
						@error('password')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm password">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
						@error('password_confirmation')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input">
						<span class="label-input100">Phone Number</span>
						<input class="input100" type="text" name="phone" placeholder="Input your phone number">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
						@error('phone')
                            <span class="invalid-feedback" role="alert" style="display: block">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
					<div class="g-recaptcha" name="g-recaptcha-response" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                    <br/>
                    @if($errors->has('g-recaptcha-response'))
                      <span class="invalid-feedback" style="display:block">
	                      <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                      </span>
                    @endif
					<div class="container-login-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Register
							</button>
						</div>
					</div>
					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17"><b>
							If you have already account, please login.
						</b></span>

						<a href="{{URL::to('loginCustomer')}}" class="txt2">
							Sign Up
						</a>
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
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>