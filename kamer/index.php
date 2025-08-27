<?php
require '../assets/php/db.php';

$current_room = $_GET['num'] ?? "Hello!";

if (is_numeric($current_room)) {
    $result = mysqli_query($conn, "SELECT * FROM kamers WHERE id = $current_room");
    
    while ($row = mysqli_fetch_assoc($result)) {
    $kamers[] = $row;
}

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/kamer.css">
    <title>Kamer <?= htmlspecialchars($current_room) ?> - Hotel De Zonne Vallei</title>
</head>

<body>
    <?php include('../assets/html/navbar.html'); ?>
    <?php if (!empty($kamers)): ?>
        <?php $kamer = $kamers[0]; ?>
        <div class="kamer-container">
            <h1 class="kamer-naam"><?= htmlspecialchars($kamer['naam']) ?></h1>
            <div class="kamer-content">
                <div class="kamer-info">
                    <p class="kamer-beschrijving"><?= nl2br(htmlspecialchars($kamer['beschrijving'])) ?></p>
                    <p class="kamer-prijs">Prijs per nacht: <strong>€<?= htmlspecialchars(number_format($kamer['prijs'], 2, ',', '.')) ?></strong></p>
                </div>
                <img class="kamer-afbeelding" src="<?= htmlspecialchars($kamer['afbeelding']) ?>" alt="Afbeelding van <?= htmlspecialchars($kamer['naam']) ?>">
            </div>
        </div>
    <?php else: ?>
        <div class="kamer-error">
            <p>Kamer niet gevonden.</p>
            <a href="/kamers">Bekijk alle kamers</a>
        </div>
    <?php endif; ?>
    <?php include('../assets/html/footer.html'); ?>
</body>

</html>