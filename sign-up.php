<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';

$required_fields = ['email', 'password', 'name', 'contacts'];
$errors = [];
$password = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($required_fields as $field) {
        if (isset($_POST[$field]) && trim($_POST[$field]) === "") {
            $errors[$field] = 'Поле должно быть заполнено';
        }
    }
    if (isset($_POST['email'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Некорректный email';
        }
    }
    if (isset($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    $emails = getDataAll($con, 'SELECT email FROM users', []);
    foreach ($emails as $email) {
        if (isset($_POST['email']) && isset($email['email'])) {
            if ($_POST['email'] === $email['email']) {
                $errors['email'] = 'Пользователь с таким email уже существует';
            }
        }
    }

    if (!$errors) {
        $sql = 'INSERT INTO users (email, password, name, contacts) VALUES (?, ?, ?, ?)';
        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['contacts'])) {
            setData($con, $sql, [
                $_POST['email'],
                $password,
                $_POST['name'],
                $_POST['contacts']
            ]);
            header('Location: /');
        }
    }
}

$categories = getDataAll($con, 'SELECT * FROM categories', []);
if (!isset($_SESSION['user'])) {
    $content = include_template('sign-up.php', [
        "categories" => $categories,
        "required_fields" => $required_fields,
        "errors" => $errors
    ]);
    $footer = include_template("footer.php", ["categories" => $categories]);
    print include_template("layout.php", [
        "title" => "Регистрация",
        "content" => $content,
        "footer" => $footer
    ]);
} else {
    header("Location: /");
}
