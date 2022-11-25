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

    public function anadirProducto($id,$nombre,$color,$precio,$talla,$existencias,$imagen)
    {
        $consulta = $this->con->prepare("INSERT INTO producto (id_producto,nombre,color,precio,id_talla,existencias,imagen) values (?,?,?,?,?,?,?)");
        $consulta->bindparam(1, $id);
        $consulta->bindparam(2, $nombre);
        $consulta->bindparam(3, $color);
        $consulta->bindparam(4, $precio);
        $consulta->bindparam(5, $talla);
        $consulta->bindparam(6, $existencias);
        $consulta->bindparam(7, $imagen);
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
        $consulta = $this->con->prepare("SELECT codigo_producto,id_producto,nombre,marca,color,precio,sexo,id_talla FROM producto");
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

    public function eliminarCuenta($id_usu)
    {
        $consulta = $this->con->prepare("DELETE FROM registro where id_usuario = ?");
        $consulta->bindparam(1, $id_usu);
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

    public function seleccionarProductos()
    {
        $consulta = $this->con->prepare("SELECT id_producto FROM producto");
        $consulta->execute();

        if ($consulta->execute()) {
            $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datos;
        } else {
            return false;
        }
    }
}
