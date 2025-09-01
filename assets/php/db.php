<?php
$env = false;

if (file_exists('../.env')) {
    $env = parse_ini_file('../.env');
}
elseif (file_exists('../../.env')) {
    $env = parse_ini_file('../../.env');
}

if ($env === false) {
    die("No .env file found");
}



$conn = mysqli_connect(
    $env["db_host"],
    $env["db_user"],
    $env["db_pass"]
);

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `{$env["db_name"]}`");
mysqli_select_db($conn, $env["db_name"]);
mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS kamers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naam VARCHAR(100) NOT NULL,
        beschrijving TEXT,
        prijs DECIMAL(10,2) NOT NULL,
        beschikbaar INT NOT NULL DEFAULT TRUE
    )
");

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS afbeeldingen (
        id INT AUTO_INCREMENT PRIMARY KEY,
        link VARCHAR(255) DEFAULT NULL,
        kamer_id INT NOT NULL
    )
");

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS wachtwoord (
        wachtwoord VARCHAR(255) NOT NULL
    )
");

mysqli_query($conn, "
    INSERT INTO wachtwoord (wachtwoord) 
    SELECT '#K@tt3nkwaad!' 
    WHERE NOT EXISTS (SELECT 1 FROM wachtwoord WHERE wachtwoord = '#K@tt3nkwaad!')
");