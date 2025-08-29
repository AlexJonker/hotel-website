<?php
function sender($adress, $email){
$to = $adress;
$subject = 'Test Email';
$message = $email;
$headers = 'From: obb220038@gmail.com' . "\r\n" .
           'Reply-To: obb220038@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email verstuured!';
} else {
    echo 'email verzending mislukt!';
}
}
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
   sender($_POST["persoon"],  $_POST["email"]);

}?>

</body>
</html>