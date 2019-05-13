<?php
$con = mysqli_connect('localhost', 'root', '', 'YetiCave');
mysqli_set_charset($con, 'utf8');

session_start();

$is_auth = false;
if($_SESSION['user']) {
    $is_auth = true;
    $user_name = $_SESSION['user']['name'];
}
