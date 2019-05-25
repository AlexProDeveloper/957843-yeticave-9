<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';
$search = $_GET['search'] ? htmlspecialchars($_GET['search']) : null;
$categories = getDataAll($con, 'SELECT * FROM categories', []);
if ($search) {
    $cur_page = 1;
    if (isset($_GET['page'])) {
        $cur_page = $_GET['page'];
    }
    $page_items = 6;
    $sql = "SELECT l.name, l.id, l.user_id, l.description, l.ended_at, l.step, l.start_price, l.url, c.name AS cat FROM lots l
LEFT JOIN categories c ON c.id = l.category_id
WHERE MATCH (l.name, description) AGAINST(? IN BOOLEAN MODE)";
    $lots = getDataAll($con, $sql, [$search . '*']);
    $pages_count = ceil(count($lots) / $page_items);
    $offset = ($cur_page - 1) * $page_items;
    $pages = range(1, $pages_count);
    $sql2 = "SELECT l.name, l.id, l.user_id, l.description, l.ended_at, l.step, l.start_price, l.url, c.name AS cat FROM lots l
LEFT JOIN categories c ON c.id = l.category_id
WHERE MATCH (l.name, description) AGAINST(? IN BOOLEAN MODE) LIMIT $page_items OFFSET $offset";
    $goods = getDataAll($con, $sql2, [$search . '*']);
}
$content = include_template("search.php", [
    "pages_count" => $pages_count,
    "cur_page" => $cur_page,
    "pages" => $pages,
    "goods" => $goods,
    "search" => $search,
    "categories" => $categories
]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", [
    "title" => "Поиск",
    "content" => $content,
    "user_name" => $user_name,
    "is_auth" => $is_auth,
    "footer" => $footer
]);
