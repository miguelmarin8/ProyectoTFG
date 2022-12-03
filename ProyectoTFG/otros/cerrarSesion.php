<?php
session_start();
session_destroy();
include_once("../conexion/conexion.php");
$conexion = Singleton::singleton();
$conexion -> eliminarCarritoEntero();
$conexion->cerrarSesion();
header("location:../inicio.php");
?>