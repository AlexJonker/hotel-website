
<?php
 $host = 'localhost';
$username = 'root';
$password = '';
$database = 'changeme';

// Create connection
 $conn = new mysqli($host, $username, $password,$database);

    // Foutafhandeling
    if ($conn->connect_error) {
        die("Verbinding mislukt: {$conn->connect_error} <br>");
    }
    echo "Verbinding succesvol! <br>";

?>