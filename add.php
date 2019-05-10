<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';
require 'data.php';

$required_fields = ['name', 'category_id', 'description', 'url', 'start_price', 'step', 'ended_at'];
$errors = [];

foreach ($required_fields as $field ) {
    if (trim($_POST[$field]) == "") {
        $errors[$field] = 'Заполните это поле!';
    }
    $_POST['start_price'] = (int)$_POST['start_price'];
    $_POST['step'] = (int)$_POST['step'];

    if(!is_int($_POST['start_price']) || empty($_POST['start_price'])) {
        $errors['start_price'] = 'Введите число!';
    }

    if(!is_int($_POST['step']) || empty($_POST['step'])) {
        $errors['step'] = 'Введите число!';
    }

    if(!is_date_valid($_POST['ended_at'])) {
        $errors['ended_at'] = "Некорректная дата!";
    }

    if ($_POST['url']) {
            $tmp_name = $_FILES['url']['tmp_name'];
            $user_file = $_FILES['url']['name'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($file_info, $tmp_name);
                if ($file_type != "image/jpeg" && $file_type != "image/png") {
                    $errors['url'] = 'Некорректный формат изображения!';
                } else {
                    move_uploaded_file($tmp_name, 'uploads' . $user_file);
                }
        }
    }

if(!$errors ) {
    $sql = 'INSERT INTO lots (url, category_id, name, start_price, user_id, step, description, ended_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    setData($con, $sql, [
        $_POST['url'],
        $_POST['category_id'],
        $_POST['name'],
        $_POST['start_price'],
        $_POST['user_id'],
        $_POST['step'],
        $_POST['description'],
        $_POST['ended_at']
    ]);
}

$categories = getDataAll($con, 'SELECT * FROM categories', []);


if ($is_auth == 1) {
    $content = include_template('add2.php', ["categories" => $categories, "required_fields" => $required_fields, "errors" => $errors]);

} else {
    $content = include_template('not_auth.php', ["categories" => $categories]);
}

$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Добавление лота", "content" => $content, "footer" => $footer]);







