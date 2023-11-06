<?php
$server = 'localhost';
$login = 'root';
$password = '';
$database = 'social_media_platform';

$db_connect = mysqli_connect($server, $login, $password, $database);

if (!$db_connect) {
    exit("Błąd połączenia z serwerem: " . mysqli_connect_error());
}
