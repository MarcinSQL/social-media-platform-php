<?php
include("config.php");
session_start();
$create_post = mysqli_query($db_connect, "UPDATE `posts` SET `Likes` = `Likes` + 1, `Date` = `Date` WHERE `Id` = " . $_GET['id']);
header("location: ../views/" . $_GET['location'] . ".php");
