<?php
require '../assets/php/db.php';
include '../assets/php/fontawesome.php';

$current_room = $_GET['num'];

if (is_numeric($current_room)) {
    $result = mysqli_query($conn, "SELECT * FROM kamers WHERE id = $current_room");

    while ($row = mysqli_fetch_assoc($result)) {
        $kamers[] = $row;
    }
}


$result = mysqli_query($conn, "SELECT * FROM reserveringen WHERE kamer_id = $current_room");
$reserveringen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}

$vandaag = date("Y-m-d");
$open = [];

foreach ($reserveringen as $res) {
    if ($res['eind_datum'] >= $vandaag) {
        $open[] = $res;
    }
}

$beschikbaar = count($open);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/kamer.css">
    <title>Kamer <?= htmlspecialchars($current_room) ?> - Hotel De Zonne Vallei</title>
    <script src="/assets/js/kamer_slideshow.js"></script>
</head>

<body>
    <?php include('../assets/html/navbar.html'); ?>
    <?php if (!empty($kamers)): ?>
        <?php $kamer = $kamers[0]; ?>
        <div class="kamer-container">
            <a href="/kamers" class="scroll-down-btn">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <h1 class="kamer-naam"><?= $kamer['naam'] ?></h1>
            <div class="kamer-content">
                <div class="kamer-info">
                    <p class="kamer-prijs">Prijs per nacht: €<?= number_format($kamer['prijs'], 2, ',', '.') ?></p>
                    <p class="kamer-beschrijving"><?= nl2br($kamer['beschrijving']) ?></p>
                </div>
                <?php
                $kamer_id = $kamer['id'];
                $afbeeldingen = [];
                $afbeeldingen_result = mysqli_query($conn, "SELECT link FROM afbeeldingen WHERE kamer_id = $kamer_id");
                while ($afbeelding_row = mysqli_fetch_assoc($afbeeldingen_result)) {
                    $afbeeldingen[] = $afbeelding_row['link'];
                }
                ?>
                <div class="rechts">
                    <div class="kamer-afbeeldingen-slideshow">
                        <?php if (!empty($afbeeldingen)): ?>
                            <?php if (count($afbeeldingen) > 1): ?>
                                <button class="slideshow-arrow left" onclick="plusSlides(-1)">&#10094;</button>
                            <?php endif; ?>
                            <div class="slideshow-images">
                                <?php foreach ($afbeeldingen as $index => $link): ?>
                                    <img class="kamer-afbeelding slide-container" src="<?= $link ?>"
                                        alt="Afbeelding van <?= $kamer['naam'] ?>"
                                        style="<?= $index === 0 ? '' : 'display:none;' ?>">
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($afbeeldingen) > 1): ?>
                                <button class="slideshow-arrow right" onclick="plusSlides(1)">&#10095;</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="kamer-afbeelding">Geen afbeeldingen beschikbaar.</p>
                        <?php endif; ?>
                    </div>
                    <p class="kamer-beschikbaarheid">Nog <?= $kamer['beschikbaar'] - $beschikbaar ?> kamers beschikbaar</p>
                    <a class="kamer-reserveer-knop" href="/kamer/reserveer?num=<?= $kamer['id'] ?>">Reserveer deze kamer</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <article class="kamer-error">
            <h2>Ongeldige kamer. Ga terug naar <a href="/kamers">overzicht</a> kamers.</h2>

        </article>
    <?php endif; ?>
    <?php include('../assets/html/footer.html'); ?>
</body>

</html>