<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';
$search = $_GET['search'] ? htmlspecialchars($_GET['search']) : null;
$categories = getDataAll($con, 'SELECT * FROM categories', []);
if ($search) {
    $sql = "SELECT l.name, l.id, l.user_id, l.description, l.ended_at, l.step, l.start_price, l.url, c.name AS cat, b.bet_price, b.lot_id, b.created_at FROM lots l
  LEFT JOIN bets b ON l.id = b.lot_id
  LEFT JOIN categories c ON c.id = l.category_id
  WHERE MATCH (l.name, description) AGAINST(? IN BOOLEAN MODE)";
    $goods = getDataAll($con, $sql, [$search . '*']);
}
$content = include_template("search.php", ["goods" => $goods, "search" => $search, "categories" => $categories]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Главная", "content" => $content, "user_name" => $user_name,  "is_auth" => $is_auth, "footer" => $footer]);
  