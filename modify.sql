
ALTER TABLE `tbl_jobs`  ADD `buscado` INT NOT NULL  AFTER `precio`;

CREATE TABLE IF NOT EXISTS `tbl_search` (
  `departamento` varchar(80) NOT NULL,
  `busqueda` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`departamento`,`busqueda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;
