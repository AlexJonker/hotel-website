<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/styling/global.css">
  <link rel="stylesheet" href="/styling/contact.css">
  <link rel="icon" href="/assets/logos/favicon.ico">
  <title>contact - Hotel De Zonne Vallei</title>

  <?php include("../assets/php/fontawesome.php"); ?>



<body>
  <?php
  function sender($naam, $email, $vraag)
  {
   // $to = 'support@gmail.com'; Support email
    $subject = "Onderwerp: Vraag van: Klant:{$naam}, {$email}";
    $message = $vraag;
    $headers = 'From: obb220038@gmail.com' . "\r\n" .
      'Reply-To: obb220038@gmail.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();


    if (mail($to, $subject, $message, $headers)) {
      echo '<i class="fa-solid fa-check my-icon"></i>Vraag verstuurd!';
    } else {
      echo '<i class="fa-solid fa-xmark evil"></i>Vraag verzending mislukt!';
    }
  }
  ?>
  <?php include('../assets/html/navbar.html'); ?>
  <div class="cont">

    <h1>Neem contact met ons.</h1>
    <div class="box">


      <form action='' method='post'>




        <h2 id='h'>Stel je vraag?</h2><br>
        <input type="text" id="naam" name="naam" size="40" required placeholder="Naam" class="style">



        <input type="email" id="email" name="email" required placeholder="Email">

        <textarea id="vraag" name="vraag" rows="4" cols="40" minlength="30" maxlength="800" required
          placeholder="Stel je vraag"></textarea>
        <input type="submit" id="verzenden" name="verzenden" required>

        <?php

        if (isset($_POST["verzenden"])) {
          sender($_POST["naam"], $_POST["email"], $_POST["vraag"]);

        } ?>
      </form>
      <section>

          <h2> <i class="fa-solid fa-info my-icon"></i>Contact info:</h2> <br>

        <ul>
          <li><i class="fas fa-location-dot my-icon"></i> Straatnaam 85 1234 AB Alkmaar NL</a></li> <br>
          <!-- <li><i class="fas fa-phone my-icon"></i></a> ____________________</li> <br> -->
          <!-- <li> <i class="fas fa-envelope my-icon"></i> ____________________</a></li> -->

        </ul>
      </section>

    </div>
  </div>

  <?php include('../assets/html/footer.html'); ?>

</body>

</html>