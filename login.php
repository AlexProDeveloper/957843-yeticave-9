<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';

$errors = [];
$required_fields = ['email', 'password'];
$user = null;
$email = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($required_fields as $field) {
        if (isset($_POST[$field]) && trim($_POST[$field]) === "") {
            $errors[$field] = 'Поле должно быть заполнено';
        }
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['email']) && $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Некорректный email";
        }
    }

    if (!$errors && isset($_POST['password'])) {
        $password = $_POST['password'];
        $result = getDataOne($con, 'SELECT * FROM users WHERE email = ?', [$email]);
        $user = $result;
    }

    if (!$user && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Пользователь с таким email не найден";
    }

    if (!$errors && $user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: /');
        } else {
            $errors['password'] = "Неверный пароль";
        }
    }
}

$categories = getDataAll($con, 'SELECT * FROM categories', []);

$content = include_template('login.php', [
    "categories" => $categories,
    "errors" => $errors,
    "required_fields" => $required_fields
]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", [
    "title" => "Вход",
    "content" => $content,
    "footer" => $footer
]);