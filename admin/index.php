<?php
session_start();
require '../assets/php/db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /admin/panel');
    exit;
}

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dbPassword = '';
$sql = "SELECT wachtwoord FROM wachtwoord LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $dbPassword = $row['wachtwoord'];
}
$conn->close();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    
    if ($password === $dbPassword) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/panel');
        exit;
    } else {
        $errorMessage = 'Fout wachtwoord. Probeer opnieuw.';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/login.css">
    <title>Admin - Hotel De Zonne Vallei</title>
</head>

<body>
    <section class="login-container">
        <h1 class="login-title">Admin Login</h1>
        <br>
        <div id="errorMessage" class="error-message" style="display: none;">
            Fout wachtwoord. Probeer opnieuw.
        </div>
        <br>
        <form id="loginForm" method="POST">
            <div class="form-group">
                <label for="password" class="form-label">Wachtwoord</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Voer uw wachtwoord in"
                    required>
            </div>
            <button type="submit" class="login-btn">Inloggen</button>
        </form>
        <br>
        <p class="info-text">Alleen bevoegd personeel heeft toegang tot dit gedeelte.</p>

    </section>
</body>
</html>