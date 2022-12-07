-- Active: 1644947064554@@127.0.0.1@3306@tienda

USE tienda;

CREATE TABLE
    `registro`(
        `id_usuario` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `nombre` VARCHAR(10) NOT NULL,
        `apellidos` VARCHAR(20) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `usuario` VARCHAR(10) NOT NULL,
        `clave` VARCHAR(20) NOT NULL,
        `fecha` DATETIME,
        `fecha_alta` DATETIME
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    `tallas`(
        `id_talla` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `talla` VARCHAR(10) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO tallas (`talla`)
VALUES ('XXS'), ('XS'), ('S'), ('M'), ('L'), ('XL'), ('XXL');

CREATE TABLE
    `producto`(
        `id_producto` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `nombre` VARCHAR(100) NOT NULL,
        `sexo` VARCHAR(10) NOT NULL,
        `precio` INT NOT NULL,
        `existencias` INT NOT NULL,
        `imagen` VARCHAR(50) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

/*INSERT INTO producto (`id_producto`,`nombre`, `color`, `precio`,`id_talla`,`existencias`) VALUES (1,'Camiseta', 'Blanco', 7,5,800);*/

CREATE TABLE
    `carrito`(
        `id_carrito` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_producto` INT NOT NULL,
        `nombre` VARCHAR(100) NOT NULL,
        `sexo` VARCHAR(10) NOT NULL,
        `precio` INT NOT NULL,
        `existencias` INT NOT NULL,
        `talla` VARCHAR(10) NOT NULL,
        `color` VARCHAR(10) NOT NULL,
        FOREIGN KEY (`id_producto`) REFERENCES producto (`id_producto`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    `evaluaciones`(
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_usuario` INT NOT NULL,
        `id_producto` INT NOT NULL,
        `usuario` VARCHAR(10) NOT NULL,
        `comentario` VARCHAR(100) NOT NULL,
        FOREIGN KEY (`id_usuario`) REFERENCES registro (`id_usuario`),
        FOREIGN KEY (`id_producto`) REFERENCES producto (`id_producto`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    `compra`(
        `id_compra` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_usuario` INT NOT NULL,
        `id_producto` INT NOT NULL,
        `precio` INT NOT NULL,
        `nombre` VARCHAR(10) NOT NULL,
        `apellidos` VARCHAR(50) NOT NULL,
        `usuario` VARCHAR(50) NOT NULL,
        `contraseña` VARCHAR(50) NOT NULL,
        `tipo_pago` VARCHAR(10) NOT NULL,
        `numero_tarjeta` INT,
        `fecha_caducidad_tarjeta` DATETIME,
        `email_paypal` VARCHAR(50),
        `contraseña_paypal` VARCHAR(50),
        `fecha_compra` DATETIME,
        FOREIGN KEY (`id_usuario`) REFERENCES registro (`id_usuario`),
        FOREIGN KEY (`id_producto`) REFERENCES producto (`id_producto`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;