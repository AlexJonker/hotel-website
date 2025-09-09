<?php
$env = false;

if (file_exists('../.env')) {
    $env = parse_ini_file('../.env');
} elseif (file_exists('../../.env')) {
    $env = parse_ini_file('../../.env');
}

if ($env === false) {
    die("No .env file found");
}

$admin_pass = password_hash($env["admin_pass"], PASSWORD_DEFAULT);

$conn = mysqli_connect(
    $env["db_host"],
    $env["db_user"],
    $env["db_pass"]
);

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `{$env["db_name"]}`");
mysqli_select_db($conn, $env["db_name"]);
mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS kamers (
        id TINYINT AUTO_INCREMENT PRIMARY KEY,
        naam VARCHAR(100) NOT NULL,
        beschrijving TEXT,
        prijs DECIMAL(10,2) NOT NULL,
        beschikbaar TINYINT NOT NULL DEFAULT TRUE
    )
");

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS afbeeldingen (
        id TINYINT AUTO_INCREMENT PRIMARY KEY,
        link VARCHAR(255) DEFAULT NULL,
        kamer_id TINYINT NOT NULL
    )
");

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS wachtwoord (
        id TINYINT PRIMARY KEY AUTO_INCREMENT,
        wachtwoord VARCHAR(255) NOT NULL
    )
");

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS reserveringen (
        id TINYINT PRIMARY KEY AUTO_INCREMENT,
        kamer_id TINYINT NOT NULL,
        start_datum DATE NOT NULL,
        eind_datum DATE NOT NULL,
        gast_naam VARCHAR(255) NOT NULL,
        gast_email VARCHAR(255) NOT NULL
    )
");

$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM wachtwoord");
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    mysqli_query($conn, "
        INSERT INTO wachtwoord (wachtwoord) 
        VALUES ('" . $admin_pass . "')
    ");
}
