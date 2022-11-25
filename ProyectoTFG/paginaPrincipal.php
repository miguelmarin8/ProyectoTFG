<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/estilos.css">

    <title>Página Principal</title>
</head>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $usuario = $_SESSION['usuario'];
    //$productos = $conexion->seleccionarProductos();

    //Actualizamos fecha cada vez que entremos

    echo '<pre>';
    print_r($usuario);
    echo '</pre>';



    //print_r($hola);

    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">BIENVENIDO A MR</p>
        <p class="display-7" style="font-family: cursive;">GRACIAS POR SU CONFIANZA</p>
    </div>

    <!-- MENÚ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="paginaPrincipal.php">HOME</a>
            <a href="areaAdministrador.php"><button class="btn btn-outline-secondary" name="admin" id="admin" <?php if ($_SESSION['usuario'] != "MiguelMB") { ?> style="display:none;" <?php } ?>>Area Administrador</button></a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-fw fa-address-book"></i>Contacta</a>
                    </li>
                    <li class="nav-item dropdown" class="d-flex">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                            <i class="fa fa-fw fa-wrench"></i>Configuración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="cuenta.php"><i class="fa fa-fw fa-user"></i> Cuenta</a></li>
                            <li><a class="dropdown-item" href="otros/cerrarSesion.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- FIN MENÚ -->

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="container" style="margin-top: 50px;">
            <div class="row align-items-center">
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <!--SEGUNDA LÍNEA-->
        <div class="container" style="margin-top: 100px;">
            <div class="row align-items-center">
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!--TERCERA LÍNEA-->
        <div class="container" style="margin-top: 100px;">
            <div class="row align-items-center">
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 18rem;">
                        <img src="img/camisetaNikeBlanca.jpg" class="card-img-top" alt="...">
                        Camiseta Nike
                        <div class="card-body ">
                            <button name="medicamentos" class="btn btn-light">Información</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>


</body>

</html>