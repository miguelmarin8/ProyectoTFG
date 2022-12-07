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
    <title>Carrito</title>
</head>

<style>
    #tablaCarrito th {
        background-color: orange;
    }

    #factura {
        float: right;
        margin: 10px;
        background-color: #A7F766;
        border-radius: 10px;
    }
</style>

<body>
    <?php
    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosCarrito = $conexion->seleccionarCarrito();

    $calcularProductos = $conexion->contarProductos();
    $calucalarNombres = $conexion->seleccionarNombreCarrito();
    $cacularPrecioTotal = $conexion->sumarCarrito(); //Sumar precios

    $productosTotal = implode(',', $calcularProductos); //Para sacar solo el valor del array
    $precioTotal = implode(',', $cacularPrecioTotal); //Para sacar solo el valor del array
    //$nombreTotal = implode(',', $calucalarNombres); //Para sacar solo el valor del array

 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        for ($i = 0; $i < count($datosCarrito); $i++) {
            if (isset($_POST["eliminarProducto$i"])) {
                $conexion->eliminarCarrito($_POST["id_carrito$i"]);
                $conexion->incrementarTablaCarrito();
                header("location:carrito.php");
            }
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


    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-top: 100px;">
        <div class="container" id="usuarios" style="margin-top: 10px;padding-bottom: 100px;">
            <h1 style="justify-content:center;text-align:center"><?php echo "Hola " . $_SESSION['usuario'] . " esta es tu elección" ?></h1><br>
            <table id="tablaCarrito" class="table">
                <thead class="text-center">
                    <tr>
                        <th>Registro</th>
                        <th>Id Producto</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Precio</th>
                        <th>Existencias</th>
                        <th>Talla</th>
                        <th>Color</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    for ($i = 0; $i < count($datosCarrito); $i++) {
                        echo "<tr>";
                        echo "<td> <input readonly type = 'text' name = 'id_carrito$i' style = 'text-align: center; border: 0; width: 50px; background-color: white' value='" . $datosCarrito[$i]['id_carrito'] . "'</td>";
                        echo "<td>"  . $datosCarrito[$i]['id_producto'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['nombre'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['sexo'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['precio'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['existencias'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['talla'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['color'] . "</td>";
                        echo "<td><input type = 'submit' id='eliminarProducto" . $i . "' name='eliminarProducto" . $i . "' value = 'Eliminar' style = 'background-color:#FF5D5D;'/></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="button" id="factura" name="factura" onclick="mostrarFactura()">Resumen y Pagar</button>

            <div id="resumenCompra" style="display:none;">
                <h1>Resumen de su compra</h1>
                <p style="font-size:20px;"><?php for ($i = 0; $i < count($calucalarNombres); $i++) {
                                                echo "Usted se lleva: <strong>" . $calucalarNombres[$i]['nombre'] . "</strong>";
                                                print_r("<br>");
                                            } ?> </p>
                <p style="font-size:20px;"><?php echo "Usted se lleva una cantidad de: <strong>" . $productosTotal . "</strong> productos" ?></p>
                <p style="font-size:20px;"><?php echo "El precio total de su compra es de: <strong>" . $precioTotal . "€</strong>" ?></p>
                <input type="submit" id="pagar" name="pagar" value="Pagar">
            </div>
        </div>

    </form>
    <script type="text/javascript" src="js/funciones.js"></script>
</body>

</html>