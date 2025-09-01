<?php
require '../../assets/php/db.php';
require '../../assets/php/fontawesome.php';

$current_room = $_GET['kamer'];

if (is_numeric($current_room)) {
    $result = mysqli_query($conn, "SELECT * FROM kamers WHERE id = $current_room");

    while ($row = mysqli_fetch_assoc($result)) {
        $kamers[] = $row;
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Data
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $beschrijving = $_POST['beschrijving'];
    $beschikbaar = $_POST['beschikbaar'];

    // Database
    $command = "UPDATE kamers SET naam = '$naam', prijs = '$prijs', beschrijving = '$beschrijving', beschikbaar = '$beschikbaar' WHERE id = $current_room";
    mysqli_query($conn, $command);


    // Send back
    header("Location: /admin");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/editKamer.css">
    <title>Bewerk kamer <?= htmlspecialchars($current_room) ?> - Hotel De Zonne Vallei</title>
    <script src="/assets/js/kamer_slideshow.js"></script>
</head>

<body>
    <?php include('../../assets/html/navbar.html'); ?>
    <?php if (!empty($kamers)): ?>
        <?php $kamer = $kamers[0]; ?>
        <div class="kamer-container">
            <h1 class="kamer-naam">Kamer bewerken</h1>
            <form class="kamer-edit-form" method="post" enctype="multipart/form-data">
                <div class="kamer-content">
                    <div class="kamer-info">
                        <label for="kamer-naam-input" class="kamer-label">Naam kamer</label>
                        <input type="text" id="kamer-naam-input" name="naam" class="kamer-input" value="<?= htmlspecialchars($kamer['naam']) ?>">

                        <label for="kamer-prijs-input" class="kamer-label">Prijs per nacht (€)</label>
                        <input type="number" step="0.01" id="kamer-prijs-input" name="prijs" class="kamer-input" value="<?= htmlspecialchars($kamer['prijs']) ?>">

                        <label for="kamer-beschrijving-input" class="kamer-label">Beschrijving</label>
                        <textarea id="kamer-beschrijving-input" name="beschrijving" class="kamer-textarea" rows="6"><?= htmlspecialchars($kamer['beschrijving']) ?></textarea>

                        <label for="kamer-beschikbaar-input" class="kamer-label">Beschikbaarheid</label>
                        <select id="kamer-beschikbaar-input" name="beschikbaar" class="kamer-input">
                            <option value="1" <?= $kamer['beschikbaar'] ? 'selected' : '' ?>>Beschikbaar</option>
                            <option value="0" <?= !$kamer['beschikbaar'] ? 'selected' : '' ?>>Niet beschikbaar</option>
                        </select>
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
                                <button type="button" class="slideshow-arrow left" onclick="plusSlides(-1)">&#10094;</button>
                            <?php endif; ?>
                            <div class="slideshow-images">
                                <?php foreach ($afbeeldingen as $index => $link): ?>
                                    <img class="kamer-afbeelding slideshow-slide" src="<?= $link ?>" alt="Afbeelding van <?= $kamer['naam'] ?>" style="<?= $index === 0 ? '' : 'display:none;' ?>">
                                    <button type="button" class="kamer-afbeelding-verwijder fa-solid fa-trash"></button>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($afbeeldingen) > 1): ?>
                                <button type="button" class="slideshow-arrow right" onclick="plusSlides(1)">&#10095;</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="kamer-afbeelding">Geen afbeeldingen beschikbaar.</p>
                        <?php endif; ?>
                    </div>
                        <label for="kamer-afbeelding-upload" class="kamer-label">Voeg nieuwe afbeelding toe</label>
                        <input type="file" id="kamer-afbeelding-upload" name="afbeeldingen[]" class="kamer-input" multiple accept="image/*">
                    </div>
                </div>
                <div class="kamer-form-buttons">
                    <button type="submit" class="kamer-save-knop">Opslaan</button>
                    <a href="/admin" class="kamer-cancel-knop">Annuleren</a>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="kamer-error">
            <p>Kamer niet gevonden.</p>
            <a href="/admin">Bekijk alle kamers</a>
        </div>
    <?php endif; ?>
    <?php include('../../assets/html/footer.html'); ?>
</body>

</html>