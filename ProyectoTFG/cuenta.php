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
    <script type="text/javascript" src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/estilos.css">

    <title>Cuenta</title>
</head>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosUsu = $conexion->datosUsuario($_SESSION['usuario']);
    $id_usuario = $datosUsu[0]['id_usuario'];
    $nombre = $datosUsu[0]['nombre'];
    $apellidos = $datosUsu[0]['apellidos'];
    $email = $datosUsu[0]['email'];
    $usuario = $datosUsu[0]['usuario'];
    $clave = $datosUsu[0]['clave'];
    $fecha = $datosUsu[0]['fecha'];
    $fecha_alta = $datosUsu[0]['fecha_alta'];
    $errores = [];

    /* echo '<pre>';
    print_r($datosUsu);
    echo '</pre>';
    */

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["guardarCambios"])) {

            $id_usuario = filtrado($_POST['id_usuario']);
            $nombre = filtrado($_POST['nombre']);
            $apellidos = filtrado($_POST['apellidos']);
            //$email = filtrado($_POST['email']);
            //$usuario = filtrado($_POST['usuario']);
            $password = filtrado($_POST['password']);
            $password = hash('sha512', $password);

            if (empty($nombre)) {
                $errores[] = "- El nombre no puede estar vacío";
            } elseif (strlen($nombre) > 10) {
                $errores[] = "- El nombre no puede tener más de 10 letras";
            } elseif (ctype_alpha($nombre) == FALSE) {
                $errores[] = "- El nombre no puede tener caracteres numéricos ni espacios";
            } elseif (empty($apellidos)) {
                $errores[] = "- El apellido no puede estar vacío";
            } elseif (strlen($apellidos) > 20) {
                $errores[] = "- El apellido no puede tener más de 20 letras";
            } elseif (empty($password)) {
                $errores[] = "- La contraseña no puede estar vacía";
            } elseif (strlen($password) > 225) {
                $errores[] = "- La contraseña no puede tener más de 225 caracteres";
            } else {
                $conexion->modificar_registro($nombre, $apellidos, $password, $id_usuario);
                echo '<script>alert("Usuario modificado correctamente. Vuelva a iniciar sesión")
                document.location=("inicio.php");
                </script>';
            }
        }

        if (isset($_POST["eliminarCuenta"])) {

            $id_usuario = filtrado($_POST['id_usuario']);
            $conexion->eliminarCuenta($id_usuario);
            $conexion->incrementarTablaRegistro();
            echo '<script>alert("Has sido dado de baja. Muchas gracias")
            document.location=("inicio.php");
            </script>';
        }
    } else {
    }

    if ($_SESSION['usuario'] == "MiguelMB") {
    ?>
        <style>
            #eliminar {
                display: none;
            }
        </style>
    <?php
    }
    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">MI CUENTA</p>
    </div>

    <!-- MENÚ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="areaAdministrador.php"><button class="btn btn-outline-secondary" name="admin" id="admin" <?php if ($_SESSION['usuario'] != "MiguelMB") { ?> style="display:none;" <?php } ?>>Area Administrador</button></a>
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
                            <li><a class="dropdown-item" href="verCompras.php"><img src="img/bolsa.jpg" style="max-width: 20px;"> Compras</a></li>
                            <li><a class="dropdown-item" href="otros/cerrarSesion.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN MENÚ -->

    <div class="container">
        <!--FORMULARIO-->
        <div class="m-0 row justify-content-center align-items-center">
            <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-user" style="font-size: 40px ;"></i><br>
                    <h3><strong>DATOS PERSONALES</strong></h3>
                    <p>Aquí puedes ver y modificar algunos de tus datos de registro</p>
                    <br>
                    <label for="id_usuario">Registro</label>
                    <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>" disabled>
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" disabled>
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>" disabled>
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password" id="password" value="<?php echo $_SESSION['clave']; ?>">
                    <label for="fecha">Último Inicio De Sesión</label>
                    <input type="text" class="form-control" name="fecha" id="fecha" value="<?php echo $fecha; ?>" disabled>
                    <label for="fecha">Fecha Registro</label>
                    <input type="text" class="form-control" name="fecha_alta" id="fecha_alta" value="<?php echo $fecha_alta; ?>" disabled><br>
                    <!--VISUALIZAR ERRORES-->
                    <?php
                    if (!empty($errores)) {
                        echo '<strong> <span style="color:red">' . implode("<br>", $errores) . '</span> </strong><br><br>';
                    }
                    ?>
                    <!--VISUALIZAR ERRORES-->
                    <input type="submit" id="guardarCambios" name="guardarCambios" class="btn btn-warning" value="Guardar Cambios">
                    <button type="button" id="eliminar" name="eliminar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal">Eliminar Cuenta</button>
                </div>
        </div>
        <!--FIN FORMULARIO-->
    </div>

    <!-- MODAL  ELIMINAR  -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color: #0d6efd; color: white;">
                        <h4 class="modal-title">Eliminar Cuenta</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <p><?php echo "Hola " . "<strong>" . $usuario . "</strong>" . " Estas apunto de eliminar permanentemente tu cuenta , ¿Estas segur/@ de que desea realizar esta opción?" . "<strong>" . "<br>" . "A continuación se eliminarán todas tus credenciales" . "</strong>" ?></p>
                        <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>" hidden>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" id="eliminarCuenta" name="eliminarCuenta" class="btn btn-success" value="Aceptar">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>

    <!-- Footer -->
    <footer class="text-center text-muted" style="background-color: rgba(0, 0, 0, 0.025); margin-top:100px;">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a target="_blank" href="https://es-es.facebook.com/" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a target="_blank" href="https://twitter.com/?lang=es" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a target="_blank" href="https://www.google.es/" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a target="_blank" href="https://www.instagram.com/" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary"></i>COMPAÑIA HR
                        </h6>
                        <p>
                            En esta pagina tenemos productos de buena calidad y buenos precios, confia en nosotros,
                            no te vamos a defraudar.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Productos
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">CAMISETAS</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">PANTALONES</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">ZAPATLLIAS</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">SUDADERAS</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3 text-secondary"></i> MADRID, MA 10012, ES</p>
                        <p>
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            mmarinb12@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">MR.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>