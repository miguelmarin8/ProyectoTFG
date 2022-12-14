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
    <title>Administrar Opiniones</title>

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
    $datosOpiniones = $conexion->tablaOpiniones();

    /*echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        for ($i = 0; $i < count($datosOpiniones); $i++) {
            if (isset($_POST["eliminarOpinion$i"])) {
                $conexion->eliminarOpinion($_POST["id$i"]);
                $conexion->incrementarTablaEvaluaciones();
                echo '<script>alert("Comentario eliminado correctamente")
                document.location=("administrarOpiniones.php");
                </script>';
            }
        }
    }



    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color:black;">AREA ADMINISTRADOR</p>
    </div>

 <!-- MEN?? -->
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
                            <i class="fa fa-fw fa-wrench"></i>Configuraci??n
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="cuenta.php"><i class="fa fa-fw fa-user"></i> Cuenta</a></li>
                            <li><a class="dropdown-item" href="verCompras.php"><img src="img/bolsa.jpg" style="max-width: 20px;"> Compras</a></li>
                            <li><a class="dropdown-item" href="otros/cerrarSesion.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesi??n</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN MEN?? -->

    <!--TABLA EVALUACIONES--->
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" style="margin-top: 100px;">
        <div class="container" id="productos" style="margin-top: 50px;padding-bottom: 100px;">
            <h1 style="justify-content:center;text-align:center">TABLA EVALUACIONES</h1>

            <table id="tablaEvaluaciones" class="table">
                <thead class="text-center">
                    <tr>
                        <th style="background-color: #ECECEC;">Registro</th>
                        <th style="background-color: #ECECEC;">Id Usuario</th>
                        <th style="background-color: #ECECEC;">Id Producto</th>
                        <th style="background-color: #ECECEC;">Usuario</th>
                        <th style="background-color: #ECECEC;">Comentario</th>
                        <th style="background-color: #ECECEC;">Eliminar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    for ($i = 0; $i < count($datosOpiniones); $i++) {
                        echo "<td> <input readonly type = 'text' name = 'id$i' style = 'text-align: center; border: 0; width: 50px; background-color: white' value='" . $datosOpiniones[$i]['id'] . "'</td>";
                        echo "<td>"  . $datosOpiniones[$i]['id_usuario'] . "</td>";
                        echo "<td>"  . $datosOpiniones[$i]['id_producto'] . "</td>";
                        echo "<td>"  . $datosOpiniones[$i]['usuario'] . "</td>";
                        echo "<td>"  . $datosOpiniones[$i]['comentario'] . "</td>";
                        echo "<td><input type = 'submit' id='eliminarOpinion" . $i . "' name='eliminarOpinion" . $i . "' value = 'Eliminar' style = 'background-color:#FF5D5D;'/></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
        <!--FIN TABLA PRODUCTOS -->
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <!-- DATATABLES -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <!-- BOOTSTRAP -->
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
</body>

</html>