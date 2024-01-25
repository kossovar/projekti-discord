<?php
require_once ('./controllers/UserController.php');

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user inputs from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginResult = $userController->loginUser($email, $password);

    // // Handle the result and return JSON response
    if ($loginResult['success'] === true) {
        // Redirect to index.php
        header('Location: index.php');
        exit ();
    } else {
        $error = $loginResult['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Discord</title>
    <link rel="icon" type="image/x-icon" href="./img/discord-round-color-icon.webp">
</head>

<body>
    <div class="container">
        <div class="login-box">
        <form class="login-form" id="login" action="login.php" method="post">
    <h2>Welcome back!</h2>
    <p>We're so excited to see you again!</p>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($error)) {
                echo '<div class="error-message">' . htmlspecialchars($error) . '</div>';
            }
        }
    ?>

    <div class="input-group">
        <label for="email">EMAIL OR PHONE NUMBER *</label>
        <input type="text" id="email" name="email">
        <div class="errorEmail" id="errorEmail"></div>
        <label for="password">PASSWORD *</label>
        <input type="password" id="password" name="password">
        <div class="errorPassword" id="errorPassword"></div>
    </div>
    <div class="forgot-password">
        <a href="#">Forgot your password?</a>
    </div>
    <button type="submit">Login</button>
    <div class="register">
        <p>Need an account? <a href="register.php">Register</a></p>
    </div>
</form>

        </div>
    </div>

    <!-- <script src="./js/auth.js"></script> -->
</body>

</html>
