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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Area Administrador</title>
</head>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosOpiniones = $conexion->tablaUsuarios();

    /* echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    }

    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color:black;">AREA ADMINISTRADOR</p>
    </div>

    <!-- MENÚ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="paginaPrincipal.php">HOME</a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">NOVEDADES</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                            Hombre
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="hombreCamisetas.php"><i class="fa fa-fw fa-tshirt"></i> Camisetas</a></li>
                            <li><a class="dropdown-item" href="pantalonesHombre.php"><i class="fa fa-fw fa-socks"></i> Pantalones</a></li>
                            <li><a class="dropdown-item" href="calzadoHombre.php"> <img src="img/zapatillaIcono.jpg" style="max-width: 30px;"> Calzado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                            Mujer
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="mujerCamisetas.php"><i class="fa fa-fw fa-tshirt"></i> Camisetas</a></li>
                            <li><a class="dropdown-item" href="pantalonesMujer.php"><i class="fa fa-fw fa-socks"></i> Pantalones</a></li>
                            <li><a class="dropdown-item" href="calzadoMujer.php"><img src="img/zapatillaIcono.jpg" style="max-width: 30px;"> Calzado</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contacta.php"><i class="fa fa-fw fa-address-book"></i>Contacta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="carrito.php"><i class="fa fa-solid fa-cart-arrow-down"></i>Carrito</a>
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
            </div>
        </div>
    </nav>
    <!-- FIN MENÚ -->


    <!--DESARROLLO TABLAS--->
    <!--TARJETAS--->
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-top: 100px;">
        <div class="container" style="margin-top: 50px; padding-bottom: 50px;">
            <div class="row justify-content-around" style="margin-top:50px">
                <div class="col">
                    <div class="card text-center" style="width: 19rem;">
                        SECCIÓN USUARIOS
                        <a href="administrarUsuarios.php"><img src="img/usuarios.jpg" class="card-img-top" alt="..."></a>
                        <div class="card-body ">
                            <a href="administrarUsuarios.php"><button type="button" class="btn btn-info">Registros</button></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 20rem;">
                        SECCIÓN PRODUCTOS
                        <a href="administrarProductos.php"><img src="img/productos.jpg" class="card-img-top" alt="..."></a>
                        <div class="card-body ">
                            <a href="administrarProductos.php"><button type="button" class="btn btn-info">Productos</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-around" style="margin-top:50px">
                <div class="col">
                    <div class="card text-center" style="width: 19rem;">
                        SECCIÓN OPINIONES
                        <a href="administrarOpiniones.php"><img src="img/evaluaciones.jpg" class="card-img-top" alt="..."></a>
                        <div class="card-body ">
                            <a href="administrarOpiniones.php"><button type="button" class="btn btn-info">Opiniones</button></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center" style="width: 20rem;">
                        SECCIÓN VENTAS
                        <a href="administrarVentas.php"><img src="img/ventas.jpg" class="card-img-top" alt="..."></a>
                        <div class="card-body ">
                            <a href="administrarVentas.php"><button type="button" class="btn btn-info">Ventas</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--FIN TARJETAS--->
</body>

</html>