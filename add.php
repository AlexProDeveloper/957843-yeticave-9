<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';

$categories = getDataAll($con, 'SELECT * FROM categories', []);
$footer = include_template("footer.php", ["categories" => $categories]);

if (!$is_auth) {
    http_response_code(403);
    $content = include_template('not_auth.php', ["categories" => $categories]);
    print include_template("layout.php", ["title" => "Добавление лота", "content" => $content, "footer" => $footer]);
    exit;
}
$post_required_fields = ['name', 'category_id', 'description', 'start_price', 'step', 'ended_at'];
$errors = [];
$user_id = $_SESSION['user']['id'];
$category_id = null;
$tmp_name = '';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_FILES['url'])) {
        $user_file = $_FILES['url']['name'];
    }

    foreach ($post_required_fields as $field) {
        if (isset($_POST[$field])) {
            if (trim($_POST[$field]) === "") {
                $errors[$field] = 'Заполните это поле';
            }
        }
    }

    if (isset($_FILES['url'])) {
        $errors['url'] = 'Загрузите изображение';
    }

    if (isset($_POST['category_id'])) {
        $category_id = $_POST['category_id'];
        if (!is_numeric($_POST['category_id']) || $_POST['category_id'] > 6 || $_POST['category_id'] < 1) {
            $errors['category_id'] = "Выберите категорию";
        } else {
            $category_id = $_POST['category_id'];
        }
    }

    if (isset($_POST['start_price'])) {
        $_POST['start_price'] = (int)$_POST['start_price'];
    }

    if (isset($_POST['step'])) {
        $_POST['step'] = (int)$_POST['step'];
    }

    if (isset($_POST['start_price'])) {
        if (!is_int($_POST['start_price']) || empty($_POST['start_price'])) {
            $errors['start_price'] = 'Введите число!';
        }
    }

    if (isset($_POST['step'])) {
        if (!is_int($_POST['step']) || empty($_POST['step'])) {
            $errors['step'] = 'Введите число!';
        }
    }

    if (isset($_POST['ended_at'])) {
        if (!is_date_valid($_POST['ended_at'])) {
            $errors['ended_at'] = "Некорректная дата!";
        }
    }

    if (isset($_FILES['url']) && !empty($user_file)) {
        $tmp_name = $_FILES['url']['tmp_name'];
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($file_info, $tmp_name);
        if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
            $errors['url'] = 'Некорректный формат изображения!';
        } else {
            unset($errors['url']);
        }
    }

    if (!$errors && isset($_POST['category_id'])) {
        $sql = 'INSERT INTO lots (url, category_id, name, start_price, user_id, step, description, ended_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        move_uploaded_file($tmp_name, __DIR__ . '/uploads/' . $user_file);
        setData($con, $sql, [
            $user_file,
            $_POST['category_id'],
            $_POST['name'],
            $_POST['start_price'],
            $user_id,
            $_POST['step'],
            $_POST['description'],
            $_POST['ended_at']
        ]);
        header("Location: /");
    }
}
$content = include_template('add.php', [
    "categories" => $categories,
    "errors" => $errors
]);
print include_template("layout.php", [
    "title" => "Добавление лота",
    "content" => $content,
    "is_auth" => $is_auth,
    "user_name" => $user_name,
    "footer" => $footer,
    "category_id" => $category_id
]);
