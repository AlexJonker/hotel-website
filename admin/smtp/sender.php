<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

function sender($adress, $email){
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

        $mail->Subject = 'Test Email';
        $mail->Body    = $email;

        $mail->send();
        return 'Email verstuurd!';
    } catch (Exception $e) {
        return 'Email verzending mislukt!';
    }
}

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
        <label>Naar</label><br>
        
      <input type="text" id="persoon" name="persoon" required ><br>
      <textarea id="email" name="email" rows="4" cols="50" required >Dit is een test Email</textarea>
  <br>
         <button type ="submit" id="verzenden" name="verzenden" >verzenden</button>
        
</form>
<?php
    if (isset($_POST["verzenden"])){
        echo sender($_POST["persoon"],  $_POST["email"]);
    }
?>
</body>
</html>
<?php
}
?>