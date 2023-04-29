CREATE TABLE IF NOT EXISTS `#__bwtransifex`
(
    `id`               INT(11)             NOT NULL AUTO_INCREMENT,
    `name`             VARCHAR(255)        NOT NULL DEFAULT '',
    `description`      VARCHAR(2000)       NOT NULL DEFAULT '',
    `access`           INT(11)             NOT NULL DEFAULT '1',
    `state`            TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    `created`          DATETIME                     DEFAULT NULL,
    `created_by`       INT(11)             NOT NULL,
    `modified`         DATETIME                     DEFAULT NULL,
    `modified_by`      INT(11)             NOT NULL,
    `checked_out`      TINYINT(3) UNSIGNED NOT NULL DEFAULT 0,
    `checked_out_time` DATETIME                     DEFAULT NULL,
    `publish_up`       DATETIME                     DEFAULT NULL,
    `publish_down`     DATETIME                     DEFAULT NULL,

    PRIMARY KEY (`id`)

) DEFAULT CHARSET = utf8;
