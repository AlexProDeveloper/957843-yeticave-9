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
$user_id = $_SESSION['user']['id'];
$user = getDataOne($con, "SELECT * FROM users u LEFT JOIN lots l ON l.user_id = u.id WHERE l.id=?", [$_GET['id']]);
$betHistory = getDataAll($con, 'SELECT * FROM bets as b
 LEFT JOIN lots l ON b.lot_id = l.id
 LEFT JOIN users as u ON b.user_id = u.id 
 WHERE b.lot_id = ?', [$_GET['id']]);
$bets = getDataAll($con, "SELECT bet_price FROM bets  WHERE lot_id=? AND user_id=? LIMIT 1", [$_GET['id'], $user_id]);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_POST['cost'] = (int)$_POST['cost'];
    $good['start_price'] = (int)$good['start_price'];
    $good['step'] = (int)$good['step'];
    $bet_price = getDataOne($con, "SELECT start_price FROM lots WHERE lots.id=?", [$_GET['id']]);
    //var_dump($bet_price);
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

        $lot_id = getDataOne($con, "SELECT id FROM lots WHERE id=?", [$_GET['id']]);
        setData($con, " INSERT INTO bets(user_id, lot_id, bet_price) VALUES (?, ?, ?)", [
            $user_id,
            $lot_id['id'],
            $bet_price['start_price']
        ]);
    }
}

if(!empty($good)) {
    $content = include_template("lot.php", ["good" => $good, "user_id" => $user_id, "user" => $user, "bets" => $bets, "is_auth" => $is_auth, "categories" => $categories, "betHistory" => $betHistory, "errors" => $errors]);
} else {
    http_response_code(404);
    $content = include_template('404.php', ["categories" => $categories]);
}

$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Просмотр лота", "content" => $content, "user_name" => $user_name, "is_auth" => $is_auth, "footer" => $footer]);
