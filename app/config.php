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
        `User_Id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `UserFirstName` varchar(50) NOT NULL,
        `UserLastName` varchar(80) NOT NULL,
        `UserGender` ENUM('M','F') NOT NULL DEFAULT 'M',
        `UserEmail` varchar(255) NOT NULL,
        `UserPassword` varchar(255) NOT NULL,
        `UserImg` varchar(400) DEFAULT NULL,
        `UserStatus` tinyint(1) DEFAULT NULL,
        PRIMARY KEY (`User_Id`),
        UNIQUE KEY `UserEmail` (`UserEmail`)
      )");
}
