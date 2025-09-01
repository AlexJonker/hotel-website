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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oud_wachtwoord_input = $_POST['oud_wachtwoord'];
    $nieuw_wachtwoord_input = $_POST['nieuw_wachtwoord'];

    $oud_wachtwoord = mysql_query("SELECT wachtwoord FROM admins WHERE id = {$_SESSION['admin_id']}");
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
        <a href="/"><i class="fas fa-home"></i> Home</a>
        <a href=""><i class="fas fa-key"></i> Wachtwoord wijzigen</a>
        <div class="form-popup">
            <form class="form-container" method="post" enctype="multipart/form-data">
                <label for="oud_wachtwoord">Oud wachtwoord</label>
                <input type="password" placeholder="Enter current Password" name="oud_wachtwoord" required>

                <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                <input type="password" placeholder="Enter new Password" name="nieuw_wachtwoord" required>

                <button type="submit">Wijzig</button>
            </form>
        </div>

    </aside>
    <article>
        <section class="rooms-container">
            <a href="/admin/edit?kamer=<?= count($kamers) + 1 ?>" class="room-card">
                <div class="room-image" style="position:relative;">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div class="room-info">
                    <h2>Nieuw</h2>
                </div>
            </a>
            <?php
            foreach ($kamers as $kamer) {
                ?>
                <a href="/admin/edit?kamer=<?= $kamer['id'] ?>" class="room-card">
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