<?php

/**
 * Функция считает сколько времени осталось до $date
 *
 * @param string $date дата
 * @return string возвращает отформатированное число
 */
function getTime($date)
{
    $now = strtotime('now');
    $date = strtotime($date);
    $diff = $date - $now;
    $days = (int)($diff / 86400);
    $hours = (int)(($diff % 86400) / 3600);
    $minutes = (int)(($diff % 3600) / 60);
    if ($diff <= 0) {
        $result = 'Торги окончены';
    } elseif ($days <= 1) {
        $result = sprintf('%02dч:%02dм', $hours, $minutes);
    } else {
        $result = sprintf('%02dдн:%02dч', $days, $hours);
    }
    return $result;
}

/**
 * Функция определяет, осталось ли до наступления $date меньше часа
 *
 * @param string $date дата
 * @return bool
 */
function isDead($date)
{
    $result = false;
    if (getTime($date) <= 1) {
        $result = true;
    }
    return $result;
}

/**
 * Функция определяет, больше ли $date текущего времени
 *
 * @param string $date дата
 * @return bool
 */
function isOver($date)
{
    $result = false;
    if (getTime($date) > 0) {
        $result = true;
    }
    return $result;
}

/**
 * Функция форматирует число по определенному алгоритму
 *
 * @param integer $number число, которое нужно отформатировать
 * @return string
 */
function asCurrancy($number)
{
    $fixedNumber = number_format($number, "0", "", " ");
    return ($fixedNumber . "<b class=\"rub\">р</b>");
}

/**
 * @param string $link соединение с вашей базой данных
 * @param string $sql ваш sql запрос, который необходимо выполнить
 * @param array $param данные для вставки на место плейсхолдеров
 * @return array возвращает многомерный массив из вашей базы данных
 */
function getDataAll($link, $sql, $param)
{
    $stmt = db_get_prepare_stmt($link, $sql, $param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * @param string $link соединение с вашей базой данных
 * @param string $sql ваш sql запрос, на обновление данных в таблице
 * @param array $param данные для вставки на место плейсхолдеров
 */
function setData($link, $sql, $param)
{
    $stmt = db_get_prepare_stmt($link, $sql, $param);
    mysqli_stmt_execute($stmt);
    echo mysqli_error($link);
}

/**
 * @param string $link соединение с вашей базой данных
 * @param string $sql ваш sql запрос, который необходимо выполнить
 * @param array $param данные для вставки на место плейсхолдеров
 * @return array возвращает одномерный массив из вашей базы данных
 */
function getDataOne($link, $sql, $param)
{
    $stmt = db_get_prepare_stmt($link, $sql, $param);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

/**
 * Функция определяет, чья ставка последняя - текущего юзера или нет
 *
 * @param string $link соединение с вашей базой данных
 * @param integer $user_id id текущего юзера
 * @param integer $lot_id id выбранного лота
 * @return bool
 */
function isMyBet($link, $user_id, $lot_id)
{
    $result = false;
    $data = getDataOne($link, "SELECT MAX(bet_price) AS user_price FROM bets WHERE user_id = ? AND lot_id = ?",
        [$user_id, $lot_id]);
    $max_price = getDataOne($link, "SELECT MAX(bet_price) AS max_price FROM bets WHERE lot_id = ?", [$lot_id]);
    if ($data['user_price'] === $max_price['max_price']) {
        $result = true;
    }
    if ($max_price['max_price'] === null) {
        $result = false;
    }
    return $result;
}

/**
 * Функция определяет, сколько времени прошло с момента ставки юзера
 *
 * @param string $date дата
 * @return string
 */
function getBetTime($date)
{
    $now = strtotime('now');
    $date = strtotime($date);
    $diff = (int)$now - (int)$date;
    $days = (int)($diff / 86400);
    $hours = (int)(($diff % 86400) / 3600);
    $minutes = (int)(($diff % 3600) / 60);
    $result = '';
    if ($diff < 60) {
        $result = 'Только что';
    } elseif ($hours < 1 && $days < 1 && $minutes > 0) {
        $result = "$minutes " . get_noun_plural_form($minutes, 'минуту', 'минуты', 'минут') . " назад";
    } elseif ($hours <= 24 && $days < 1) {
        $result = "$hours " . get_noun_plural_form($hours, 'час', 'часа', 'часов') . " назад";
    } elseif ($days >= 1) {
        $result = "$days " . get_noun_plural_form($days, 'день', 'дня', 'дней') . " назад";
    }
    return $result;
}
