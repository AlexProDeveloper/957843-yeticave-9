<?php

require 'vendor/autoload.php';

$sql = "SELECT l.*, u.id AS win_user_id, u.name, u.email, (SELECT MAX(bet_price) FROM bets WHERE bets.lot_id = l.id) AS price
FROM lots l LEFT JOIN users u ON u.id = l.user_id WHERE l.winner_id IS NULL AND l.ended_at <= CURRENT_DATE()
AND l.id IN (SELECT DISTINCT b.lot_id FROM bets b)";
$ended_lots = getDataAll($con, $sql, []);

if($ended_lots) {
//    $transport = new Swift_SmtpTransport("phpdemo.ru", 25);
//    $transport->setUsername("keks@phpdemo.ru");
//    $transport->setPassword("htmlacademy");
    $transport = (new Swift_SmtpTransport("phpdemo.ru", 25))
        ->setUsername("keks@phpdemo.ru")
        ->setPassword("htmlacademy")
    ;
    $mailer = new Swift_Mailer($transport);

    foreach ($ended_lots as $lot) {
        $lot_id = $lot['id'];
        $message = new Swift_Message();
        $message->setSubject("Ваша ставка победила!!!");
        $message->setFrom(['keks@phpdemo.ru' => 'yeticave']);
        $message->setTo('zakhar_petrov1998@mail.ru'/* $lot['email'] */); // Это один из моих email. Я его указал,
        $message_content = include_template('email.php', ["lot" => $lot]);  // потому что ни один email из бд не является реальным
        $message->setBody($message_content, 'text/html');
        // Письма пока не отправляются, браузер выдает такую ошибку:
        // Fatal error: in W:\domains\localhost\vendor\swiftmailer\swiftmailer\lib\classes\Swift\Transport\StreamBuffer.php on line 269
        //$result = $mailer->send($message);
    }
}