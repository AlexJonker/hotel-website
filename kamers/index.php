<?php
require '../assets/db.php';

$result = mysqli_query($conn, "SELECT * FROM kamers");
$kamers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $kamers[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/kamers.css">
    <title>Kamers - Hotel De Zonne Vallei</title>
</head>

<body>
    <?php include('../assets/html/navbar.html'); ?>
    <div class="hero-container">
        <div class="hero-content-wrapper">
            <h1>Beschikbare Kamers</h1>
            <p>Bekijk en boek jouw ideale kamer.</p>
        </div>
    </div>
    <main class="rooms-list">
        <section class="rooms-container">
            <?php
            foreach ($kamers as $kamer) {
                ?>
                <a href="#" class="room-card">
                    <img src="<?= htmlspecialchars($kamer['afbeelding']) ?>" alt="<?= htmlspecialchars($kamer['naam']) ?>">
                    <div class="room-info">
                        <h2><?= htmlspecialchars($kamer['naam']) ?></h2>
                        <!-- <p><?= htmlspecialchars($kamer['beschrijving']) ?></p> -->
                        <span class="room-price">€<?= htmlspecialchars($kamer['prijs']) ?> / nacht</span>
                    </div>
                </a>
                <?php
            }
            ?>
        </section>
    </main>
    <?php include('../assets/html/footer.html'); ?>
</body>

</html>