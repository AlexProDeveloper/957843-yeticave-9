<?php
require "data.php";
require "helpers.php";
require "functions.php";
require "init.php";


$categories = getDataAll($con, 'SELECT * FROM categories', []);
$goods = getDataAll($con, 'SELECT l.*, c.name as cat FROM lots as l LEFT JOIN categories AS c ON l.category_id = c.id', []);
$betHistory = getDataAll($con, 'SELECT * FROM bets as b
 LEFT JOIN users as u ON b.user_id = u.id WHERE b.lot_id = ?', [$_GET['id']]);

$content = include_template("index.php", ["goods" => $goods, "categories" => $categories, "betHistory" => $betHistory]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Главная", "content" => $content, "footer" => $footer]);

