<?php
require "data.php";
require "helpers.php";
require "functions.php";
require "init.php";
$errors = [];
$categories = getDataAll($con, 'SELECT * FROM categories', []);
$good = getDataOne($con, 'SELECT l.*, c.name  as cat, (SELECT MAX(bet_price)
FROM bets WHERE lot_id=l.id) as price FROM lots  AS l
LEFT JOIN categories AS c ON l.category_id=c.id
WHERE l.id = ?', [$_GET['id']]);

$betHistory = getDataAll($con, 'SELECT * FROM bets as b
 LEFT JOIN users as u ON b.user_id = u.id WHERE b.lot_id = ?', [$_GET['id']]);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST['cost'] = (int)$_POST['cost'];
    $good['start_price'] = (int)$good['start_price'];
    $good['step'] = (int)$good['step'];
    if (trim($_POST['cost']) == "" || !is_int($_POST['cost']) || empty($_POST['cost'])) {
        $errors['cost'] = "Введите число";
    }

    if ($_POST['cost'] < $good['start_price'] + $good['step']) {
        $errors['cost'] = "Цена слишком низкая";
    }

    if(!$errors) {
        $cost = (int)$_POST['cost'];
        $good['start_price'] = $_POST['cost'];
        setData($con, "UPDATE lots SET start_price='$cost' WHERE id=?", [$_GET['id']]);
       // var_dump($good['start_price'], $good['step']);
    }
}

if(!empty($good)) {
    $content = include_template("lot.php", ["good" => $good, "categories" => $categories, "betHistory" => $betHistory, "errors" => $errors]);
} else {
    $content = include_template('404.php', ["categories" => $categories]);
}

$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Просмотр лота", "content" => $content, "footer" => $footer]);
