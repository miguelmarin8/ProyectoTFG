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
    <title>Productos</title>

</head>
<style>
    td,
    th {
        border: #DCDCDC 1px solid;
    }
</style>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();

    echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";


        if (isset($_POST["guardar"])) {
            $id_producto = $_POST['id_producto'];
            $nombre = $_POST['nombre'];
            $color = $_POST['color'];
            $precio = $_POST['precio'];
            $id_talla = $_POST['id_talla'];
            $existencias = $_POST['existencias'];

            $revisar = getimagesize($_FILES["image"]["tmp_name"]);
            if ($revisar !== false) {
                $image = $_FILES['image']['tmp_name'];
                $imgContenido = addslashes(file_get_contents($image));
                $insertar=$conexion->anadirProducto($id_producto,$nombre,$color,$precio,$id_talla,$existencias,$imgContenido);
            }
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

    <div class="container">
        <!--FORMULARIO-->
        <div class="m-0 row justify-content-center align-items-center">
            <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <i class="fa fa-fw fa-download" style="font-size: 40px ;"></i><br>
                    <h3><strong>NUEVO PRODUCTO</strong></h3>
                    <p>Para añadir un nuevo producto debes rellenar todos los campos</p>
                    <br>
                    <label for="id_producto">Identificación Producto</label>
                    <input type="text" class="form-control" name="id_producto" id="id_producto" value="">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" name="color" id="color" value="">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" name="precio" id="precio" value="">
                    <label for="talla">Talla</label>
                    <input type="text" class="form-control" name="id_talla" id="id_talla" value="">
                    <label for="existencias">Existencias</label>
                    <input type="text" class="form-control" name="existencias" id="existencias" value="">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" name="image" id="image" value=""> <br>
                    <input type="submit" id="guardar" name="guardar" class="btn btn-success" value="Guardar Cambios">
                    <a href="areaAdministrador.php"><button type="button" id="eliminar" name="eliminar" class="btn btn-danger">Volver</button></a>
                </div>
        </div>
        <!--FIN FORMULARIO-->
    </div>



</body>

</html>