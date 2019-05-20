<?php
require 'init.php';
require 'helpers.php';
require 'functions.php';

$categories = getDataAll($con, 'SELECT * FROM categories', []);
$goods = getDataAll($con, 'SELECT l.*, l.id AS lot_id, c.name cat, (SELECT COUNT(category_id) FROM lots WHERE category_id=?) AS count FROM lots l 
LEFT JOIN categories c ON l.category_id = c.id WHERE category_id=?', [$_GET['category_id'], $_GET['category_id']]);

$content = include_template("all-lots.php", ["categories" => $categories, "goods" => $goods]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Все лоты", "content" => $content, "footer" => $footer, "user_name" => $user_name,  "is_auth" => $is_auth,]);