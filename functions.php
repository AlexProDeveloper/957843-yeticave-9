<?php

<<<<<<< Updated upstream
 function getTime($date) {
    $midnight = date_create("tomorrow midnight");
    $date = date_create($date);
    $diff = date_diff($date, $midnight);
    $currentDiff = date_interval_format($diff, "%h<span>:</span>%I");
    return $currentDiff;
=======
function getTime($date) {
    $now = strtotime('now');
    $date = strtotime($date);
    $diff = $date - $now;
    $days = (int)($diff / 86400);
    $hours = (int)(($diff % 86400) / 3600);
    $minutes = (int)(($diff % 3600) / 60);
    if($diff <= 0) {
        $result = 'Торги окончены';
    } elseif ($days <= 1) {
        $result = sprintf('%02dч:%02dм', $hours, $minutes);
    } else  {
        $result = sprintf('%02dдн:%02dч',$days, $hours);
    }
    return $result;
>>>>>>> Stashed changes
}

function isDead($date) {
    $now = strtotime('now');
    $date = strtotime($date);
    $diff = $date - $now;
    $days = (int)($diff / 86400);
    $hours = (int)(($diff % 86400) / 3600);
    $minutes = (int)(($diff % 3600) / 60);
    $result = false;
    if($hours <= 1 && $days <= 1) {
        $result = true;
    }
    return $result;
}

function isOver($date) {
     $result = false;
     if(getTime($date) > 0) {
         $result = true;
     }
     return $result;
}

function asCurrancy($number) {
    $fixedNumber = number_format($number, "0", "", " ");
    return ($fixedNumber . " <b class=\"rub\">р</b>");
}

 function getDataAll($link, $sql, $param) {
     $stmt = db_get_prepare_stmt($link, $sql, $param);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     return mysqli_fetch_all($result, MYSQLI_ASSOC);
 }

 function setData($link, $sql, $param) {
     $stmt = db_get_prepare_stmt($link, $sql, $param);
     mysqli_stmt_execute($stmt);
     echo mysqli_error($link);

 }

 function getDataOne($link, $sql, $param) {
     $stmt = db_get_prepare_stmt($link, $sql, $param);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);
     return mysqli_fetch_assoc($result);
 }