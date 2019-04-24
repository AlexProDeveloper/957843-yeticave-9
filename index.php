<?php
require "data.php";
require "helpers.php";
require "functions.php";
require 'schema.sql';
require 'queries.sql';
$content = include_template("index.php", ["goods" => $goods, "categories" => $categories]);
$footer = include_template("footer.php", ["categories" => $categories]);
print include_template("layout.php", ["title" => "Главная", "content" => $content, "footer" => $footer]);
