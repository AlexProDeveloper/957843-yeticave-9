<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';

$required_fields = ['email', 'password', 'name', 'contacts'];
$errors = [];

foreach ($required_fields as $field) {
    if(trim($_POST[$field]) == "") {
        $errors[$field] = 'Поле должно быть заполнено';
    }
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некорректный email';
}

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$users = getDataAll($con, 'SELECT name FROM users', []);
foreach ($users as $user) {
    if($_POST['name'] == $user['name']) {
        $errors['name'] = 'Пользователь с таким именем уже существует';
    }
}

$emails = getDataAll($con, 'SELECT email FROM users', []);
foreach ($emails as $email) {
    if($_POST['email'] == $email['email']) {
        $errors['email'] = 'Пользователь с таким email уже существует';
    }
}

if(!$errors) {
    $sql = 'INSERT INTO users (email, password, name, contacts) VALUES (?, ?, ?, ?)';

    setData($con, $sql, [
        $_POST['email'],
        $password,
        $_POST['name'],
        $_POST['contacts']
    ]);
    header('Location: index.php');

}

$categories = getDataAll($con, 'SELECT * FROM categories', []);

$content = include_template('sign-up.php', ["categories" => $categories, "required_fields" => $required_fields, "errors" => $errors]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Регистрация", "content" => $content, "footer" => $footer]);
