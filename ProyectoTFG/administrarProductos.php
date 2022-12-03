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
    <title>Administrar Productos</title>

</head>
<style>
    td,
    th {
        border: #DCDCDC 1px solid;
    }

    img {
        transition: transform .2s;
    }

    img:hover {
        transform: scale(5);
    }
</style>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $datosProductos = $conexion->tablaProductos();
    echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";

        if (isset($_POST["guardarProducto"])) {
            $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $id_talla = $_POST['id_talla'];
            $existencias = $_POST['existencias'];

            $rutaenservidor = "img";
            $rutatemporal = $_FILES['imagen']['tmp_name'];
            $rutadestino = $rutaenservidor . "/" . $_FILES['imagen']['name'];
            $insertar = $conexion->anadirProducto($id_producto, $nombre, $precio, $id_talla, $existencias, $rutadestino);
            header("location:administrarProductos.php");
        }
    }



    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color:black;">AREA ADMINISTRADOR</p>
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
    <!--TABLA USUARIOS--->
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-top: 100px;">
        <div class="container" id="usuarios" style="margin-top: 10px;padding-bottom: 100px;">
            <h1 style="justify-content:center;text-align:center">TABLA PRODUCTOS</h1>
            <div class="container" style="padding-bottom:30px">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Nuevo Producto</button>
                    </div>
                </div>
            </div>
            <table id="tablax" class="table">
                <thead class="text-center">
                    <tr>
                        <th style="background-color: #ECECEC;">Id Registro</th>
                        <th style="background-color: #ECECEC;">Id Producto</th>
                        <th style="background-color: #ECECEC;">Nombre</th>
                        <th style="background-color: #ECECEC;">Precio</th>
                        <th style="background-color: #ECECEC;">Talla</th>
                        <th style="background-color: #ECECEC;">Existencias</th>
                        <th style="background-color: #ECECEC;">Imagen</th>
                        <th style="background-color: #ECECEC;">Editar</th>
                        <th style="background-color: #ECECEC;">Borrar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    for ($i = 0; $i < count($datosProductos); $i++) {
                        echo "<tr>";
                        echo "<td> <input readonly type = 'text' name = 'id_registro$i' style = 'text-align: center; border: 0; width: 50px; background-color: white' value='" . $datosProductos[$i]['id_registro'] . "'</td>";
                        echo "<td>"  . $datosProductos[$i]['id_producto'] . "</td>";
                        echo "<td>"  . $datosProductos[$i]['nombre'] . "</td>";
                        echo "<td>"  . $datosProductos[$i]['precio'] . "</td>";
                        echo "<td>";
                        if ($datosProductos[$i]['id_talla'] == 1) {
                            echo "XXS";
                        } elseif ($datosProductos[$i]['id_talla'] == 2) {
                            echo "XS";
                        } elseif ($datosProductos[$i]['id_talla'] == 3) {
                            echo "S";
                        } elseif ($datosProductos[$i]['id_talla'] == 4) {
                            echo "M";
                        } elseif ($datosProductos[$i]['id_talla'] == 5) {
                            echo "L";
                        } elseif ($datosProductos[$i]['id_talla'] == 6) {
                            echo "XL";
                        } else {
                            echo "XXL";
                        }
                        echo "</td>";
                        echo "<td>"  . $datosProductos[$i]['existencias'] . "</td>";
                        echo "<td>"  . '<img style = "max-width: 90px" src = "' . $datosProductos[$i]['imagen'] . '"/>' . "</td>";
                        echo "<td><input type = 'submit' id='modificarProducto" . $i . "' name='modificarProducto" . $i . "' value = 'Modificar'/></td>";
                        echo "<td><input type = 'submit' id='eliminarProducto" . $i . "' name='eliminarProducto" . $i . "' value = 'Eliminar'/></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--FIN TABLA USUARIOS -->
    </form>

    <!-- MODAL NUEVO ROL -->
    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color: #0d6efd; color: white;">
                        <h4 class="modal-title">Productos</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="container">
                        <!--FORMULARIO-->
                        <div class="m-0 row justify-content-center align-items-center">
                            <div class="form-group">
                                <h3><strong>NUEVO PRODUCTO</strong></h3>
                                <p style="color:red">*Para añadir un nuevo producto debes rellenar todos los campos*</p>
                                <br>
                                <label for="id_producto">Identificación Producto</label>
                                <input type="text" class="form-control" name="id_producto" id="id_producto" value="" required>
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="" required>
                                <label for="precio">Precio</label>
                                <input type="number" class="form-control" name="precio" id="precio" value="" required>
                                <label for="talla">Talla</label> <br>
                                <select name="id_talla">
                                    <option value="1">XSS</option>
                                    <option value="2">XS</option>
                                    <option value="3">S</option>
                                    <option value="4">M</option>
                                    <option value="5">L</option>
                                    <option value="6">XL</option>
                                    <option value="7">XXL</option>
                                </select> <br><br>
                                <label for="existencias">Existencias</label>
                                <input type="text" class="form-control" name="existencias" id="existencias" value="" required>
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control" name="imagen" id="imagen" value="" required> <br>
                            </div>
                        </div>
                        <!--FIN FORMULARIO-->
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="guardarProducto" name="guardarProducto" class="btn btn-success" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
        <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        </form>

        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <!-- DATATABLES -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <!-- BOOTSTRAP -->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
</body>

</html>