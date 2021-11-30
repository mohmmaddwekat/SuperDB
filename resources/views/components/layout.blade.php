<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href={{ asset('/layout-assets/css/bootstrap.css') }}>

    <link rel="stylesheet" href={{ asset('/layout-assets/vendors/chartjs/Chart.min.css') }}>

    <link rel="stylesheet" href={{ asset('/layout-assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}>
    <link rel="stylesheet" href={{ asset('/layout-assets/css/app.css') }}>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="shortcut icon" href={{ asset('/layout-assets/images/favicon.svg') }} type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src={{ asset("/layout-assets/images/logo.svg") }} alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">


                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item active ">
                            <a href="index.html" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>


                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i data-feather="briefcase" width="20"></i>
                                <span>Database</span>
                            </a>
                            <ul class="submenu ">
                                <li>
                                    <a href="{{ route('connection.index') }}" >database</a>
                                </li>

                                <li>
                                    <a href="" >Export</a>
                                </li>

                            </ul>
                        </li>





                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar mr-1">
                                    <img src="/layout-assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>{{ $title }}</h3>
                </div>
                <div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $message)
                                    <li>

                                        {{ $message }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                </div>
                <div>
                    {{ $slot }}
                </div>

            </div>

            <footer class=" my-5 pt-5">
                <div class="footer clearfix mb-0 text-muted my-5 pt-5">
                    <div class="float-left my-5 pt-5">
                        <p>2020 &copy; Voler</p>
                    </div>
                    <div class="float-right my-5 pt-5">
                        <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                                href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('/layout-assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('/layout-assets/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/layout-assets/assets/js/app.js') }}"></script>
    <script src="{{ asset('/layout-assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('/layout-assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/layout-assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('/layout-assets/js/main.js') }}"></script>

</body>

</html>
