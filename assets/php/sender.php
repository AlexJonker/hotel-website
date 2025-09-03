<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function sender($adress, $email, $subject){
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'thijskeesje@gmail.com';
        $mail->Password = 'kngi igyh qghn judd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('thijskeesje@gmail.com', 'Thijs Keesje');
        $mail->addAddress($adress);

        $mail->Subject = $subject;
        $mail->Body    = $email;

        $mail->send();
        return 'Email verstuurd!';
    } catch (Exception $e) {
        return 'Email verzending mislukt!';
    }
}

?>