 <?php

function getTime() {
    $midnight = date_create("tomorrow midnight");
    $today = date_create("now");
    $diff = date_diff($today, $midnight);
    $currentDiff = date_interval_format($diff, "%h<span>:</span>%I");
    return $currentDiff;
}

function asCurrancy($number) {
    $fixedNumber = number_format($number, "0", "", " ");
    return ($fixedNumber . " <b class=\"rub\">р</b>");
}

// function getDataAll(obj $link, string $sql, array $param) {
//     mysqli_set_charset($link, 'utf8');
//     $result = mysqli_query($link, $sql);
//     $param = mysqli_fetch_all($result, MYSQLI_ASSOC);
// }