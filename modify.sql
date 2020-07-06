ALTER TABLE `tbl_image_service` ADD PRIMARY KEY( `id`);
ALTER TABLE `tbl_image_service` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tbl_jobs` CHANGE `closing_date` `closing_date` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
INSERT INTO `tbl_alerts` (`id`, `code`, `description`, `type`) VALUES (NULL, '0446', 'Su correo no ha sido verificado', 'warning'), (NULL, '570', 'Ha verificado su correo con exito!', 'success');
ALTER TABLE `tbl_jobs` ADD `producto` INT NOT NULL DEFAULT '0' AFTER `enc_id`;
ALTER TABLE `tbl_jobs` ADD `precio` DECIMAL(30,2) NULL AFTER `producto`;
ALTER TABLE `tbl_users` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `verified`;
