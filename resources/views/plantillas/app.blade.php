<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> @yield('titulo') </title>

    <!-- Meta -->
    <meta name="author" content="Alex Granada" />
    <link rel="shortcut icon" href="{{ asset('assets/images/icono.PNG') }}" />

    <!-- *************
   ************ CSS Files *************
  ************* -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/bootstrap/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}" />

    <!-- *************
   ************ Vendor Css Files *************
  ************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />

</head>

<body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">

            <!-- Toggle buttons start -->
            <div class="d-flex">
                <button class="toggle-sidebar" id="toggle-sidebar">
                    <i class="bi bi-list lh-1"></i>
                </button>
                <button class="pin-sidebar" id="pin-sidebar">
                    <i class="bi bi-list lh-1"></i>
                </button>
            </div>
            <!-- Toggle buttons end -->

            <!-- App brand starts -->
            <div class="app-brand py-2 ms-3">
                <a href="index.html" class="d-sm-block d-none">
                    <img src="{{ asset('assets/images/logo-horizontal.png') }}" class="logo" alt="Bootstrap Gallery" />
                </a>
                <a href="index.html" class="d-sm-none d-block">
                    <img src="{{ asset('assets/images/icono.PNG') }}" class="logo" alt="Bootstrap Gallery" />
                </a>
            </div>
            <!-- App brand ends -->

            <!-- App header actions start -->
            <div class="header-actions col">
                <div class="d-lg-flex d-none">

                    <div class="dropdown border-start">
                        <a class="dropdown-toggle d-flex px-3 py-4 position-relative" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-4 lh-1 text-secondary"></i>
                            <span class="count-label info"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end shadow-lg">
                            <h5 class="fw-semibold px-3 py-2 text-primary">Updates</h5>
                            <div class="dropdown-item">
                                <div class="d-flex py-2 border-bottom">
                                    <div class="icon-box md bg-success rounded-circle me-3">
                                        <span class="fw-bold text-white">DS</span>
                                    </div>
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Douglass Shaw</h6>
                                        <p class="mb-1">
                                            Membership has been ended.
                                        </p>
                                        <p class="small m-0 text-secondary">Today, 07:30pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="d-flex py-2 border-bottom">
                                    <div class="icon-box md bg-danger rounded-circle me-3">
                                        <span class="fw-bold text-white">WG</span>
                                    </div>
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Willie Garrison</h6>
                                        <p class="mb-1">
                                            Congratulate, James for new job.
                                        </p>
                                        <p class="small m-0 text-secondary">Today, 08:00pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-item">
                                <div class="d-flex py-2">
                                    <div class="icon-box md bg-warning rounded-circle me-3">
                                        <span class="fw-bold text-white">TJ</span>
                                    </div>
                                    <div class="m-0">
                                        <h6 class="mb-1 fw-semibold">Terry Jenkins</h6>
                                        <p class="mb-1">
                                            Lewis added new schedule release.
                                        </p>
                                        <p class="small m-0 text-secondary">Today, 09:30pm</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mx-3 my-1">
                                <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="dropdown ms-2">
                    <a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center text-decoration-none" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/user.png') }}" class="rounded-2 img-3x" alt="Bootstrap Gallery" />
                        <span class="ms-2 text-truncate d-lg-block d-none">{{ Auth::user()->nombres }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg">
                        <div class="header-action-links mx-3 gap-2">
                            <a class="dropdown-item" href="profile.html">
                                <i class="bi bi-person text-primary"></i>Perfil
                            </a>
                            <a class="dropdown-item" href="settings.html">
                                <i class="bi bi-gear text-danger"></i>Configuraciones
                            </a>

                        </div>
                        <div class="mx-3 mt-2 d-grid">
                            <a href="{{ route('salir') }}" class="btn btn-primary btn-sm">Salir</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- App header actions end -->

        </div>
        <!-- App header ends -->

        <!-- Main container start -->
        <div class="main-container">

            <!-- Sidebar wrapper start -->
            <nav id="sidebar" class="sidebar-wrapper">

                <!-- Sidebar profile starts -->
                <div class="shop-profile">
                    <p class="mb-1 fw-bold text-primary">{{ Auth::user()->nombres }}</p>
                    <p class="m-0">{{ Auth::user()->tipo }}</p>
                </div>
                <!-- Sidebar profile ends -->

                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <ul class="sidebar-menu">

                        <!-- Dashboard -->
                        <li class="active current-page">
                            <a href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>

                        <!-- Partidas -->
                        <li>
                            <a href="{{ route('partidas') }}">
                                <i class="bi bi-list-check"></i>
                                <span class="menu-text">Partidas</span>
                            </a>
                        </li>

                        <!-- Metrado Diario -->
                        <li>
                            <a href="#">
                                <i class="bi bi-rulers"></i>
                                <span class="menu-text">Metrado Diario</span>
                            </a>
                        </li>

                        <!-- Reportes -->
                        <li>
                            <a href="#">
                                <i class="bi bi-file-earmark-bar-graph"></i>
                                <span class="menu-text">Reportes</span>
                            </a>
                        </li>

                        <!-- Configuraciones -->
                        <li class="treeview">
                            <a href="#!">
                                <i class="bi bi-gear"></i>
                                <span class="menu-text">Configuraciones</span>
                            </a>
                            <ul class="treeview-menu">

                                <li>
                                    <a href="#">
                                        <i class="bi bi-sliders"></i>
                                        Configuración General
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="bi bi-building"></i>
                                        Obras
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="bi bi-people"></i>
                                        Usuarios
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="bi bi-box-seam"></i>
                                        Productos
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar menu ends -->

            </nav>
            <!-- Sidebar wrapper end -->

            <!-- App container starts -->
            <div class="app-container">


                <!-- App body starts -->
                <div class="app-body">


                    {{-- contenido --}}
                    @yield('contenido')


                </div>
                <!-- App body ends -->

                <!-- App footer start -->
                <div class="app-footer">
                    <span>© 2026</span>
                </div>
                <!-- App footer end -->

            </div>
            <!-- App container ends -->

        </div>
        <!-- Main container end -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
   ************ JavaScript Files *************
  ************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- *************
   ************ Vendor Js Files *************
  ************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dash1/visitors.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dash1/sales.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dash1/sparkline.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dash1/tasks.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dash1/income.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/todays-date.js') }}"></script>
</body>

</html>
