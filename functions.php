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