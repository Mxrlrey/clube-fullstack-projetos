<?php

use PHPMailer\PHPMailer\PHPMailer;

function send(array $data) {
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->Port = 2525;
    $mail->SMTPAuth = true;

    $mail->Username = 'f3f9574efbd8f9';
    $mail->Password = '073976212b6167';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->setFrom($data['quem']);
    $mail->addAddress($data['para']);
    $mail->Subject = $data['assunto'];
    $mail->MsgHTML($data['mensagem']);
    return $mail->send();
}
