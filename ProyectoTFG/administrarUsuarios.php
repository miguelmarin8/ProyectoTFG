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
    <title>administrar Usuarios</title>
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
    $datosUsuarios = $conexion->tablaUsuarios();
    // $datosProductos = $conexion->tablaProductos();

    echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        for ($i = 0; $i < count($datosUsuarios); $i++) {
            if (isset($_POST["eliminarUsuario$i"])) {
                //$conexion->eliminarCuenta($_POST["id_usuario$i"]);
                //header("location:areaAdministrador.php");
                echo $_POST["id_usuario$i"];
            }
        }

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }

    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">ADMINISTRAR USUARIOS</p>
        <p class="display-7" style="font-family: cursive;"></p>
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
            <h1 style="justify-content:center;text-align:center">TABLA USUARIOS</h1>
            <table id="tablax" class="table">
                <thead class="text-center">
                    <tr>
                        <th style="background-color: #ECECEC;">Id</th>
                        <th style="background-color: #ECECEC;">Nombre</th>
                        <th style="background-color: #ECECEC;">Apellidos</th>
                        <th style="background-color: #ECECEC;">Email</th>
                        <th style="background-color: #ECECEC;">Usuario</th>
                        <th style="background-color: #ECECEC;">Última Sesión</th>
                        <th style="background-color: #ECECEC;">Fecha Alta</th>
                        <th style="background-color: #ECECEC;">Editar</th>
                        <th style="background-color: #ECECEC;">Borrar</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    for ($i = 0; $i < count($datosUsuarios); $i++) {
                        echo "<tr>";
                        echo "<td> <input readonly type = 'text' name = 'id_usuario$i' style = 'text-align: center; border: 0; width: 50px; background-color: white' value='" . $datosUsuarios[$i]['id_usuario'] . "'</td>";
                        echo "<td>"  . $datosUsuarios[$i]['nombre'] . "</td>";
                        echo "<td>"  . $datosUsuarios[$i]['apellidos'] . "</td>";
                        echo "<td>"  . $datosUsuarios[$i]['email'] . "</td>";
                        echo "<td>"  . $datosUsuarios[$i]['usuario'] . "</td>";
                        echo "<td>"  . $datosUsuarios[$i]['fecha'] . "</td>";
                        echo "<td>"  . $datosUsuarios[$i]['fecha_alta'] . "</td>";
                        if ($datosUsuarios[$i]['id_usuario'] == 1) {
                            echo "<td><button disabled id='modificar" . $i . "' name='modificar" . $i . "' class='btn btn-warning'><i class='fa fa-fw fa-pen'></i></button></td>";
                        } else {
                            echo "<td><button id='modificar" . $i . "' name='modificar" . $i . "' class='btn btn-warning'><i class='fa fa-fw fa-pen'></i></button></td>";
                        }
                        echo "</td>";
                        if ($datosUsuarios[$i]['id_usuario'] == 1) {
                            echo "<td><input disabled type = 'submit' id='eliminarUsuario" . $i . "' name='eliminarUsuario" . $i . "' value = 'Eliminar'/></td>";
                        } else {
                            echo "<td><input type = 'submit' id='eliminarUsuario" . $i . "' name='eliminarUsuario" . $i . "' value = 'Eliminar'/></td>";
                        }
                        echo "</td>";

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!--FIN TABLA USUARIOS -->
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