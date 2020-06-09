DROP TABLE IF EXISTS `tbl_votes`;
CREATE TABLE IF NOT EXISTS `tbl_votes` (
  `member_no` varchar(15) NOT NULL,
  `job_id` varchar(20) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`member_no`,`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;
CREATE TABLE `remotepc_bwirejobs_db`.`tbl_image_service` ( `id` INT NOT NULL ,  `path` VARCHAR(100) NOT NULL ,  `service` VARCHAR(15) NOT NULL ) ENGINE = InnoDB;
ALTER TABLE `tbl_jobs` CHANGE `closing_date` `closing_date` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;