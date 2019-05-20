<?php
require 'init.php';
require 'helpers.php';
require 'functions.php';

if($is_auth) {
    $user_id = $_SESSION['user']['id'];
    $bets = getDataAll($con, "SELECT c.name as cat, l.*, b.* FROM lots l LEFT JOIN categories c ON l.category_id = c.id LEFT JOIN bets b ON b.lot_id = l.id WHERE b.user_id='$user_id'", []);

    $categories = getDataAll($con, 'SELECT * FROM categories', []);
    $content = include_template("my-bets.php", ["goods" => $goods, "categories" => $categories, "bets" => $bets]);
    $footer = include_template("footer.php", ["categories" => $categories]);
    print include_template("layout.php", ["title" => "Мои ставки", "content" => $content, "user_name" => $user_name, "is_auth" => $is_auth, "footer" => $footer]);
}