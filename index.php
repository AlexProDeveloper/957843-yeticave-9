<?php
require "data.php";
require "helpers.php";
require "functions.php";

$con = mysqli_connect('localhost', 'root', '', 'YetiCave');
mysqli_set_charset($con, 'utf8');
$sql_1 = 'SELECT name FROM categories';
$result_1 = mysqli_query($con, $sql_1);
$categories = mysqli_fetch_all($result_1, MYSQLI_ASSOC);
$sql_2 = 'SELECT category_id, url, name, start_price, ended_at FROM lots';
$result_2 = mysqli_query($con, $sql_2);
$goods = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$content = include_template("index.php", ["goods" => $goods, "categories" => $categories]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Главная", "content" => $content, "footer" => $footer]);

