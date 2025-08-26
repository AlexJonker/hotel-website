<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/global.css">
    <link rel="stylesheet" href="/styling/admin.css">
    <title>Admin - Hotel De Zonne Vallei</title>
</head>

<body>
    <div class="login-container">
        <h1 class="login-title">Login voor admin</h1>
        <form id="loginForm">
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Enter your password"
                    required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <div id="errorMessage" class="error-message"></div>
            <div id="successMessage" class="success-message"></div>
        </form>
    </div>
</body>

</html>