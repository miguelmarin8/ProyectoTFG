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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Compra</title>
</head>


<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosCarrito = $conexion->seleccionarCarrito();


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        for ($i = 0; $i < count($datosCarrito); $i++) {
            if (isset($_POST["eliminarProducto$i"])) {
                $conexion->eliminarCarrito($_POST["id$i"]);
                header("location:carrito.php");
            }
        }

        if(isset($_POST['revisar']))
        {
           $precioTotal = $conexion->sumarCarrito();
        }

        print_r($precioTotal);
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


    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-top: 100px;">
        <div class="container" id="usuarios" style="margin-top: 10px;padding-bottom: 100px;">
            <h1 style="justify-content:center;text-align:center"><?php echo "Hola " . $_SESSION['usuario'] . " esta es tu elección" ?></h1><br>
            <table id="tablax" class="table">
                <thead class="text-center">
                    <tr>
                        <th style="background-color: #ECECEC;">Id Registro</th>
                        <th style="background-color: #ECECEC;">Id Producto</th>
                        <th style="background-color: #ECECEC;">Nombre</th>
                        <th style="background-color: #ECECEC;">Precio</th>
                        <th style="background-color: #ECECEC;">Existencias</th>
                        <th style="background-color: #ECECEC;">Talla</th>
                        <th style="background-color: #ECECEC;">Cantidad</th>
                        <th style="background-color: #ECECEC;">Borrar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    for ($i = 0; $i < count($datosCarrito); $i++) {
                        echo "<tr>";
                        echo "<td> <input readonly type = 'text' name = 'id$i' style = 'text-align: center; border: 0; width: 50px; background-color: white' value='" . $datosCarrito[$i]['id'] . "'</td>";
                        echo "<td>"  . $datosCarrito[$i]['id_producto'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['nombre'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['precio'] . "</td>";
                        echo "<td>"  . $datosCarrito[$i]['existencias'] . "</td>";
                        echo "<td>";
                        if ($datosCarrito[$i]['id_talla'] == 1) {
                            echo "XXS";
                        } elseif ($datosCarrito[$i]['id_talla'] == 2) {
                            echo "XS";
                        } elseif ($datosCarrito[$i]['id_talla'] == 3) {
                            echo "S";
                        } elseif ($datosCarrito[$i]['id_talla'] == 4) {
                            echo "M";
                        } elseif ($datosCarrito[$i]['id_talla'] == 5) {
                            echo "L";
                        } elseif ($datosCarrito[$i]['id_talla'] == 6) {
                            echo "XL";
                        } else {
                            echo "XXL";
                        }
                        echo "</td>";
                        echo "<td>"  . $datosCarrito[$i]['color'] . "</td>";
                        echo "<td><input type = 'submit' id='eliminarProducto" . $i . "' name='eliminarProducto" . $i . "' value = 'Eliminar'/></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <input type="submit" id="pagar" name="pagar" value="Pagar" style="float:right;margin: 10px;">
            <input type="submit" id="revisar" name="revisar" value="Calcular Precio" style="float:right;margin: 10px">
            <p><?php echo "El precio total de su compra es de: " . $precioTotal . "€ muchas gracias."?></p>
        </div>
    </form>


</body>

</html>