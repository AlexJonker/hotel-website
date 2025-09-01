<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styling/global.css">
  <link rel="stylesheet" href="/styling/contact.css">
  <title>contact - Hotel De Zonne Vallei</title>
 
      <?php include("../assets/php/fontawesome.php"); ?>
  


<body>
  <?php
function sender($naam, $email, $vraag){
$to = 'guledk900@gmail.com'; //Support email
$subject = "Onderwerp: Vraag van: Klant:{$naam}, {$email}";
$message = $vraag;
$headers = 'From: obb220038@gmail.com' . "\r\n" .
           'Reply-To: obb220038@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();
           

if (mail($to, $subject, $message, $headers)) {
    echo 'Message verstuurd!';
} else {
    echo 'Message verzending mislukt!';
}
}
?>
  <?php include('../assets/html/navbar.html'); ?>
  <div class="cont">
    
    <h1>Neem contact met ons</h1>
    <div class="box">

      <div class="box2">
       <form action='' method='post'>
       
        
        
      
  <h2 id='h'>Stel je vraag?</h2><br>
      <input type="text" id="naam" name="naam"  required placeholder="Naam" class="style">
    
         
      
      <input type="email" id="email" name="email"  required placeholder="Email" >
  
      <textarea id="vraag" name="vraag" rows="4" cols="40" required  placeholder="stel je vraag" ></textarea>
        <input type="submit" id="verzenden" name="verzenden" required >
      </div>
      <div class="box3"> <!--section-->

            <ul>
                 <h2> <i class="fa-solid fa-info"></i>contact info:</h2> <br> <!--wissel de namen met icoontjes-->

                <li><a href=""><i class="fas fa-location-dot my-icon"></i> straatnaam 85  1234 AB Alkmaar NL</a></li> <br>
                <li><a href=""><i class="fas fa-phone"></i> 31 6 4241344</a></li> <br>
                <li><a href=""><i class="fas fa-envelope"></i> support@zonnenvalei</a></li>
                
            </ul>
        <!--section-->
      </div>
    </div>
  </div>
      <?php
if (isset($_POST["verzenden"])){
   sender($_POST["naam"], $_POST["email"], $_POST["vraag"]);

}?>
  <?php include('../assets/html/footer.html'); ?>

</body>

</html>
