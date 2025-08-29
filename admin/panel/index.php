<?php

session_start();

if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
} else {
    header('Location: /admin');
    exit;
}

require '../../assets/php/fontawesome.php';
require '../../assets/php/db.php';


$result = mysqli_query($conn, "SELECT * FROM kamers");
$kamers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kamers[] = $row;
}
;

$result = mysqli_query($conn, "SELECT * FROM afbeeldingen");
$afbeeldingen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $afbeeldingen[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Hotel De Zonne Vallei</title>
    <link rel="icon" href="/assets/logos/favicon.ico">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/home.css">
    <link rel="stylesheet" href="/styling/panel.css">
</head>

<body>
    <aside>
        <nav>
            <a href="/"><i class="fas fa-home"></i> Home</a>
            <a href=""><i class="fas fa-key"></i> Wachtwoord wijzigen</a>

        </nav>
    </aside>
    <article>
        <section class="rooms-container">
            <?php
            foreach ($kamers as $kamer) {
                ?>
                <a href="/kamer?num=<?= $kamer['id'] ?>" class="room-card">
                    <?php
                    $kamerAfbeelding = null;
                    foreach ($afbeeldingen as $afbeelding) {
                        if ($afbeelding['kamer_id'] == $kamer['id']) {
                            $kamerAfbeelding = $afbeelding['link'];
                            break;
                        }
                    }
                    ?>
                    <?php if ($kamerAfbeelding): ?>
                        <div class="room-image" style="position:relative;">
                            <img src="<?= $kamerAfbeelding ?>" alt="<?= $kamer['naam'] ?>">
                            <p class="fas fa-pencil-alt" aria-hidden="true"></p>
                        </div>
                    <?php endif; ?>
                    <div class="room-info">
                        <h2><?= $kamer['naam'] ?></h2>
                        <span class="room-price">€<?= $kamer['prijs'] ?> / nacht</span>
                    </div>
                </a>
                <?php
            }
            ?>
        </section>
    </article>

</body>

</html>