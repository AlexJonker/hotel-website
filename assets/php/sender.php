<?php
$env = false;

if (file_exists('../.env')) {
    $env = parse_ini_file('../.env');
} elseif (file_exists('../../.env')) {
    $env = parse_ini_file('../../.env');
}

if ($env === false) {
    die("No .env file found");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function sender($adress, $html, $subject)
{
    global $env;
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $env["mail_user"];
        $mail->Password = $env["mail_pass"];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($env["mail_user"], 'Thijs Keesje');
        $mail->addAddress($adress);

        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->isHTML(true);

        $mail->SMTPDebug = 0;
        $mail->Timeout = 10;
        $mail->SMTPKeepAlive = false;

        $mail->send();
        return 'Email verstuurd!';
    } catch (Exception $e) {
        error_log(message: 'Mailer Error: ' . $mail->ErrorInfo);
        return 'Email verzending mislukt: ' . $mail->ErrorInfo;
    }
}
