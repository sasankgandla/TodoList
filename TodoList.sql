CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

CREATE TABLE `notes` (
    `sno` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `description` VARCHAR(400) NOT NULL,
    `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `username` VARCHAR(50),
    PRIMARY KEY (`sno`),
    FOREIGN KEY (`username`) REFERENCES users(`username`)
) ENGINE = InnoDB;