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
    <script type="text/javascript" src="js/funciones.js"></script>

    <title>Sistema de pago</title>
</head>
<style>
    #foto {
        list-style: none;
        margin: 50px;
    }

    #foto {
        transition: transform .2s;
    }

    #foto:hover {
        transform: scale(1.4);
    }

    #imagen {
        max-width: 400px;
        margin-top: 30px;
        margin: auto;
        display: block;
    }
</style>


<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $usuario = $_SESSION['usuario'];
    $productos = $conexion->seleccionarProductosCarrito(); //Ver cuantos productos hay en el carrito
    $date = date("Y-m-d H:i:s");
    $errores = [];
    $datosUsu = $conexion->datosUsuario($_SESSION['usuario']);
    $nombreUsu = $datosUsu[0]['nombre'];
    $apellidosUsu = $datosUsu[0]['apellidos'];

    $cacularPrecioTotal = $conexion->sumarCarrito(); //Sumar precios

    $precioTotal = implode(',', $cacularPrecioTotal); //Para sacar solo el valor del array


    /*echo '<pre>';
    print_r($productos);
    echo '</pre>';
*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nombre = filtrado($_POST['nombre']);
        $apellidos = filtrado($_POST['apellidos']);
        $usuario2 = filtrado($_POST['usuario']);
        $clave = filtrado($_POST['clave']);
        $tipo_pago = filtrado($_POST['tipo_pago']);
        $numero_tarjeta = filtrado($_POST['numero_tarjeta']);
        $fecha_cad = filtrado($_POST['fecha_cad']);
        $email_pay = filtrado($_POST['email_pay']);
        $contra_pay = filtrado($_POST['contra_pay']);



        if (isset($_POST["pagar"])) {
            for ($i = 0; $i < count($productos); $i++) {
                $conexion->insertarCompra($_SESSION['id_usuario'], $productos[$i]['id_producto'], $productos[$i]['precio'], $_POST['nombre'], $_POST['apellidos'], $_POST['usuario'], $_POST['clave'], $_POST['tipo_pago'], $_POST['numero_tarjeta'], $_POST['fecha_cad'], $_POST['email_pay'], $_POST['contra_pay'], $date);
            }
            $conexion->eliminarCarritoEntero();
            $conexion->incrementarTablaCarrito();
        }
    }


    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;color: blue;">FORMULARIO DE PAGO</p>
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

    <?php

    ?>


    <div class="container">
        <!--FORMULARIO-->
        <div class="justify-content-center align-items-center">
            <form id="formularioPago" autocomplete="off" class="text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-credit-card" style="font-size: 40px ;"></i><br>
                    <h3><strong>DATOS DE PAGO</strong></h3>
                    <strong>
                        <p style="color:red">*RELLENA LOS SIGUIENTES CAMPOS PARA FINALIZAR TU COMPRA*</p>
                    </strong>

                    <!--VISUALIZAR ERRORES-->
                    <?php
                    if (!empty($errores)) {
                        echo '<strong> <span style="color:red">' . implode("<br>", $errores) . '</span> </strong><br><br>';
                    }
                    ?>
                    <!--VISUALIZAR ERRORES-->

                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombreUsu; ?>" readonly style="background-color:#FCEFEC">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" value="<?php echo $apellidosUsu; ?>" readonly style="background-color:#FCEFEC">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario; ?>" readonly style="background-color:#FCEFEC">
                    <label for="clave">Contraseña</label>
                    <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
                    <label for="tipo_pago">Tipo Pago</label>
                    <select id="tipo_pago" name="tipo_pago" class="form-control">
                        <option value="NULO"></option>
                        <option value="Visa">Visa</option>
                        <option value="Paypal">Paypal</option>
                    </select>
                    <div id="tarjeta" class="form-group">
                        <label for="numero_tarjeta">Numero Tarjeta</label>
                        <input type="number" class="form-control" name="numero_tarjeta" id="numero_tarjeta" placeholder="Numero Tarjeta">
                    </div>
                    <div id="fechacad" class="form-group">
                        <label for="fecha_cad">Fecha Caducidad</label>
                        <input type="date" class="form-control" name="fecha_cad" id="fecha_cad">
                    </div>
                    <div id="paypal-email" class="form-group">
                        <label for="email_pay">Email Paypal</label>
                        <input type="email" class="form-control" name="email_pay" id="email_pay" placeholder="Email Paypal">
                    </div>
                    <div id="paypal-pass" class="form-group">
                        <label for="contra_pay">Contraseña Pypal</label>
                        <input type="password" class="form-control" name="contra_pay" id="contra_pay" placeholder="Contraseña Paypal"> <br>
                    </div>
                    <br>
                    <p style="font-size:20px;"><?php echo "El precio total de su compra es de: <strong>" . $precioTotal . "€</strong>" ?></p>

                    <input type="submit" id="pagar" name="pagar" class="btn btn-success" value="ACEPTAR Y PAGAR">
                    <br><br>
                </div>

            </form>

        </div>
        <!--FIN FORMULARIO-->
    </div>




</body>

<script type="text/javascript">
    document.getElementById("tipo_pago").addEventListener("change", mostrarOcultar);

    function mostrarOcultar() {
        var selectVal = document.getElementById("tipo_pago").value;
        var tarjeta = document.getElementById("tarjeta");
        var fechacad = document.getElementById("fechacad");
        var paypalemail = document.getElementById("paypal-email");
        var paypalpass = document.getElementById("paypal-pass");

        if (selectVal == "Visa") {
            paypalemail.style.display = "None";
            paypalpass.style.display = "None";
            tarjeta.style.display = "block";
            fechacad.style.display = "block";
        } else {
            paypalemail.style.display = "block";
            paypalpass.style.display = "block";
            tarjeta.style.display = "None";
            fechacad.style.display = "None";
        }
    }
</script>

</html>