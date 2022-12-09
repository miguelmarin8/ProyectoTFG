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

    /*echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        if (isset($_POST['editarProducto'])) {
            $conexion->editarProducto($_POST['nombreP'], $_POST['sexoP'], $_POST['precioP'], $_POST['existenciasP'], $_POST['id_productoP']);
            echo '<script>alert("Producto modificado correctamente")
            document.location=("administrarProductos.php");
            </script>';
        }


        
        if (isset($_POST['eliminarProducto'])) {
            $conexion->eliminarProductoCompra($_POST['id_productoP2']);
            $conexion->eliminarProductoEvaluaciones($_POST['id_productoP2']);
            $conexion->eliminarProducto($_POST['id_productoP2']);
            $conexion->incrementarTablaProducto();
            $conexion->incrementarTablaEvaluaciones();


            echo '<script>alert("Producto eliminado correctamente")
            document.location=("administrarProductos.php");
            </script>';
        }

        if (isset($_POST["guardarProducto"])) {
            $nombre = $_POST['nombre'];
            $sexo = $_POST['sexo'];
            $precio = $_POST['precio'];
            $existencias = $_POST['existencias'];

            $rutaenservidor = "img";
            $rutatemporal = $_FILES['imagen']['tmp_name'];
            $rutadestino = $rutaenservidor . "/" . $_FILES['imagen']['name'];
            $insertar = $conexion->anadirProducto($nombre, $sexo, $precio, $existencias, $rutadestino);
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

    <!--TABLA PRODUCTOS--->
    <div class="container" id="productos" style="margin-top: 50px;padding-bottom: 100px;">
        <h1 style="justify-content:center;text-align:center">TABLA PRODUCTOS</h1>
        <div class="row">
            <div class="container" style="padding-bottom:30px">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 20px; color: white; margin-top: 20px;">Nuevo Producto</button>
                    </div>
                </div>
            </div>
        </div>
        <table id="tablaProductos" class="table">
            <thead class="text-center">
                <tr>
                    <th style="background-color: #ECECEC;">Id Producto</th>
                    <th style="background-color: #ECECEC;">Nombre</th>
                    <th style="background-color: #ECECEC;">Sexo</th>
                    <th style="background-color: #ECECEC;">Precio</th>
                    <th style="background-color: #ECECEC;">Existencias</th>
                    <th style="background-color: #ECECEC;">Imagen</th>
                    <th style="background-color: #ECECEC;">Editar</th>
                    <th style="background-color: #ECECEC;">Eliminar</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($datosProductos); $i++) {
                    echo "<tr>";
                    echo "<td>"  . $datosProductos[$i]['id_producto'] . "</td>";
                    echo "<td>"  . $datosProductos[$i]['nombre'] . "</td>";
                    echo "<td>"  . $datosProductos[$i]['sexo'] . "</td>";
                    echo "<td>"  . $datosProductos[$i]['precio'] . "</td>";
                    echo "<td>";
                    if ($datosProductos[$i]['existencias'] > 0) {

                        echo "<strong><p style = 'color:#0DA262'>" . $datosProductos[$i]['existencias'] . "</p></strong>";
                    } else {
                        echo "<strong><p style = 'color:red'>" . $datosProductos[$i]['existencias'] . "</p></strong>";
                    }

                    echo "</td>";
                    echo "<td>"  . '<img style = "max-width: 50px" src = "' . $datosProductos[$i]['imagen'] . '"/>' . "</td>";
                    echo "<td><button class='btn btn-warning btnEditarProducto'><i class='fa fa-fw fa-pen'></i></button></td>";
                    echo "<td><button class='btn btn-danger btnBorrarProducto'><i class='fa fa-fw fa-trash'></i></button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!--FIN TABLA PRODUCTOS -->

    <!-- MODAL NUEVO PRODUCTO -->
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
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="" required> <br>
                                <label for="sexo">Sexo</label> <br>
                                <select name="sexo">
                                    <option value="Hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                    <option value="Unisex">Unisex</option>
                                </select> <br><br>
                                <label for="precio">Precio</label>
                                <input type="number" class="form-control" name="precio" id="precio" value="" required>
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
    </form>

    <!--MODAL PARA MODFICAR-->
    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <h3><strong>EDITAR PRODUCTO</strong></h3>
                                <br>
                                <label for="id_productoP">id Producto</label>
                                <input type="text" class="form-control" name="id_productoP" id="id_productoP" readonly>
                                <label for="nombreP">Nombre</label>
                                <input type="text" class="form-control" name="nombreP" id="nombreP">
                                <label for="sexoP">Sexo</label>
                                <input type="text" class="form-control" name="sexoP" id="sexoP">
                                <label for="precioP">Precio</label>
                                <input type="text" class="form-control" name="precioP" id="precioP">
                                <label for="existenciasP">Existencias</label>
                                <input type="text" class="form-control" name="existenciasP" id="existenciasP">
                            </div>
                        </div>
                        <!--FIN FORMULARIO-->
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="editarProducto" name="editarProducto" class="btn btn-success" value="Guardar Cambios">
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!--MODAL PARA ELIMINAR-->
    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <!-- Modal Header -->
                        <div class="modal-header" style="background-color: #0d6efd; color: white;">
                            <h4 class="modal-title">Eliminar</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="container">
                            <!--FORMULARIO-->
                            <div class="m-0 row justify-content-center align-items-center">
                                <div class="form-group">
                                    <h3><strong>ELIMINAR PRODUCTO</strong></h3>
                                    <strong>
                                        <p style="font-size:17px">¿Estas seguro de querer eliminar permanentemente este producto?</p>
                                    </strong>
                                    <br>
                                    <label for="id_productoP2">Id Producto</label>
                                    <input type="text" class="form-control" name="id_productoP2" id="id_productoP2" readonly>
                                    <label for="nombreP2">Nombre</label>
                                    <input type="text" class="form-control" name="nombreP2" id="nombreP2" readonly>
                                </div>
                            </div>
                            <!--FIN FORMULARIO-->
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" id="eliminarProducto" name="eliminarProducto" class="btn btn-success" value="Aceptar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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