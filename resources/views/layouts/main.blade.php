<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Seo Meta -->
  <meta name="keywords" content="{{$meta_keywords}}">
  <meta name="description" content="{{$meta_description}}"/>
  <meta name="robots" content="INDEX,FOLLOW"/>
  <meta name="canonical" href="{{$url_canonical}}"/>
  <title>{{$meta_title}}</title>
  <meta name="author" content=""/>
  <link rel="icon" type="image/x-icon" href=""/>
  <!-- End seo meta -->
  <!-- Share Facebook -->
  <meta property="og:site_name" content="{{$meta_keywords}}" />
  <meta property="og:description" content="{{$meta_description}}" />
  <meta property="og:title" content="{{$meta_title}}" />
  <meta property="og:url" content="{{$url_canonical}}" />
  <meta property="og:type" content="website" />

  <!-- Share Facebook -->
  <link rel="icon" href="{{asset('home/image/favicon.png')}}" type="image/png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('home/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('home/vendors/linericon/style.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/vendors/owl-carousel/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/vendors/nice-select/css/nice-select.css')}}">
  <link rel="stylesheet" href="{{asset('home/vendors/owl-carousel/owl.carousel.min.css')}}">
  <!-- main css -->
  <link rel="stylesheet" href="{{asset('home/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/sweetalert.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/responsive.css')}}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
  @yield('custom-css')
</head>

<body>
  <!--================Header Area =================-->
  <header class="header_area">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="index.html"><img src="{{URL::to('home/image/Logo.png')}}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse
         data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
         aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <ul class="nav navbar-nav menu_nav ml-auto">
            <li class="nav-item active"><a class="nav-link" href="{{URL::to('/')}}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/bookingRoom')}}">Booking Room</a></li>
            @if (!auth()->user())
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Sign in</a></li>
            @endif
            <li class="nav-item "><a class="nav-link" href="{{URL::to('contactUs')}}">Contact us</a></li>
            @if (auth()->user())
            @if (auth()->user()->hasRole('user'))
            <li class="nav-item"><a href="{{ URL::to('/view-booking/historyBooking') }}" 
            class="nav-link">History Booking</a></li>
            @endif
            @endif
            @if (auth()->user())
            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('staff'))
                <li class="nav-item"><a class="nav-link"
                href="{{ URL::to('admin/dashboard') }}">Admin</a></li>
            @endif
            @endif
            @if (auth()->user())
            @if (auth()->user()->provider_id == !null )
            <li class="nav-item submenu dropdown">
                <button class="btn" type="button" id="dropdownMenuButton2"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="{{ route('user.profile') }}"
                  id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                  aria-expanded="false">

                  <img class="img-account-profile rounded-circle mb-2"
                  src="{{ auth()->user()->avatar == null? asset('/home/image/avatar.png'): asset( Auth::user()->avatar) }}"
                  alt="{{ asset('public/home/image/avatar.png')}}"
                  style="width: 30px; height: 30px; object-fit: cover;" loading="lazy">
                </a>
                </button>
            </li>
            @endif
            @endif
            @if (auth()->user())
            @if (auth()->user()->provider_id == null)
            <li class="nav-item submenu dropdown">
                <button class="btn" type="button" id="dropdownMenuButton2"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" 
                  href="{{ route('user.profile') }}"
                  id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                  aria-expanded="false">

                  <img class="img-account-profile rounded-circle mb-2"
                  src="{{ auth()->user()->avatar == null? asset('/home/image/avatar.png'):
                   asset('/storage/image/' . Auth::user()->avatar) }}"
                  alt="{{ asset('public/home/image/avatar.png')}}"
                  style="width: 30px; height: 30px; object-fit: cover;" loading="lazy">
                </a>
                </button>
            </li>
            @endif
            @endif
            @if (auth()->user())
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Log Out</a></li>
            @endif
          </ul>
        </div>
      </nav>
    </div>
  </header>

  @yield('content')

  <section class="map top" style="margin-top: 100px">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.3875678032373!2d108.2446921146838!3d16.04536568889569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314217d7d6a7c835%3A0x95ee506ecb07793c!2sRoyal%20Hotel%20%26%20Apartment!5e0!3m2!1svi!2s!4v1660649163206!5m2!1svi!2s"
  width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>
  <footer class="footer-area section_gap">
    <div class="container">
      <div class="row">
        <div class="col-lg-3  col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6 class="footer_title">About Agency</h6>
            <p>The world has become so fast paced that people don???t want to stand by reading a page of information, they would much rather look at a presentation and understand the message. It has come to a point </p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6 class="footer_title">Navigation Links</h6>
            <div class="row">
              <div class="col-4">
                <ul class="list_style">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Feature</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Portfolio</a></li>
                </ul>
              </div>
              <div class="col-4">
                <ul class="list_style">
                  <li><a href="#">Team</a></li>
                  <li><a href="#">Pricing</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="single-footer-widget">
            <h6 class="footer_title">Newsletter</h6>
            <p>For business professionals caught between high OEM price and mediocre print and graphic output, </p>
            <div id="mc_embed_signup">
            </div>
          </div>
        </div>
      </div>
      <div class="border_line"></div>
      <div class="row footer-bottom d-flex justify-content-between align-items-center">
        <p class="col-lg-8 col-sm-12 footer-text m-0">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Developer &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | This is development by <a href="https://github.com/NguyenVanHuy1405" target="_blank">Nguyen Van Huy.</a> <a href="https://greenwich.edu.vn/en/english/" target="_blank"> The student of Greenwich University Vietnam</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </p>
        <div class="col-lg-4 col-sm-12 footer-social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-dribbble"></i></a>
          <a href="#"><i class="fa fa-behance"></i></a>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="{{asset('home/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('home/js/popper.js')}}"></script>
  <script src="{{asset('home/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('home/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('home/js/jquery.ajaxchimp.min.js')}}"></script>
  <script src="{{asset('home/js/mail-script.js')}}"></script>
  <script src="{{asset('home/vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js')}}"></script>
  <script src="{{asset('home/vendors/nice-select/js/jquery.nice-select.js')}}"></script>
  <script src="{{asset('home/js/mail-script.js')}}"></script>
  <script src="{{asset('home/js/stellar.js')}}"></script>
  <script src="{{asset('home/vendors/lightbox/simpleLightbox.min.js')}}"></script>
  <script src="{{asset('home/js/custom.js')}}"></script>
    @yield('custom-js')
    
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1097822581150555&autoLogAppEvents=1" nonce="GUTnfxAT"></script>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1097822581150555&autoLogAppEvents=1" nonce="bwHz9FNl"></script>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1097822581150555&autoLogAppEvents=1" nonce="c8zF8Qu9"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script
  src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
  integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c="
  crossorigin="anonymous"></script>
  <script src="{{asset('home/js/sweetalert.min.js')}}"></script>
  <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "111939898372316");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  
</body>

</html>
