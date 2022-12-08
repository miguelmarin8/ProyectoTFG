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
    <link rel="stylesheet" href="css/estilos.css">
    <title>Sección Mujer</title>
</head>

<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $usuario = $_SESSION['usuario'];

    $imagenes = $conexion->seleccionarPantalonMujer();


    /*
    echo '<pre>';
    print_r($imagenes);
    echo '</pre>';
*/

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        for ($i = 0; $i < count($imagenes); $i++) {
            if (isset($_POST["informacion$i"])) {

                $_SESSION['id_producto'] = $_POST["id_producto$i"];

                if ($_SESSION['id_producto'] == 42) {
                    header("location:pantalonMujer1.php");
                }
            }
        }

        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }


    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">SECCIÓN HOMBRE</p>
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
                            <li><a class="dropdown-item" href="otros/cerrarSesion.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- FIN MENÚ -->

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <div class="container" style="margin-top: 100px;">
            <div class="row align-items-center">
                <?php for ($i = 0; $i < 3; $i++) {
                ?>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <?php
                            echo "<td> <input readonly type = 'text' name = 'id_producto$i' value='" . $imagenes[$i]['id_producto'] . "'</td>";
                            echo "<td>"  . '<img style = "max-width: 550px" src = "' . $imagenes[$i]['imagen'] . '"/>' . "</td>";
                            echo "<br>";
                            echo "<strong>" . $imagenes[$i]['nombre'] . "</strong>";
                            echo "<input type = 'submit' id='informacion" . $i . "' name='informacion" . $i . "' value = 'Información'/>";
                            ?>
                        </div>
                    </div>
                <?php
                } ?> </p>
            </div>

        </div>


        <!--SEGUNDA LÍNEA-->
        <div class="container" style="margin-top: 100px;">
            <div class="row align-items-center">
                <?php for ($i = 3; $i < 6; $i++) {
                ?>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <?php
                            echo "<td> <input readonly type = 'text' name = 'id_producto$i' value='" . $imagenes[$i]['id_producto'] . "'</td>";
                            echo "<td>"  . '<img style = "max-width: 550px" src = "' . $imagenes[$i]['imagen'] . '"/>' . "</td>";
                            echo "<br>";
                            echo "<strong>" . $imagenes[$i]['nombre'] . "</strong>";
                            echo "<input type = 'submit' id='informacion" . $i . "' name='informacion" . $i . "' value = 'Información'/>";
                            ?>
                        </div>
                    </div>

                <?php
                } ?> </p>
            </div>

        </div>

        <!--TERCERA LÍNEA-->
        <div class="container" style="margin-top: 100px;">
            <div class="row align-items-center">
                <?php for ($i = 6; $i < 9; $i++) {
                ?>
                    <div class="col">
                        <div class="card text-center" style="width: 18rem;">
                            <?php
                            echo "<td> <input readonly type = 'text' name = 'id_producto$i' value='" . $imagenes[$i]['id_producto'] . "'</td>";
                            echo "<td>"  . '<img style = "max-width: 550px" src = "' . $imagenes[$i]['imagen'] . '"/>' . "</td>";
                            echo "<br>";
                            echo "<strong>" . $imagenes[$i]['nombre'] . "</strong>";
                            echo "<input type = 'submit' id='informacion" . $i . "' name='informacion" . $i . "' value = 'Información'/>";
                            ?>
                        </div>
                    </div>

                <?php
                } ?> </p>
            </div>

        </div>
    </form>

    <div class="container">
        <!--FORMULARIO-->
        <div class="row justify-content-center align-items-center">
            <form class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">VER MÁS PRODUCTOS</button>
                </div>
            </form>

        </div>
        <!--FIN FORMULARIO-->
    </div>


    <!-- Footer -->
    <footer class="text-center text-muted" style="background-color: rgba(0, 0, 0, 0.025); margin-top:100px;">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a target="_blank" href="https://es-es.facebook.com/" class="me-4 link-secondary">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a target="_blank" href="https://twitter.com/?lang=es" class="me-4 link-secondary">
                    <i class="fab fa-twitter"></i>
                </a>
                <a target="_blank" href="https://www.google.es/" class="me-4 link-secondary">
                    <i class="fab fa-google"></i>
                </a>
                <a target="_blank" href="https://www.instagram.com/" class="me-4 link-secondary">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3 text-secondary"></i>COMPAÑIA HR
                        </h6>
                        <p>
                            En esta pagina tenemos productos de buena calidad y buenos precios, confia en nosotros,
                            no te vamos a defraudar.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Productos
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">CAMISETAS</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">PANTALONES</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">ZAPATLLIAS</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">SUDADERAS</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3 text-secondary"></i> MADRID, MA 10012, ES</p>
                        <p>
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            mmarinb12@gmail.com
                        </p>
                        <p><i class="fas fa-phone me-3 text-secondary"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3 text-secondary"></i> + 01 234 567 89</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="">MR.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>

</html>