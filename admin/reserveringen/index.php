<?php

session_start();

if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
} else {
    header('Location: /admin');
    exit;
}


require '../../assets/php/fontawesome.php';
require '../../assets/php/db.php';


$result = mysqli_query($conn, "SELECT * FROM reserveringen ORDER BY start_datum DESC");
$reserveringen = [];
while ($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}

$vandaag = date("Y-m-d");
$komend = [];
$bezig  = [];
$geweest = [];

foreach ($reserveringen as $res) {
    if ($res['eind_datum'] < $vandaag) {
        $geweest[] = $res;
    } elseif ($res['start_datum'] <= $vandaag && $res['eind_datum'] >= $vandaag) {
        $bezig[] = $res;
    } else {
        $komend[] = $res;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Logout system
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: /admin");
    } else {
        // Change password system
        $oud_wachtwoord_input = $_POST['oud_wachtwoord'];
        $nieuw_wachtwoord_input = $_POST['nieuw_wachtwoord'];
        $herhaal_nieuw_wachtwoord_input = $_POST['herhaal_nieuw_wachtwoord'];

        if ($nieuw_wachtwoord_input !== $herhaal_nieuw_wachtwoord_input) {
            $error_message = ["red", "De nieuwe wachtwoorden komen niet overeen."];
        } else {
            $oud_wachtwoord_result = mysqli_query($conn, "SELECT wachtwoord FROM wachtwoord LIMIT 1");
            $oud_wachtwoord_row = mysqli_fetch_assoc($oud_wachtwoord_result);
            $oud_wachtwoord = $oud_wachtwoord_row ? $oud_wachtwoord_row['wachtwoord'] : '';

            if (password_verify($oud_wachtwoord_input, $oud_wachtwoord)) {
                $nieuw_wachtwoord_hash = password_hash($nieuw_wachtwoord_input, PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE wachtwoord SET wachtwoord = '$nieuw_wachtwoord_hash' WHERE id = 1");
                $error_message = ["green", 'Wachtwoord succesvol gewijzigd.'];
            } else {
                $error_message = ["red", 'Oud wachtwoord is onjuist.'];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveringen - Hotel De Zonne Vallei</title>
    <link rel="icon" href="/assets/logos/favicon.ico">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/reserveringen.css">
    <script src="/assets/js/dropdown.js"></script>
</head>


<body>
    <aside>
        <a href="/"><i class="fas fa-home"></i> Home</a>
        <a href="/admin/panel"><i class="fas fa-panel-ews"></i> Panel</a>
        <form class="logout" method="post">
            <button type="submit" name="logout"><i class="fas fa-arrow-left-from-bracket"></i> Uitloggen</button>
        </form>

        <main class="dropdown">
            <a href="#" onclick="toggleDropdown(event)">
                <i class="fas fa-key"></i> Wachtwoord wijzigen
            </a>

            <form id="dropdown-content" class="dropdown-content" method="post" enctype="multipart/form-data">
                <label for="oud_wachtwoord">Oud wachtwoord</label>
                <input type="password" name="oud_wachtwoord" required>

                <label for="nieuw_wachtwoord">Nieuw wachtwoord</label>
                <input type="password" name="nieuw_wachtwoord" required>

                <label for="herhaal_nieuw_wachtwoord">Herhaal nieuw wachtwoord</label>
                <input type="password" name="herhaal_nieuw_wachtwoord" required>

                <button type="submit">Wijzig</button>
            </form>
        </main>
        <p style="color: <?= $error_message[0] ?? '' ?>"><?= $error_message[1] ?? '' ?></p>
    </aside>
    <article>
        <section class="reserveringen">
            <h2 class="titel">Huidige Reserveringen</h2>
            <?php if (empty($bezig)): ?>
                <p class="info">Er zijn nog geen huidige reserveringen geplaatst.</p>
            <?php else: ?>
                <?php foreach ($bezig as $reservering): ?>
                    <div class="reservering">
                        <h2>Reservering <?= $reservering['id'] ?></h2>
                        <p><strong>Naam:</strong> <?= $reservering['gast_naam'] ?></p>
                        <p><strong>Email:</strong> <?= $reservering['gast_email'] ?></p>
                        <p><strong>Kamernaam:</strong> <?= $reservering['kamer_id'] ?></p>
                        <p><strong>Start datum:</strong> <?= $reservering['start_datum'] ?></p>
                        <p><strong>Eind datum:</strong> <?= $reservering['eind_datum'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
        <section class="reserveringen">
            <h2 class="titel">Komende Reserveringen</h2>
            <?php if (empty($komend)): ?>
                <p class="info">Er zijn nog geen komende reserveringen geplaatst.</p>
            <?php else: ?>
                <?php foreach ($komend as $reservering): ?>
                    <div class="reservering">
                        <h2>Reservering <?= $reservering['id'] ?></h2>
                        <p><strong>Naam:</strong> <?= $reservering['gast_naam'] ?></p>
                        <p><strong>Email:</strong> <?= $reservering['gast_email'] ?></p>
                        <p><strong>Kamernaam:</strong> <?= $reservering['kamer_id'] ?></p>
                        <p><strong>Start datum:</strong> <?= $reservering['start_datum'] ?></p>
                        <p><strong>Eind datum:</strong> <?= $reservering['eind_datum'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
        <section class="reserveringen">
            <h2 class="titel">Afgelopen Reserveringen</h2>
            <?php if (empty($geweest)): ?>
                <p class="info">Er zijn nog geen afgelopen reserveringen geplaatst.</p>
            <?php else: ?>
                <?php foreach ($geweest as $reservering): ?>
                    <div class="reservering">
                        <h2>Reservering <?= $reservering['id'] ?></h2>
                        <p><strong>Naam:</strong> <?= $reservering['gast_naam'] ?></p>
                        <p><strong>Email:</strong> <?= $reservering['gast_email'] ?></p>
                        <p><strong>Kamernaam:</strong> <?= $reservering['kamer_id'] ?></p>
                        <p><strong>Start datum:</strong> <?= $reservering['start_datum'] ?></p>
                        <p><strong>Eind datum:</strong> <?= $reservering['eind_datum'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

    </article>

</body>

</html>