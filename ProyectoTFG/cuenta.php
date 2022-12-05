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
            } elseif (strlen($password) > 20) {
                $errores[] = "- La contraseña no puede tener más de 20 caracteres";
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
            <a class="navbar-brand" href="paginaPrincipal.php">HOME</a>
            <a href="areaAdministrador.php"><button class="btn btn-outline-secondary" name="admin" id="admin" <?php if ($_SESSION['usuario'] != "MiguelMB") { ?> style="display:none;" <?php } ?>>Area Administrador</button></a>
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
                            <li><a class="dropdown-item" href="#">Camisetas</a></li>
                            <li><a class="dropdown-item" href="#">Pantalones</a></li>
                            <li><a class="dropdown-item" href="#">Calzado</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
                            Mujer
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Camisetas</a></li>
                            <li><a class="dropdown-item" href="#">Pantalones</a></li>
                            <li><a class="dropdown-item" href="#">Calzado</a></li>
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
                    <input type="text" class="form-control" name="password" id="password" value="<?php echo $clave; ?>">
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

</body>

</html>