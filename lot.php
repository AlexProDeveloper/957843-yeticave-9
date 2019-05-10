<?php
require "data.php";
require "helpers.php";
require "functions.php";
require "init.php";

$categories = getDataAll($con, 'SELECT * FROM categories', []);
$good = getDataOne($con, 'SELECT l.*, c.name  as cat, (SELECT MAX(bet_price)
FROM bets WHERE lot_id=l.id) as price FROM lots  AS l
LEFT JOIN categories AS c ON l.category_id=c.id
WHERE l.id = ?', [$_GET['id']]);

$betHistory = getDataAll($con, 'SELECT * FROM bets as b
 LEFT JOIN users as u ON b.user_id = u.id WHERE b.lot_id = ?', [$_GET['id']]);

if(!empty($good)) {
    $content = include_template("lot.php", ["good" => $good, "categories" => $categories, "betHistory" => $betHistory]);
  //  $auth = include_template("auth.php", ["good" => $good]);
} else {
    $content = include_template('404.php', ["categories" => $categories]);
}

$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Просмотр лота", "content" => $content,  /*"auth" => $auth, */ "footer" => $footer]);
