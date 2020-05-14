ALTER TABLE `tbl_tokens` ADD `send_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `token`;
ALTER TABLE `tbl_users` ADD `verified` BOOLEAN NOT NULL DEFAULT FALSE AFTER `member_no`;
ALTER TABLE `tbl_users` CHANGE `last_name` `last_name` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `tbl_users` ADD UNIQUE( `email`);