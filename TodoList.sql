CREATE TABLE `notes`.`notes` (`sno` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(100) NOT NULL , `description` VARCHAR(400) NOT NULL , `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`sno`)) ENGINE = InnoDB;