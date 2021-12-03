<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="{{ APP::isLocale('ar') ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/layout-assets/img/svg/logo.svg" type="image/x-icon">
    <!-- Custom styles -->

    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="/layout-assets/css/style.rtl.css">
    @else
        <link rel="stylesheet" href="/layout-assets/css/style.css">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
</head>

<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-start">
                <div class="sidebar-head">
                    <a href="/" class="logo-wrapper" title="Home">
                        <span class="sr-only">Home</span>
                        <span class="icon logo" aria-hidden="true"></span>
                        <div class="logo-text">
                            <span class="logo-title">SuperDB</span>
                        </div>

                    </a>
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle" aria-hidden="true"></span>
                    </button>
                    <div class="m-2">
                        <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                            <span class="sr-only">Switch theme</span>
                            <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                            <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                        </button>
                    </div>

                </div>
                <div class="sidebar-body">
                    <ul class="sidebar-body-menu">
                        <li>
                            <a class="active" href="{{ route('super-db.dashboard') }}"><span class="icon home"
                                    aria-hidden="true"></span>Dashboard</a>
                        </li>
                        <li>
                            <a class="show-cat-btn" href="##">
                                <span class="icon document" aria-hidden="true"></span>database
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="{{ route('super-db.connection.index') }}">database</a>
                                </li>
                            </ul>
                        </li>

                </div>
            </div>


        </aside>
        <div class="main-wrapper bg-info bg-gradient">
            <!-- ! Main nav -->
            <nav class="nav--bg ">
                <div class="d-flex flex-row-reverse bd-highlight">





                    <div class="p-2 bd-highlight">
                        <button href="##" class="nav-user-btn dropdown-btn" type="button">
                            <span class="text-dark">
                                mark A.
                            </span>
                        </button>
                        <ul class="users-item-dropdown nav-user-dropdown dropdown">
                            <li><a class="danger" href="##">
                                    <i data-feather="log-out" aria-hidden="true"></i>
                                    <span>Log out</span>
                                </a></li>
                        </ul>
                    </div>
                    <div class="p-2 bd-highlight">
                        <button class="lang-switcher transparent-btn" type="button">
                            @if (!session()->has('locale')) English @endif
                            @if (session()->get('locale') == 'en') English @endif
                            @if (session()->get('locale') == 'ar') Arabic @endif
                            <i data-feather="chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="lang-menu dropdown ">
                            <li><a href="{{ route('super-db.locale', 'en') }}">English</a></li>
                            <li><a href="{{ route('super-db.locale', 'ar') }}">Arabic</a></li>
                        </ul>
                    </div>


                </div>
            </nav>




            <!-- ! Main -->


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



















        </div>
        </main>
        <!-- ! Footer -->
        <footer class="footer">
            <div class="container footer--flex">
                <div class="footer-start">
                    <p>2021 © SuperDB </p>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Chart library -->
    <script src="/layout-assets/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="/layout-assets/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="/layout-assets/js/script.js"></script>
</body>

</html>
