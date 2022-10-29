<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
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
			    <form action="{{ route('loginCustomer') }}" method="post">
					{{csrf_field()}}
					<span class="login100-form-title p-b-49">
						Login
					</span>
					@include('layouts.alertProfile')
					@if(Session::has('error'))
                    <div class="alert alert-{{ Session::get('status') }} status-box">
                        {!! Session::get('error') !!} 
                    </div>
                    @endif 
					<div class="wrap-input100 validate-input m-b-23">
						<span class="label-input100">Username</span>
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
					
					<div class="text-right p-t-8 p-b-31">
						<a href="{{route('forgetPassword')}}">
							Forgot password?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>

					<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							Or Sign Up Using
						</span>
					</div>

					<div class="flex-c-m">
						<a href="{{route('login_facebook')}}" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="{{route('login_google')}}" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>

					<div class="flex-col-c p-t-155">
						<span class="txt1 p-b-17">
							Or Sign Up Using
						</span>

						<a href="{{URL::to('/registerAccount')}}" class="txt2">
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
	<script src="{{asset('home/customerLogin/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('home/customerLogin/js/main.js')}}"></script>
	<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

</body>
</html>