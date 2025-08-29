<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$dbPassword = '';
$conn->select_db('hotel_website');
$sql = "SELECT wachtwoord FROM wachtwoord LIMIT 1";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
    $dbPassword = $row['wachtwoord'];
}
$conn->close();
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
    <?php include('../assets/html/navbar.html'); ?>
    <section class="login-container">
        <h1 class="login-title">Admin Login</h1>
        <div id="errorMessage" class="error-message" style="display: none;">
            Fout wachtwoord. Probeer opnieuw.
        </div>

        <form id="loginForm">
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
        
        <p class="info-text">Alleen bevoegd personeel heeft toegang tot dit gedeelte.</p>

    </section>
    <br>
    <?php include('../assets/html/footer.html'); ?>


    <script>
        const DatabasePassword = <?php echo json_encode($dbPassword); ?>;
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('errorMessage');

            if (password === DatabasePassword) {
                errorMessage.style.display = 'none';
                window.location.href = '/admin/index.php';
            } else {
                errorMessage.textContent = 'Fout wachtwoord. Probeer opnieuw.';
                errorMessage.style.display = 'block';
            }
        });
    </script>
    
</body>
</html>
