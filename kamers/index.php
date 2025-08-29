<?php
require '../assets/php/db.php';

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

echo json_encode([
    'afbeeldingen' => $afbeeldingen[0]["kamer_id"]
]);

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
                        <img src="<?= htmlspecialchars($kamerAfbeelding) ?>" alt="<?= htmlspecialchars($kamer['naam']) ?>">
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
    </main>
    <?php include('../assets/html/footer.html'); ?>
</body>

</html>