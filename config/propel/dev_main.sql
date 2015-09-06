
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- client
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `client_id` VARCHAR(64) NOT NULL,
    `client_secret` VARCHAR(128) NOT NULL,
    `grant_types` VARCHAR(128),
    `redirect_uri` VARCHAR(2000),
    `scope` VARCHAR(2000),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `client_u_0c2750` (`client_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- token
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `client_id` VARCHAR(64) NOT NULL,
    `token` VARCHAR(128) NOT NULL,
    `scope` VARCHAR(2000),
    `expires` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `token_fi_763caa` (`client_id`),
    CONSTRAINT `token_fk_763caa`
        FOREIGN KEY (`client_id`)
        REFERENCES `client` (`client_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `code`;

CREATE TABLE `code`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(64) NOT NULL,
    `client_id` VARCHAR(64) NOT NULL,
    `redirect_uri` VARCHAR(2000),
    `scope` VARCHAR(2000),
    `expires` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `code_fi_763caa` (`client_id`),
    CONSTRAINT `code_fk_763caa`
        FOREIGN KEY (`client_id`)
        REFERENCES `client` (`client_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- article
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(256) NOT NULL,
    `content` TEXT NOT NULL,
    `description` TEXT,
    `updated_at` DATETIME,
    `created_at` DATETIME NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
