<?php

 function getTime($date) {
    $midnight = date_create("tomorrow midnight");
    $date = date_create($date);
    $diff = date_diff($date, $midnight);
    $currentDiff = date_interval_format($diff, "%h<span>:</span>%I");
    return $currentDiff;
}

function isDead($date) {
    $result = false;
    if(getTime($date) <= 1) {
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
    return ($fixedNumber . "<b class=\"rub\">р</b>");
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

 function isMyBet($con, $user_id, $lot_id) {
    $data = getDataOne($con, "SELECT COUNT(id) FROM bets WHERE user_id=? AND lot_id=?" ,[$user_id, $lot_id]);
    if($data['COUNT(id)'] > 0) {
        return true;
    }
        return false;
 }