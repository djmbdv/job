DROP TABLE IF EXISTS `tbl_votes`;
CREATE TABLE IF NOT EXISTS `tbl_votes` (
  `member_no` varchar(15) NOT NULL,
  `job_id` varchar(20) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`member_no`,`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;
