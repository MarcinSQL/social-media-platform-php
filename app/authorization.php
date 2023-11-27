<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: signIn.php');
    exit;
}
