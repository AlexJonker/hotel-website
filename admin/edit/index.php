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


    // Image upload
    if (isset($_FILES["afbeelding"]) && $_FILES["afbeelding"]["error"] === UPLOAD_ERR_OK) {
        $target_dir = "../../assets/uploads/kamer_$current_room/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, recursive: true);
        }
        // Create file name with number in it
        $extension = pathinfo($_FILES["afbeelding"]["name"], PATHINFO_EXTENSION);
        $counter = 1;

        // Find next available number without file extension (.png, .jpeg, .jpg)
        while (glob($target_dir . "image_" . $counter . ".*")) {
            $counter++;
        }

        $target_file_name = "image_" . $counter . "." . $extension;
        $target_file = $target_dir . $target_file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["afbeelding"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


        // Check file size
        if ($_FILES["afbeelding"]["size"] > 2000000) { //2 mb
            echo "File is too big.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "File was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["afbeelding"]["name"])) . " has been uploaded.";
                $command = "INSERT INTO afbeeldingen (kamer_id, link) VALUES ($current_room, '/assets/uploads/kamer_$current_room/$target_file_name')";
                mysqli_query($conn, $command);
            } else {
                echo "Error uploading file.";
            }
        }
    }

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
                        <input type="file" id="kamer-afbeelding-upload" name="afbeelding" class="kamer-input" accept="image/*">
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