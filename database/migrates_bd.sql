ALTER TABLE `choferes`
ADD COLUMN `password`  varchar(255) NULL AFTER `porcentaje`;

CREATE TABLE `clientes` (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`rut`  varchar(255) NOT NULL ,
`nombres`  varchar(255) NOT NULL ,
`codigo_validacion`  varchar(255) NOT NULL ,
PRIMARY KEY (`id`)
);


ALTER TABLE `resumen_zulus_sin_1_5`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `resumen_zulus`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `resumen_movil`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `pago_movil_1,5`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `convenios`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `clinica integral`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;

ALTER TABLE `convenios mutual`
ADD COLUMN `rut_cliente`  varchar(50) NULL,
ADD COLUMN `nombres_apellidos`  varchar(255) NULL,
ADD COLUMN `codigo_validacion`  varchar(255) NULL;
