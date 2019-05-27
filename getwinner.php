<?php

require_once 'vendor/autoload.php';

$sql = "SELECT l.*, (SELECT MAX(bet_price) FROM bets WHERE bets.lot_id = l.id) AS price, 
(SELECT user_id FROM bets WHERE bet_price = price LIMIT 1) AS win_user_id, 
(SELECT name FROM users WHERE id = win_user_id) AS winner_name, 
(SELECT email FROM users WHERE id = win_user_id) AS winner_email FROM lots l 
WHERE l.winner_id IS NULL AND l.ended_at <= CURRENT_DATE()
AND l.id IN (SELECT DISTINCT b.lot_id FROM bets b) LIMIT 1";

$ended_lots = getDataAll($con, $sql, []);
if ($ended_lots) {
    $transport = new Swift_SmtpTransport("smtp.mailtrap.io", 2525);
    $transport->setUsername("de5b78e046251f");
    $transport->setPassword("ed7c2b07c76daa");
    $message = new Swift_Message();
    $mailer = new Swift_Mailer($transport);
    foreach ($ended_lots as $lot) {
        $message->setSubject("Ваша ставка победила!!!");
        $message->setFrom('keks@phpdemo.ru', 'yeticave');
        $message->setTo($lot['winner_email']);
        $message_content = include_template('email.php', ["lot" => $lot]);
        $message->setBody($message_content, 'text/html');
        $result = $mailer->send($message);
        if ($result) {
            setData($con, "UPDATE lots SET winner_id=? WHERE id=?", [$lot['win_user_id'], $lot['id']]);
        }
    }
}
