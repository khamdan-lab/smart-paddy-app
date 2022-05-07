<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SmartFarm Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    {{-- <link rel="icon" href="{{ asset('template/assets/img/icon.ico') }}" type="image/x-icon" /> --}}

    <!-- Fonts and icons -->
    <script src="{{ asset('template/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('template/assets/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/switch.css') }}">
    @stack('css')

</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="white">
                <a href="/dashboard" class="logo">
                    <img src="{{ asset('image/logo-inverse.png') }}" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="green2">
                <div class="container-fluid">
                    {{-- <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search mr-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pr-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search.." class="form-control">
                            </div>
                        </form>
                    </div> --}}
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<button class="btn" type="submit" style="background-color:transparent; color: white">
								<i class="fas fa-power-off"></i>
								Logout
							</button>
						</form>

                        {{-- <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="{{ asset('template/assets/img/profile.jpg') }}" alt="."
                                        class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('template/assets/img/profile.jpg') }}"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                <p class="text-muted">hello@example.com</p><a href="profile.html"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
										<form action="{{ route('logout') }}" method="POST">
                                        	<div class="dropdown-divider"></div>
											@csrf
											<button type="submit">Logout</button>
										</form>
                                    </li>
                                </div>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        @include('partials.v_sidebar')
        <div class="main-panel">
