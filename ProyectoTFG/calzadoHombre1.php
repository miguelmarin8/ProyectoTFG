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
    <script type="text/javascript" src="js/funciones.js"></script>

    <title>Comprar</title>
</head>
<style>
    #foto {
        list-style: none;
        margin: 50px;
    }

    #foto {
        transition: transform .2s;
    }

    #foto:hover {
        transform: scale(1.4);
    }

    #imagen {
        max-width: 400px;
        margin-top: 30px;
        margin: auto;
        display: block;
    }
</style>


<body>

    <?php

    session_start();
    include_once "conexion/conexion.php";
    include_once "otros/filtrado.php";
    $conexion = Singleton::singleton();
    $usuario = $_SESSION['usuario'];
    $datosProducto = $conexion->seleccionarProducto($_SESSION['id_producto']);
    $id_producto = $datosProducto['id_producto'];
    $nombre = $datosProducto['nombre'];
    $sexo = $datosProducto['sexo'];
    $precio = $datosProducto['precio'];
    $existencias = $datosProducto['existencias'];

    $evaluaciones = $conexion->visualizarEvaluaciones($_SESSION['id_producto']);

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST["guardarComentario"])) {
            $conexion->insertarEvaluaciones($_SESSION['id_usuario'], $_SESSION['id_producto'], $_SESSION['usuario'], $_POST['comentario']);
            echo '<script>alert("Tu comentario ha sido guardado con éxito.")
            document.location=("camisetaHombre1.php");
            </script>';
        }

        if (isset($_POST["añadirCarrito"])) {
            $conexion->añadirCarrito($_SESSION['id_producto'], $_POST['nombre'], $_POST['sexo'], $_POST['precio'], $_POST['existencias'],$_POST['talla'], $_POST['color']);
            echo '<script>alert("Producto añadido con éxito.")
            document.location=("camisetaHombre1.php");
            </script>';
        }
    }


    ?>
    <div id="cabecera" class="col-auto p-5 text-center">
        <p class="display-4" style="font-family: Lucida Handwriting;text-shadow: 0px 0px 9px #000;color: black;">BIENVENIDO A MR</p>
        <p class="display-7" style="font-family: cursive;">GRACIAS POR SU CONFIANZA</p>
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
                            <li><a class="dropdown-item" href="hombreCamisetas.php">Camisetas</a></li>
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
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-sm" style="background: #EFF1F4; margin: 10px; height: 50%;">
                <li id="foto"><img id="imagen" src="img/camiseta1.jpg"></li>
            </div>

            <div class="col-sm" style="background: #F3F7F7;border: grey 2px solid; margin: 10px;">
                <!--FORMULARIO-->
                <div class="m-0 row justify-content-center align-items-center">
                    <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <i class="fa fa-solid fa-cart-arrow-down" style="font-size: 40px ;"></i><br>
                            <h3><strong>CAMISETA VANS</strong></h3>
                            <p>Camiseta de algodón perfecta para realizar cualquier <br> tipo de deporte o usar en tu vida cotidiana.</p>
                            <br>
                            <label for="nombre">Nombre Producto</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" readonly>
                            <label for="sexo">Sexo</label>
                            <input type="text" class="form-control" name="sexo" id="sexo" value="<?php echo $sexo; ?>" readonly>
                            <label for="precio">Precio(€)</label>
                            <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $precio; ?> €" readonly>
                            <label for="existencias">Existencias</label>
                            <input type="text" class="form-control" name="existencias" id="existencias" value="<?php echo $existencias; ?>" readonly><br>
                            <label for="talla">Tallas Disponibles</label>
                            <select name="talla">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                            </select><br><br>
                            <label for="color">Color</label>
                            <select name="color">
                                <option value="Blanco">Blanco</option>
                            </select><br><br>
                            <input type="submit" id="añadirCarrito" name="añadirCarrito" class="btn btn-success" value="Añadir Al Carrito"> <br><br>
                        </div>
                    </form>
                </div>
                <!--FIN FORMULARIO-->
            </div>
        </div>

        <!--PARTE COMENTARIOS-->
        <div class="m-0 row justify-content-center align-items-center" style="font-size: 18px">
            <form id="#" autocomplete="off" class="col-auto p-5 text-center" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <i class="fa fa-fw fa-info" style="font-size: 40px ;"></i><br>
                    <h3><strong>MÁS INFORMACIÓN</strong></h3>
                    <p>Aquí puedes ver más datos sobre tu producto</p>
                    <br>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#myModal">Ver todos los datos del producto</a> <br><br>
                    <div>
                        <strong>Devoluciones y Envíos <input type="button" class="btn btn-light" onclick="mostrarDevoluciones()" value="↓"></strong>

                        <p id="devoluciones" style="display:none;">- Entrega estándar gratuita con tu cuenta MR. <br>
                            - Puedes devolver tu pedido por cualquier motivo en un plazo de 30 días sin ningún coste <br>
                            - Tiempo estimado de entrega , 2 - 4 días laborables
                        </p>
                    </div> <br>

                    <div>
                        <strong>Evaluaciones <input type="button" class="btn btn-light" onclick="mostrarEvaluaciones()" value="↓"></strong>

                        <div id="evaluaciones" style="display:none">
                            <label for="comentario">¿Quieres dejar tu evaluación?</label> <img src="img/estrellas.jpg" alt="1" style="max-width:120px"><br>
                            <textarea name="comentario" id="comentario" cols="30" rows="" required></textarea> <br>

                            <?php for ($i = 0; $i < count($evaluaciones); $i++) {
                                echo "<p>- El usuario: <strong>" . $evaluaciones[$i]['usuario'] . "</strong> dice: " . $evaluaciones[$i]['comentario'] .  "</p>";
                            }
                            ?>
                            <input type="submit" id="guardarComentario" name="guardarComentario" class="btn btn-success" value="Guardar Comentario">
                        </div>

                    </div> <br>
                </div>
            </form>
        </div>

    </div>


    <!-- MODAL INFORMACIÓN -->

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #0d6efd; color: white;">
                    <h4 class="modal-title">Información</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="container">
                    <!--FORMULARIO-->
                    <div class="m-0 row justify-content-center align-items-center">
                        <div class="form-group">
                            <p><br>
                            <strong>CARACTERÍSTICAS <br></strong>
                                - Material exterior: 100% algodón <br>
                                - Material/composición: Jersey <br>
                                - Cuidados: Programa delicado <br>
                                - Deporte: Fitness <br>
                                - Cuello/escote: Cuello redondo <br>
                                - Estampado: Estampado <br><br>
                               <strong>VENTAJAS: </strong> <br>
                                · Materiales sintéticos, pegamentos y colores sin cantidades detectables de contenido animal. <br>
                                · Revestimientos cosidos en la parte superior para ofrecer durabilidad, sujeción y un estilo clásico.
                            </p>
                        </div>
                    </div>
                    <!--FIN FORMULARIO-->
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
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
                            <i class="fas fa-gem me-3 text-secondary"></i>Company name
                        </h6>
                        <p>
                            Here you can use rows and columns to organize your footer content. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Products
                        </h6>
                        <p>
                            <a href="#!" class="text-reset">Angular</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">React</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Vue</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Laravel</a>
                        </p>
                    </div>
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3 text-secondary"></i> New York, NY 10012, US</p>
                        <p>
                            <i class="fas fa-envelope me-3 text-secondary"></i>
                            info@example.com
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

    <script type="text/javascript" src="js/funciones.js"></script>

</body>

</html>