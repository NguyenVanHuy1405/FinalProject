<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{asset('home/image/favicon.png')}}" type="image/png">
  <title>Login Royal Hotel</title>

  <link rel="stylesheet" href="{{asset('home/css/login.css')}}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="{{URL::to('/createUserAccount')}}" method="post">
            {{ csrf_field() }}
			<h1>Create User Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>
			@if (session('success'))
                 <div class="alert alert-success">
                {{ session('success') }}
                </div>
            @endif
			<input type="text" name="name" placeholder="Name" />
			@error('name')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<input type="email" name="email" placeholder="Email" />
			@error('email')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<input type="password" name="password" placeholder="Password" />
			@error('password')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<input type="password" name="password_confirmation" placeholder="Confirm your password" />
			@error('password_confirmation')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<input type="text" name="phone" placeholder="Phone number" />
			@error('phone')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<button type="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('loginCustomer') }}" method="post">
            {{ csrf_field() }}
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="text" name="email" placeholder="Enter Your Email" />
			@error('email')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<input type="password" name="password" class="zmdi zmdi-eye" placeholder="Enter Password" />
			@error('password')
                <span class="invalid-feedback" role="alert" style="display: block">
                    <strong>{{ $message }}</strong>
                 </span>
            @enderror
			<a href="#">Forgot your password?</a>
			<button type="submit">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="{{asset('home/js/login.js')}}"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
</body>