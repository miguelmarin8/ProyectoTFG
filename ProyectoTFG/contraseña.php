<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <title>Página Recuperar Contraseña</title>
</head>


<body>

    <?php
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //validar los datos.
        $email = filtrado($_POST['email']);

        $destino = $email;
        $correo = "miguelmarinberrocal@gmail.com";
        $mensaje = "Buenos días";

        $contenido = "Hola buenos díaaaaaaaaas";

        mail($destino,"Recuperar Contraseña",$contenido);
        header("location:inicio.php");
    }
    ?>

    <div class="container">
        <!--FORMULARIO-->
        <div class="m-0 vh-100 row justify-content-center align-items-center">
            <form id="formularioRegistro" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-user-lock" style="font-size: 40px ;"></i><br>
                    <h3><strong>RECUPERAR CONTRASEÑA</strong></h3>
                    <p>¿Tienes problemas para iniciar sesión?</p>
                    <p>Intruce su correo electrónico y le mandaremos los pasos para recuperar su contraseña</p>
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    <br>
                    <input type="submit" id="registrar" name="registrar" class="btn btn-success" value="Register"><br><br>
                </div>
                <hr style="width:40%; float: left;">O
                <hr style="width:40%;float: right;">
                <br>
                <br>

                <p>Don´t have an account?<a href="registro.php"> Sing Up</a></p>

            </form>

        </div>
        <!--FIN FORMULARIO-->
    </div>
</body>

</html>