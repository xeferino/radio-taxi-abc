ALTER TABLE `choferes`
ADD COLUMN `password`  varchar(255) NULL AFTER `porcentaje`;


DROP TABLE `clientes`;

CREATE TABLE `clientes` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`rut`  varchar(255) NOT NULL ,
`nombres`  varchar(255) NOT NULL ,
`codigo_validacion`  varchar(255) NOT NULL ,
PRIMARY KEY (`id`)
);
