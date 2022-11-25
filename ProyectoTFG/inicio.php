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
    <script type="text/javascript" src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/estilos.css">
    <title>Página Inicial</title>
</head>


<body>

    <?php
    session_start();
    $errores = [];
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $date = date("Y-m-d H:i:s");

    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        //validar los datos.
        $usuario = filtrado($_POST['usuario']);
        $password = filtrado($_POST['password']);

        if (empty($usuario)) {
            $errores[] = "- El usuario no puede estar vacío";
        }
        if (empty(($password))) {
            $errores[] = "- La contraseña no puede estar vacía";
        }
        if (empty($errores)) {
            $login = $conexion->comprobarRegistro($usuario, $password);
            if ($login != NULL) {
                header('location: paginaPrincipal.php');
                $_SESSION['usuario'] = $_POST['usuario'];
                if ($conexion->registroAnteriores($usuario)) {
                    $conexion->actualizarFecha($date, $usuario);
                } else {
                    echo "Ocurrio algún error";
                }
            } else {
                $errores[] = "El usuario o la contraseña no coinciden";
            }
        }
    } else {
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="m-0 vh-100 row justify-content-center align-items-center">
                    <!-- SLIDER -->

                    <div class="card">
                        <div id="demo" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>

                            </div>
                            <!-- The slideshow/carousel -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/ropa2.jpg" alt="1" class="d-block" style="width:100%">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/ropa1.jpg" alt="2" class="d-block" style="width:100%">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/ropa3.jpg" alt="3" class="d-block" style="width:100%">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/ropa4.jpg" alt="4" class="d-block" style="width:100%">
                                </div>
                            </div>
                            <!-- Left and right controls/icons -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif ;">Bienvenido/a a nuestra pagina oficial, registrate en nuestra página web y encontraras muchos productos y muchas ofertas. ¿Te lo vas a perder?</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- FIN SLIDER -->



            <!--FORMULARIO-->
            <div class="col">
                <div class="m-0 vh-100 row justify-content-center align-items-center">
                    <form id="formularioInicio" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <i class="fa fa-fw fa-user" style="font-size: 40px ;"></i><br>
                            <h3><strong>LOG IN</strong></h3><br>
                            <label for="usuario">Login</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Enter user" value="<?php echo (!empty($_POST['usuario'])) ? filtrado($_POST['usuario']) : ''; ?>">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                            <a href="#" onclick="mostrarContrasena()" style="float:right;">Mostrar Contraseña</a> <br>
                            <!--VISUALIZAR ERRORES-->
                            <?php
                            if (!empty($errores)) {
                                echo '<br><strong> <span style="color:red">' . implode("<br>", $errores) . '</span> </strong> <br>';
                            }
                            ?>
                            <!--VISUALIZAR ERRORES-->
                            <br>
                            <input type="submit" id="log" name="log" class="btn btn-success" value="Log In">
                        </div>
                        <br>
                        <p>Forgot password?<a href="contraseña.php"> Recover Password</a></p>
                        <p>Don´t have an account?<a href="registro.php"> Sing Up</a></p>
                        <br>
                        <div>
                            <h6>Sign In With</h6>
                            <button type="button" class="btn btn-light">Continue With <img id="apple" src="img/apple.jpg" /></button>
                            <button type="button" class="btn btn-light">Continue With <img id="google" src="img/google.jpg" /></button>
                        </div>
                    </form>
                </div>
            </div>
            <!--FIN FORMULARIO-->
        </div>
    </div>

</body>

</html>