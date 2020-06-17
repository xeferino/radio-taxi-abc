ALTER TABLE `choferes`
ADD COLUMN `password`  varchar(255) NULL AFTER `porcentaje`,
ADD COLUMN `remember_token`  varchar(100) NULL AFTER `password`;
