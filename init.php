<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$con = mysqli_connect('localhost', 'root', '', 'YetiCave');
mysqli_set_charset($con, 'utf8');
$user_name = null;
$user_id = null;
$is_auth = false;
session_start();

if (isset($_SESSION['user'])) {
    $is_auth = true;
    $user_id = $_SESSION['user']['id'];
    $user_name = $_SESSION['user']['name'];
}


