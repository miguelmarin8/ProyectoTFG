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

   /* echo '<pre>';
    print_r($_SESSION['usuario']);
    echo '</pre>';
*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        /*echo "<pre>";
        print_r($_POST);
        echo "</pre>";*/

        if (isset($_POST['editarUsuario'])) {
            $conexion->modificarRegistroAdmin($_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['usuario'], $_POST['id_usuario']);
            
            echo '<script>alert("Usuario modificado correctamente")
            document.location=("administrarUsuarios.php");
            </script>';
        }

        if (isset($_POST['eliminarUsuario'])) {
            $conexion->eliminarCuenta($_POST['id_usuario2']);
            $conexion->incrementarTablaRegistro();

            echo '<script>alert("Usuario eliminado correctamente")
            document.location=("administrarProductos.php");
            </script>';
        }
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


    <!--TABLA USUARIOS--->
    <div class="container" id="usuarios" style="margin-top:50px;padding-bottom: 100px;">
        <h1 style="justify-content:center;text-align:center">TABLA USUARIOS</h1>
        <table id="tablaUsuarios" class="table">
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
                    <th style="background-color: #ECECEC;">Eliminar</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($datosUsuarios); $i++) {
                    echo "<tr>";
                    echo "<td>"  . $datosUsuarios[$i]['id_usuario'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['nombre'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['apellidos'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['email'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['usuario'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['fecha'] . "</td>";
                    echo "<td>"  . $datosUsuarios[$i]['fecha_alta'] . "</td>";
                    if ($datosUsuarios[$i]['usuario'] == "MiguelMB") {
                        echo "<td><button disabled class='btn btn-warning btnEditarUsuario'><i class='fa fa-fw fa-pen'></i></button></td>";
                    } else {
                        echo "<td><button class='btn btn-warning btnEditarUsuario'><i class='fa fa-fw fa-pen'></i></button></td>";
                    }
                    echo "</td>";
                    if ($datosUsuarios[$i]['usuario'] == "MiguelMB") {
                        echo "<td><button disabled class='btn btn-danger btnBorrarUsuario'><i class='fa fa-fw fa-trash'></i></button></td>";
                    } else {
                        echo "<td><button class='btn btn-danger btnBorrarUsuario'><i class='fa fa-fw fa-trash'></i></button></td>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!--FIN TABLA USUARIOS -->

    <!--MODAL PARA MODFICAR-->
    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color: #0d6efd; color: white;">
                        <h4 class="modal-title">Usuarios</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="container">
                        <!--FORMULARIO-->
                        <div class="m-0 row justify-content-center align-items-center">
                            <div class="form-group">
                                <h3><strong>EDITAR USUARIO</strong></h3>
                                <br>
                                <label for="id_usuario">Id Usuario</label>
                                <input type="text" class="form-control" name="id_usuario" id="id_usuario" readonly>
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" id="apellidos">
                                <label for="email">Email</label> <br>
                                <input type="text" class="form-control" name="email" id="email">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" id="usuario">
                            </div>
                        </div>
                        <!--FIN FORMULARIO-->
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="editarUsuario" name="editarUsuario" class="btn btn-success" value="Guardar Cambios">
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
                                    <h3><strong>ELIMINAR USUARIO</strong></h3>
                                    <strong>
                                        <p style="font-size:17px">¿Estas seguro de querer eliminar permanentemente este usuario?</p>
                                    </strong>
                                    <br>
                                    <label for="id_usuario2">Id Usuario</label>
                                    <input type="text" class="form-control" name="id_usuario2" id="id_usuario2" readonly>
                                    <label for="email2">Email</label>
                                    <input type="text" class="form-control" name="email2" id="email2" readonly>
                                    <label for="usuario2">Usuario</label>
                                    <input type="text" class="form-control" name="usuario2" id="usuario2" readonly>
                                </div>
                            </div>
                            <!--FIN FORMULARIO-->
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" id="eliminarUsuario" name="eliminarUsuario" class="btn btn-success" value="Aceptar">
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