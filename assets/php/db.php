<?php
$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "";  
$db_name = "hotel_website";

$conn = mysqli_connect($db_host, $db_user, $db_pass);

if (!$conn) {
    die("Database-verbinding mislukt: " . mysqli_connect_error());
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name`");
mysqli_select_db($conn, $db_name);

mysqli_query($conn, "
    CREATE TABLE IF NOT EXISTS kamers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naam VARCHAR(100) NOT NULL,
        beschrijving TEXT,
        prijs DECIMAL(10,2) NOT NULL,
        beschikbaar BOOLEAN NOT NULL DEFAULT TRUE
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
