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
    <title>Contacta</title>
</head>

<body>

    <?php
    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosUsu = $conexion->datosUsuario($_SESSION['usuario']);
    $nombre = $datosUsu[0]['nombre'];
    $apellidos = $datosUsu[0]['apellidos'];
    $email = $datosUsu[0]['email'];
    $usuario = $datosUsu[0]['usuario'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }

    ?>

    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">CONTACTA CON NOSOTROS</p>
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
            <form id="formularioContacta" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-envelope" style="font-size: 40px ;"></i><br>
                    <h3><?php echo "Hola " . "<strong>" . $usuario . "</strong>" ?></h3>
                    <p>Para cualquier consulta, no dudes en ponerte en contacto con nosotros</p>
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" readonly>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>" readonly>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly>
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>" readonly> <br>
                    <textarea name="textarea" rows="10" cols="50">Escribe tu opinión...</textarea>

                    <br><br>

                    <input type="submit" id="enviar" name="enviar" class="btn btn-success" style="background-color:green;" value="Enviar">
                </div>
        </div>
        <!--FIN FORMULARIO-->
    </div>
    </form>
</body>

</html>