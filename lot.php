<?php
require "data.php";
require "helpers.php";
require "functions.php";
require "init.php";

$categories = getDataAll($con, 'SELECT * FROM categories', []);
$good = getDataOne($con, 'SELECT lots.*, categories.name as cat, bets.bet_price as price from lots
LEFT JOIN bets ON lots.id = bets.user_id
LEFT JOIN categories ON categories.id = lots.category_id
WHERE lots.id = ?', [$_GET['id']]);

$betHistory = getDataAll($con, 'SELECT * FROM bets as b
 LEFT JOIN users as u ON b.user_id = u.id WHERE b.lot_id = ?', [$_GET['id']]);

if(!empty($good)) {
    $content = include_template("lot.php", ["good" => $good, "categories" => $categories, "betHistory" => $betHistory]);
} else {
    $content = include_template('404.php', ["categories" => $categories]);
}


$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Главная", "content" => $content, "footer" => $footer]);






