<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
require_once('./controllers/UserController.php');

$userController = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user inputs from the form
    $email = $_POST['email'];
    $displayName = $_POST['displayName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];

    $registerResult = $userController->registerUser($email, $displayName, $username, $password, $birthdate);

    // // Handle the result and return JSON response
    if ($registerResult['success'] === true) {
        // Redirect to index.php
        header('Location: login.php');
        exit();
    } else {
        $errors = $registerResult['message'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Discord</title>
    <link rel="icon" type="image/x-icon" href="./img/discord-round-color-icon.webp">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <form name="registerForm" id="registration" action="register.php" method="post">
                <h2>Create an account</h2>

                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($errors)) {
                            echo '<div class="error-message">';
                            foreach ($errors as $error) {
                                echo '<span>'.htmlspecialchars($error).'</span>';
                            }
                            echo '</div>';
                        }
                    }
                ?>
                
                <div class="input-group">
                    <label for="email">EMAIL*</label>
                    <input type="text" id="email" name="email">
                    <div class="errorEmail" id="errorEmail"></div>

                    <label for="displayName">DISPLAY NAME *</label>
                    <input type="text" id="displayName" name="displayName">
                    <div class="errorDisplayName" id="errorDisplayName"></div>

                    <label for="username">USERNAME *</label>
                    <input type="text" id="username" name="username">
                    <div class="errorUsername" id="errorUsername"></div>

                    <label for="password">PASSWORD *</label>
                    <input type="password" id="password" name="password">
                    <div class="errorPassword" id="errorPassword"></div>

                    <label for="birthdate">DATE OF BIRTH *</label>
                    <input type="date" id="birthdate" name="birthdate">
                    <div class="errorDate" id="errorDate"></div>
                </div>
                <button type="submit">Continue</button>
                <p style="font-size: 12px;">By registering, you agree to Discord's <a href="#">Terms of Service </a>and
                    <a href="#">Privacy Policy</a>.
                </p>
                <div class="register">
                    <p><a href="login.php">Already have an account?</a></p>
                </div>
            </form>
        </div>
    </div>



    <script src="js/auth.js"></script>
</body>

</html>