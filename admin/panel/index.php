

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/home.css">
    <link rel="stylesheet" href="/styling/panel.css">
    <?php include("../../assets/php/fontawesome.php"); ?>
</head>

<body>
    <form>
       <div class = "layout">
    <aside>
        <nav>
            <ul>
                <li><a href=""><i class="fas fa-plus"></i> Toevoegen</a></li>
                <li><a href=""><i class="fas fa-edit"></i> Editen</a></li>
                <li><a href=""><i class="fas fa-key"></i> Wachtwoord wijzigen</a></li>
            </ul>
            
        </nav>
        <form action="" method="post">
        <label>Naam:</label><br>
        
      <input type="text" id="persoon" name="persoon" required ><br>
      <br>
       <label>Prijs:</label><br>
      <input type="text" id="persoon" name="persoon" required >
   <br>
  <br>
         <button type ="submit" id="verzenden" name="verzenden" >sturen</button>
        
</form>

        <a href="/" class="home-button" title="Home">
            <i class="fas fa-home"></i>
        </a>
    
    </aside>
 <article><h1>database overzicht</h1></article>
</form>
    </div>
</body>

</html>