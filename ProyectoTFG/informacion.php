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
    <title>Compra</title>
</head>
<style>
    #fotoNike {
        list-style: none;
    }

    #fotoNike {
        transition: transform .2s;
    }

    #fotoNike:hover {
        transform: scale(1.5);
    }
</style>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();


    $datosProducto = $conexion->seleccionarProducto(1);
    $nombre = $datosProducto[0]['nombre'];
    $precio = $datosProducto[0]['precio'];
    $tallaS = $datosProducto[0]['id_talla'];
    $tallaM = $datosProducto[1]['id_talla'];
    $tallaL = $datosProducto[2]['id_talla'];
    $existencias = $datosProducto[0]['existencias'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["añadirCarrito"])) {
            $conexion->añadirCarrito($_POST['id_producto'], $_POST['nombre'], $_POST['precio'], $_POST['existencias'], $_POST['talla'], $_POST['color']);
        }
    }

    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">BIENVENIDO A MR</p>
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

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- FIN MENÚ -->


    <!--DESARROLLO TABLAS--->
    <!--TARJETAS--->
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-sm" style="background: #EFF1F4; margin: 10px; height: 50%;">
                <li id="fotoNike"><img src="img/camisetaNikeBlanca.jpg" style="max-width: 530px; margin-top: 30px;"></li>
                <li id="fotoNike"><img src="img/camisetaNikeRoja.jpg" style="max-width: 130px; margin-top: 30px;float: left; margin: 20px;"></li>
                <li id="fotoNike"><img src="img/camisetaNikeNegra.jpg" style="max-width: 130px; margin-top: 30px;float: left; margin: 20px;"></li>
                <li id="fotoNike"><img src="img/camisetaNikeAzul.jpg" style="max-width: 130px; margin-top: 30px;float: left; margin: 20px;"></li>
            </div>

            <div class="col-sm" style="background: azure;border: grey 2px solid; margin: 10px;">
                <!--FORMULARIO-->
                <div class="m-0 row justify-content-center align-items-center">
                    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <i class="fa fa-solid fa-cart-arrow-down" style="font-size: 40px ;"></i><br>
                            <h3><strong>CAMISETA NIKE UNISEX</strong></h3>
                            <p>Camiseta de algodón perfecta para realizar cualquier <br> tipo de deporte o usar en tu vida cotidiana.</p>
                            <br>
                            <input type="text" class="form-control" name="id_producto" id="id_producto" value="1" hidden>
                            <label for="nombre">Nombre Producto</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" readonly>
                            <label for="precio">Precio(€)</label>
                            <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $precio; ?> €" readonly>
                            <label for="existencias">Existencias</label>
                            <input type="text" class="form-control" name="existencias" id="existencias" value="<?php echo $existencias; ?>" readonly><br>
                            <label for="talla">Tallas Disponibles</label>
                            <select name="talla">
                                <option value="<?php echo $tallaS; ?>">S</option>
                                <option value="<?php echo $tallaM; ?>">M</option>
                                <option value="<?php echo $tallaL; ?>">L</option>
                            </select><br>
                            <label for="color">Color</label>
                            <select name="color">
                                <option value="Blanco">Blanco</option>
                                <option value="Rojo">Rojo</option>
                                <option value="Azul">Azul</option>
                                <option value="Negro">Negro</option>
                            </select><br><br>
                            <input type="submit" id="añadirCarrito" name="añadirCarrito" class="btn btn-success" value="Añadir Al Carrito"> <br><br>
                            <strong>
                                <p style="font-family:cursive;">*Tiempo estimado de entrega , 2 - 4 días laborables* <i class="fas fa-truck-moving"></i></p>
                            </strong>
                        </div>
                </div>
                <!--FIN FORMULARIO-->

            </div>
        </div>
    </div>
    </form>

</body>

</html>