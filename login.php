<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';
require 'data.php';

$errors = [];
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
}

if(trim($_POST['password']) == "") {
    $errors['password'] = 'Заролните это поле';
}

$user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$user_email = $_POST['email'];
$passwords = getDataAll($con, 'SELECT password FROM users', []);
$emails = getDataAll($con, 'SELECT email FROM users', []);

session_start();
if(!$errors) {
    foreach ($passwords as $password) {
        if($user_password == $password['password']) {
            $current_password = true;
        } else {
            $errors['password'] = 'Неправильный пароль';
            $password = false;
        }
    }

    foreach ($emails as $email) {
        if($user_email == $email['email']) {
            $current_email = true;
        } else {
            $errors['email'] = 'Неправильный email';
            $current_email = false;
        }
    }
    if($current_email == true && $current_password == true) {
        $is_auth = 1;
        $user_name = 'sadafdafa';
    }
 }
$categories = getDataAll($con, 'SELECT * FROM categories', []);

$content = include_template('login.php', ["categories" => $categories, "errors" => $errors]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Вход", "content" => $content, "footer" => $footer]);