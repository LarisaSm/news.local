<?php

/*

CREATE TABLE `news` (`id` INT NOT NULL AUTO_INCREMENT,`small_text` TEXT NULL,`full_text` TEXT NULL, PRIMARY KEY (`id`));
CREATE TABLE `comments` (`id` INT NOT NULL AUTO_INCREMENT,`news_id` INT NULL,`comment` TEXT NULL,`name` TEXT NULL, PRIMARY KEY (`id`));
CREATE TABLE  `users` (`id` INT NOT NULL,`login` TEXT NULL,`password` TEXT NULL, PRIMARY KEY (`id`));

 */

$db = array(
    "host" => "127.0.0.1",
    "user" => "root",
    "pass" => "root",
    "name" => "newsdb"
);

?>
