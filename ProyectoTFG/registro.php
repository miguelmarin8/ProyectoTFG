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
    <title>Página Registro</title>
</head>


<body>

    <?php
    $errores = [];
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $date = date("Y-m-d H:i:s");
    $date_alta = date("Y-m-d H:i:s");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //validar los datos.
        $nombre = filtrado($_POST['nombre']);
        $apellidos = filtrado($_POST['apellidos']);
        $email = filtrado($_POST['email']);
        $usuario = filtrado($_POST['usuario']);
        $password = filtrado($_POST['password']);

        
        if (isset($_POST["registrar"])) {
            $correo = $conexion->comprobarCorreo($email);
            $nombreUsu = $conexion->comprobarUsuario($usuario);
            if (empty($nombre)) {
                $errores[] = "- El nombre no puede estar vacío";
            } elseif (strlen($nombre) > 10) {
                $errores[] = "- El nombre no puede tener más de 10 letras";
            } elseif (ctype_alpha($nombre) == FALSE) {
                $errores[] = "- El nombre no puede tener caracteres numéricos ni espacios";
            } elseif (empty($apellidos)) {
                $errores[] = "- El apellido no puede estar vacío";
            } elseif (strlen($apellidos) > 20) {
                $errores[] = "- El apellido no puede tener más de 20 letras";
            } elseif (empty($email)) {
                $errores[] = "- El email no puede estar vacío";
            } elseif (strlen($email) > 100) {
                $errores[] = "- El email no puede tener más de 100 letras";
            } elseif (empty($usuario)) {
                $errores[] = "- El usuario no puede estar vacío";
            } elseif (strlen($usuario) > 20) {
                $errores[] = "- El usuario no puede tener más de 20 caracteres";
            } elseif (empty($password)) {
                $errores[] = "- La contraseña no puede estar vacíoa";
            } elseif (strlen($password) > 20) {
                $errores[] = "- La contraseña no puede tener más de 20 caracteres";
            } elseif ($correo != NULL) {
                $errores[] = "- Ese correo ya esta en uso";
            } elseif ($nombreUsu != NULL) {
                $errores[] = "- Ese usuario ya esta en uso";
            } else {
                $conexion->registroUsuario($nombre, $apellidos, $email, $usuario, $password, $date, $date_alta);
                header("location:inicio.php");
            }
        }
    } else {
    }

    ?>
    <div class="container">
        <!--FORMULARIO-->
        <div class="m-0 vh-100 row justify-content-center align-items-center">
            <form id="formularioRegistro" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-user" style="font-size: 40px ;"></i><br>
                    <h3><strong>REGISTER</strong></h3>
                    <p>Muchas gracias por confiar en nosotros. ¡APÚNTATE!</p>
                    <br>
                    <strong>
                        <p>Introduzca los siguientes datos personales</p>
                    </strong>
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" onchange="DATOS()" value="<?php echo (!empty($_POST['nombre'])) ? filtrado($_POST['nombre']) : ''; ?>">
                    <label for="password">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" onchange="DATOS()" value="<?php echo (!empty($_POST['apellidos'])) ? filtrado($_POST['apellidos']) : ''; ?>">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" onchange="DATOS()">

                    <div id="DATOS" style="display: none;">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo (!empty($_POST['usuario'])) ? filtrado($_POST['usuario']) : ''; ?>">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"><br>
                    </div><br>
                    <!--VISUALIZAR ERRORES-->
                    <?php
                    if (!empty($errores)) {
                        echo '<strong> <span style="color:red">' . implode("<br>", $errores) . '</span> </strong><br><br>';
                    }
                    ?>
                    <!--VISUALIZAR ERRORES-->
                    <input type="submit" id="registrar" name="registrar" class="btn btn-success" value="Register"><br><br>
                    <h6 style="font-size: 12px;color: #C1C1C1;">Al registrarte, aceptas nuestras Condiciones. <br> Obtén más
                        información sobre cómo recopilamos, usamos y compartimos tus datos en la <br>
                        Política de datos, así como el uso que hacemos de las <br> cookies y tecnologías similares en la Política de cookies.</h6>

                </div>
                <br>
                <p>¿Ya tienes cuenta?<a href="inicio.php"> Inicia Sesión</a></p>
            </form>

        </div>
        <!--FIN FORMULARIO-->
    </div>
</body>

</html>