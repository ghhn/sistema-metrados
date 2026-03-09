<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Acceso al Sistema - Metrados</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Admin Dashboard Templates" />
    <meta name="author" content="Alex Granada Campana" />
    <link rel="shortcut icon" href="{{ asset('assets/images/icono.PNG') }}" />

    <!-- *************
   ************ CSS Files *************
  ************* -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/bootstrap/bootstrap-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}" />
</head>

<body class="bg-white">
    <!-- Container start -->
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-4 col-lg-5 col-sm-6 col-12">
                <form action="{{ route('login.post') }}" method="POST" class="my-5">
                    @csrf
                    <div class="border rounded-2 p-4 mt-5">
                        <div class="login-form">
                            <a href="index.html" class="mb-4 d-flex justify-content-center">

                                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="Earth Admin Dashboard" width="200px" />

                            </a>
                            <div class="mb-3">
                                <label class="form-label">DNI</label>
                                <input type="text" class="form-control" placeholder="Numero de DNI" name="dni" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Clave de Acceso</label>
                                <input type="password" class="form-control" placeholder="Ingrese su clave" name="clave" />
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
                                    <label class="form-check-label" for="rememberPassword">Recordar </label>
                                </div>
                                <a href="forgot-password.html" class="text-blue text-decoration-underline">¿Perdiste tu
                                    contraseña?
                                </a>
                            </div>
                            <div class="d-grid py-3 mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Acceder
                                </button>
                            </div>
                            <div class="text-center py-3">o accede con </div>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-outline-danger">
                                    <i class="bi bi-google me-2"></i>Gmail
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container end -->
</body>

</html>
