<?php
require 'helpers.php';
require 'functions.php';
require 'init.php';

$categories = getDataAll($con, 'SELECT * FROM categories', []);
$footer = include_template("footer.php", ["categories" => $categories]);

if($is_auth) {
    $sql = "";

    $bets = getDataAll($con, $sql, [$_SESSION['user']['id']]);

    $content = include_template('my-bets.php', ["categories" => $categories, "bets" => $bets]);
    print include_template("layout.php", ["title" => "Мои ставки", "content" => $content, "footer" => $footer]);
} else {
    $content = include_template('not_auth.php', ["categories" => $categories]);
    print include_template("layout.php", ["title" => "Мои ставки", "content" => $content, "user_name" => $user_name, "is_auth" => $is_auth, "content" => $content, "footer" => $footer]);
}