<?php
class Singleton
{
    private $con;
    private static $instancia;

    private function __construct()
    {
        $this->con = new PDO("mysql:host=localhost;dbname=tienda", "root", "");
    }

    public static function singleton()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error("La clonacion de este objeto no esta permitida", E_USER_ERROR);
    }

    public function cerrarSesion()
    {
        $this->con = null;
    }

    public function registroUsuario($nombre, $apellidos, $email, $usuario, $clave, $fecha, $fecha_alta)
    {
        $consulta = $this->con->prepare("INSERT INTO registro (nombre,apellidos,email,usuario,clave,fecha,fecha_alta) values (?,?,?,?,?,?,?)");
        $consulta->bindparam(1, $nombre);
        $consulta->bindparam(2, $apellidos);
        $consulta->bindparam(3, $email);
        $consulta->bindparam(4, $usuario);
        $consulta->bindparam(5, $clave);
        $consulta->bindparam(6, $fecha);
        $consulta->bindparam(7, $fecha_alta);
        $consulta->execute();
    }

    public function anadirProducto($nombre, $sexo, $precio, $existencias, $imagen)
    {
        $consulta = $this->con->prepare("INSERT INTO producto (nombre,sexo,precio,existencias,imagen) values (?,?,?,?,?)");
        $consulta->bindparam(1, $nombre);
        $consulta->bindparam(2, $sexo);
        $consulta->bindparam(3, $precio);
        $consulta->bindparam(4, $existencias);
        $consulta->bindparam(5, $imagen);
        $consulta->execute();
    }

    public function comprobarRegistro($usuario, $clave)
    {
        $consulta = $this->con->prepare("SELECT * FROM registro WHERE usuario = ? AND clave = ?");
        $consulta->bindparam(1, $usuario);
        $consulta->bindparam(2, $clave);
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function comprobarCorreo($email)
    {
        $consulta = $this->con->prepare("SELECT * FROM registro WHERE email = ?");
        $consulta->bindparam(1, $email);
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function comprobarUsuario($usuario)
    {
        $consulta = $this->con->prepare("SELECT * FROM registro WHERE usuario = ?");
        $consulta->bindparam(1, $usuario);
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }


    public function datosUsuario($usuario)
    {
        $consulta = $this->con->prepare("SELECT id_usuario,nombre,apellidos,email,usuario,clave,fecha,fecha_alta FROM registro WHERE usuario = ?");
        $consulta->bindparam(1, $usuario);
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function tablaUsuarios()
    {
        $consulta = $this->con->prepare("SELECT id_usuario,nombre,apellidos,email,usuario,fecha,fecha_alta FROM registro");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function tablaProductos()
    {
        $consulta = $this->con->prepare("SELECT * FROM producto");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function tablaOpiniones()
    {
        $consulta = $this->con->prepare("SELECT * FROM evaluaciones");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function modificar_registro($nombre, $apellidos, $clave, $id_usu)
    {
        $consulta = $this->con->prepare("UPDATE registro SET nombre = ?, apellidos = ?, clave = ? WHERE id_usuario = ?");
        $consulta->bindparam(1, $nombre);
        $consulta->bindparam(2, $apellidos);
        $consulta->bindparam(3, $clave);
        $consulta->bindparam(4, $id_usu);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function modificarRegistroAdmin($nombre, $apellidos, $email, $usuario, $id_usu)
    {
        $consulta = $this->con->prepare("UPDATE registro SET nombre = ?, apellidos = ?, email = ? , usuario = ? WHERE id_usuario = ?");
        $consulta->bindparam(1, $nombre);
        $consulta->bindparam(2, $apellidos);
        $consulta->bindparam(3, $email);
        $consulta->bindparam(4, $usuario);
        $consulta->bindparam(5, $id_usu);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarCuenta($id_usu)
    {
        $consulta = $this->con->prepare("DELETE FROM registro where id_usuario = ?");
        $consulta->bindparam(1, $id_usu);
        $consulta->execute();
    }

    public function eliminarUsuarioEvaluaciones($id_usu)
    {
        $consulta = $this->con->prepare("DELETE FROM evaluaciones where id_usuario = ?");
        $consulta->bindparam(1, $id_usu);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarProductoEvaluaciones($id_usu)
    {
        $consulta = $this->con->prepare("DELETE FROM evaluaciones where id_producto = ?");
        $consulta->bindparam(1, $id_usu);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function incrementarTablaRegistro()
    {
        $consulta = $this->con->prepare("ALTER TABLE registro AUTO_INCREMENT = 1");
        $consulta->execute();
    }

    public function eliminarCarrito($id)
    {
        $consulta = $this->con->prepare("DELETE FROM carrito where id_carrito = ?");
        $consulta->bindparam(1, $id);
        $consulta->execute();
    }

    public function registroAnteriores($usuario)
    {
        $consulta = $this->con->prepare("SELECT * FROM registro WHERE usuario = ?");
        $consulta->bindParam(1, $usuario);
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Actualizar fecha inicio sesion
    public function actualizarFecha($fecha, $usuario)
    {
        $consulta = $this->con->prepare("UPDATE registro SET fecha = ? WHERE usuario = ?");
        $consulta->bindParam(1, $fecha);
        $consulta->bindParam(2, $usuario);
        if (!$consulta->execute()) {
            return "fallo en la consulta";
        } else {
            return "exito";
        }
    }


    public function seleccionarProducto($id)
    {
        $consulta = $this->con->prepare("SELECT id_producto,nombre,sexo,precio,existencias,imagen FROM producto WHERE id_producto = ?");
        $consulta->bindParam(1, $id);
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function añadirCarrito($id, $nombre, $sexo, $precio, $existencias, $talla, $color)
    {
        $consulta = $this->con->prepare("INSERT INTO carrito (id_producto,nombre,sexo,precio,existencias,talla,color) values (?,?,?,?,?,?,?)");
        $consulta->bindparam(1, $id);
        $consulta->bindparam(2, $nombre);
        $consulta->bindparam(3, $sexo);
        $consulta->bindparam(4, $precio);
        $consulta->bindparam(5, $existencias);
        $consulta->bindparam(6, $talla);
        $consulta->bindparam(7, $color);
        $consulta->execute();
    }

    public function seleccionarCarrito()
    {
        $consulta = $this->con->prepare("SELECT * FROM carrito");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function sumarCarrito()
    {
        $consulta = $this->con->prepare("SELECT SUM(precio) FROM carrito");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function eliminarCarritoEntero()
    {
        $consulta = $this->con->prepare("DELETE FROM carrito");
        $consulta->execute();
    }

    public function eliminarOpinion($id)
    {
        $consulta = $this->con->prepare("DELETE FROM evaluaciones WHERE id = ?");
        $consulta->bindparam(1, $id);
        $consulta->execute();
    }

    public function eliminarProducto($id)
    {
        $consulta = $this->con->prepare("DELETE FROM producto WHERE id_producto = ?");
        $consulta->bindparam(1, $id);
        $consulta->execute();
    }

    public function incrementarTablaCarrito()
    {
        $consulta = $this->con->prepare("ALTER TABLE carrito AUTO_INCREMENT = 1");
        $consulta->execute();
    }

    public function incrementarTablaProducto()
    {
        $consulta = $this->con->prepare("ALTER TABLE producto AUTO_INCREMENT = 1");
        $consulta->execute();
    }

    public function incrementarTablaEvaluaciones()
    {
        $consulta = $this->con->prepare("ALTER TABLE evaluaciones AUTO_INCREMENT = 1");
        $consulta->execute();
    }

    public function editarProducto($nombre, $sexo, $precio, $existencias, $id_pro)
    {
        $consulta = $this->con->prepare("UPDATE producto SET  nombre = ?, sexo = ?, precio = ? , existencias = ? WHERE id_producto = ?");
        $consulta->bindparam(1, $nombre);
        $consulta->bindparam(2, $sexo);
        $consulta->bindparam(3, $precio);
        $consulta->bindparam(4, $existencias);
        $consulta->bindparam(5, $id_pro);
        if ($consulta->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function contarProductos()
    {
        $consulta = $this->con->prepare("SELECT COUNT(*) FROM carrito");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarNombreCarrito()
    {
        $consulta = $this->con->prepare("SELECT nombre FROM carrito");
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }


    public function seleccionarCamisetaHombre()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE sexo = 'hombre'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarPantalonHombre()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE nombre LIKE '%Pantalones%' AND sexo = 'hombre'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarZapatillaHombre()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE nombre LIKE '%Zapatillas%' AND sexo = 'hombre'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarCamisetaMujer()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE sexo = 'mujer'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarPantalonMujer()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE nombre LIKE '%Pantalones%' AND sexo = 'Mujer'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }


    public function seleccionarZapatillaMujer()
    {
        $consulta = $this->con->prepare("SELECT id_producto, imagen, nombre FROM producto WHERE nombre LIKE '%Zapatillas%' AND sexo = 'Mujer' OR nombre LIKE '%Tacones%' AND sexo = 'Mujer' OR nombre LIKE '%Botines%' AND sexo = 'Mujer' OR nombre LIKE '%Mocasines%' AND sexo = 'Mujer'");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function seleccionarIdUsuario($usu)
    {
        $consulta = $this->con->prepare("SELECT id_usuario FROM registro WHERE usuario = ?");
        $consulta->bindparam(1, $usu);
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetch(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }

    public function insertarEvaluaciones($id_usu, $id_pro, $usuario, $coment)
    {
        $consulta = $this->con->prepare("INSERT INTO evaluaciones (id_usuario,id_producto,usuario,comentario) values (?,?,?,?)");
        $consulta->bindparam(1, $id_usu);
        $consulta->bindparam(2, $id_pro);
        $consulta->bindparam(3, $usuario);
        $consulta->bindparam(4, $coment);
        $consulta->execute();
    }

    public function visualizarEvaluaciones($id)
    {
        $consulta = $this->con->prepare("SELECT usuario, comentario FROM evaluaciones WHERE id_producto = ?");
        $consulta->bindparam(1, $id);
        $consulta->execute();
        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
}
