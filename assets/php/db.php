<?php
$env = parse_ini_file('../.env');

$host = $env["db_host"];
$db   = $env["db_name"];
$user = $env["db_user"];
$pass = $env["db_pass"];


$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS `$db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}

if (!mysqli_select_db($conn, $db)) {
    die("Error selecting database: " . mysqli_error($conn));
}

$sql = "
    CREATE TABLE IF NOT EXISTS kamers (
        id INT NOT NULL AUTO_INCREMENT,
        naam VARCHAR(100) NOT NULL,
        beschrijving TEXT,
        afbeelding VARCHAR(255) DEFAULT NULL,
        prijs DECIMAL(10, 2) NOT NULL,
        PRIMARY KEY (id)
    );

    CREATE TABLE IF NOT EXISTS afbeeldingen (
        id INT NOT NULL AUTO_INCREMENT,
        link VARCHAR(255) DEFAULT NULL,
        kamer_id INT NOT NULL,
        PRIMARY KEY (id)
    );
";
if (!mysqli_query($conn, $sql)) {
    die("Error creating table: " . mysqli_error($conn));
}