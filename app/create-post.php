<?php
include("config.php");
session_start();
$post = $_POST["post-text"];
$createPost = mysqli_query($db_connect, "INSERT INTO `posts` (`User_Id`, `Post`) VALUES ('" . $_SESSION['id'] . "', '$post')");
header("location: ../views/userProfile.php");
