-- Active: 1668888614883@@127.0.0.1@3306@tienda

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

INSERT INTO tallas (`talla`) VALUES ('XXS'),('XS'),('S'),('M'),('L'),('XL'),('XXL');

CREATE TABLE
    `producto`(
        `id_registro` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `id_producto` INT NOT NULL,
        `nombre` VARCHAR(100) NOT NULL,
        `color` VARCHAR(10) NOT NULL,
        `precio` INT NOT NULL,
        `id_talla` INT NOT NULL,
        `existencias` INT NOT NULL,
        `imagen` LONGBLOB NOT NULL,
        FOREIGN KEY (`id_talla`) REFERENCES tallas (`id_talla`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

/*INSERT INTO producto (`id_producto`,`nombre`, `color`, `precio`,`id_talla`,`existencias`) VALUES (1,'Camiseta', 'Blanco', 7,5,800);*/