<?php
$server = 'localhost';
$login = 'root';
$password = '';
$database = 'social_media_platform';

$db_connect = mysqli_connect($server, $login, $password);

if (!$db_connect) {
    exit("Błąd połączenia z serwerem: " . mysqli_connect_error());
} else {
    $db_create = mysqli_query($db_connect, "CREATE DATABASE IF NOT EXISTS $database");

    $db_connect = mysqli_connect($server, $login, $password, $database);

    $users_create_tab = mysqli_query($db_connect, "CREATE TABLE IF NOT EXISTS `users` (
        `User_Id` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `UserFirstName` VARCHAR(50) NOT NULL,
        `UserLastName` VARCHAR(80) NOT NULL,
        `UserGender` ENUM('M','F') NOT NULL DEFAULT 'M',
        `UserEmail` VARCHAR(255) NOT NULL,
        `UserPassword` VARCHAR(255) NOT NULL,
        `UserImg` VARCHAR(400) DEFAULT NULL,
        `UserStatus` TINYINT(1) DEFAULT NULL,
        PRIMARY KEY (`User_Id`),
        UNIQUE KEY `UserEmail` (`UserEmail`)
      )");

    $posts_create_tab = mysqli_query($db_connect, "CREATE TABLE IF NOT EXISTS `posts` (
        `Id` INT(50) UNSIGNED NOT NULL AUTO_INCREMENT,
        `Post_Id` INT(50) NOT NULL,
        `User_Id` INT(20) NOT NULL,
        `Post` TEXT NOT NULL,
        `UserImg` VARCHAR(400) NULL,
        `Likes` INT(11) NOT NULL DEFAULT 0,
        `Date` TIMESTAMP NOT NULL,
        PRIMARY KEY (`Id`),
        UNIQUE KEY (`Post_Id`)
    )");

    $follow_list_create_tab = mysqli_query($db_connect, "CREATE TABLE IF NOT EXISTS `follow_list`(
        `Id` INT(50) UNSIGNED NOT NULL AUTO_INCREMENT,
        `Follower_Id` INT(20) NOT NULL,
        `User_Id` INT(20) NOT NULL,
        PRIMARY KEY (`Id`)
    )");
}
