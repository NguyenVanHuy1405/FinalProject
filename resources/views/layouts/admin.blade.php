<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/sweetalert.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('admin/js/select.dataTables.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('admin/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('home/image/favicon.png')}}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('custom-css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{URL::to('/admin/dashboard')}}">
                        <img src="{{asset('home/image/logo2.png')}}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="{{asset('admin/images/logo-mini.svg')}}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">{{Auth::user()->name}}</span></h1>
                        <h3 class="welcome-sub-text">Your performance summary this week </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-xs rounded-circle" src="{{asset('/storage/image/' . Auth::user()->avatar)}}" alt="Profile image">
                                @if (auth()->user())
                                <p class="mb-1 mt-3 font-weight-semibold"><b>{{Auth::user()->name}}</b></p>
                                <p class="fw-light text-muted mb-0">{{Auth::user()->email}}</p>
                                @endif
                            </div>
                            <a href="{{URL::to('/profile-account')}}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile</a>
                            <a href="{{URL::to('/logout')}}" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">Sidebar Themes</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">Header Themes</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item  {{Request::routeIs('admin.dashboard') ? 'active':'';}}">
                        <a class="nav-link" href="{{URL::to('/admin/dashboard')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user())
                    @if(auth()->user()->hasRole('admin'))
                    <li class="nav-item  {{Request::routeIs('admin.account.index') ? 'active':'';}}">
                        <a class="nav-link" href="{{route('admin.account.index')}}">
                            <i class="mdi mdi-grid-large fa-solid fa-user"></i>
                            <span class="menu-title">Account</span>
                        </a>
                    </li>
                    @endif
                    @endif
                    <li class="nav-item  {{Request::routeIs('admin.roomtype.index') ? 'active':'';}}">
                        <a class="nav-link" href="{{route('admin.roomtype.index')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Roomtype</span>
                        </a>
                    </li>
                    <li class="nav-item  {{Request::routeIs('admin.kindofroom.index') ? 'active':'';}} ">
                        <a class="nav-link" href="{{route('admin.kindofroom.index')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">KindofRoom</span>
                        </a>
                    </li>
                    <li class="nav-item  {{Request::routeIs('admin.room.index') ? 'active':'';}} ">
                        <a class="nav-link" href="{{route('admin.room.index')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Room</span>
                        </a>
                    </li>
                    <li class="nav-item  {{Request::routeIs('admin.coupon.index') ? 'active':'';}}">
                        <a class="nav-link" href="{{route('admin.coupon.index')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Coupon</span>
                        </a>
                    </li>
                    <li class="nav-item  {{Request::routeIs('admin.managerBooking.index') ? 'active':'';}} ">
                        <a class="nav-link" href="{{route('admin.managerBooking.index')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Manager Booking</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Developer by <a href="https://github.com/NguyenVanHuy1405" target="_blank">Nguyen Van Huy </a> from Greenwich University.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. All rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('admin/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin/vendors/progressbar.js/progressbar.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('admin/js/off-canvas.js')}}"></script>
    <!-- <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script> -->
    <script src="{{asset('admin/js/template.js')}}"></script>
    <script src="{{asset('admin/js/settings.js')}}"></script>
    <script src="{{asset('admin/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('admin/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/dashboard.js')}}"></script>
    <script src="{{asset('admin/js/Chart.roundedBarCharts.js')}}"></script>
    <script src="{{asset('home/js/sweetalert.min.js')}}"></script>

    @yield('custom-js')
    <!-- End custom js for this page-->
</body>

</html>
