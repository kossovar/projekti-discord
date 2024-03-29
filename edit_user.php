<?php
require_once('controllers/UserController.php');
$userController = new UserController();

// ID e userit perdoret si parameter
$userId = $_GET['id'] ?? null;
$user = null;

if ($userId) {
    $user = $userController->getUserById($userId);
}

if (!$user) {
    echo "User not found";
    exit;
}

if (isset($_POST['updateUser'])) {
    $email = $_POST['email'] ?? '';
    $displayName = $_POST['displayName'] ?? '';
    $username = $_POST['username'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';

    // thirret metoda updateUser
    $updateResult = $userController->updateUser($userId, $email, $displayName, $username, $birthdate);

    if ($updateResult['success']) {
        echo "<p>User updated successfully.</p>";
    } else {
        echo "<p>Error updating user: " . htmlspecialchars($updateResult['message']) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/create_user.css">
    <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard | Discord Clone</title>
</head>

<body>
    <!-- Container qe i mban krejt elementet ne qender -->
    <div class="container">
        <!-- navbari -->
        <nav class="navbar">
            <div class="logo">
                <a href="index.php"><img src="./img/logo.png" alt="Logo e Discord" width="124" height="34"></a>
            </div>
            <div class="items">
                <ul class="nav-menu">
                    <div class="logo-mobile">
                        <a href="index.php"><img src="img/blacklogo.png" alt="Logo e Discord" width="124" height="34"></a>
                        <i class="fa-solid fa-xmark fa-xl close-menu"></i>
                    </div>
                    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="safety.php" class="nav-link">Safety</a></li>
                    <li class="nav-item"><a href="support.php" class="nav-link">Support</a></li>
                    <li class="nav-item"><a href="privacy.php" class="nav-link">Privacy</a></li>
                    <li class="nav-item"><a href="safety-transparency.php" class="nav-link">Transparency</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
                    <?php
                    if ($user && $user['role'] === 'admin') {
                        echo '<li class="nav-item admin-menu"><a href="dashboard.php" class="nav-link">Dashboard</a></li>';
                    }
                    ?>
                    <div class="buttons-mobile">
                        <?php
                        if ($user) {
                            echo '<div class="profile-mobile">' . htmlspecialchars($user['display_name']) . '</div>';
                            echo '<button class="logout-mobile"><a href="logout.php">Logout</a></button>';
                        } else {
                            echo '<button class="login-mobile"><a href="login.php">Log In</a></button>';
                        }
                        ?>
                    </div>
                </ul>
            </div>
            <div class="buttons">
                <?php
                if ($user) {
                    echo '<div class="profile">' . htmlspecialchars($user['display_name']) . '</div>';
                } else {
                    echo '<button class="login"><a href="login.php">Log In</a></button>';
                }
                ?>
            </div>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </nav>
        <!-- navbari perfundon -->
    </div>
    <!-- pjesa kryesore e create user -->
    <div class="main">
        <h2>Edit User</h2>
        <form action="edit_user.php?id=<?= htmlspecialchars($userId) ?>" method="post">
            <input type="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
            <input type="text" name="displayName" required value="<?= htmlspecialchars($user['display_name']) ?>">
            <input type="text" name="username" required value="<?= htmlspecialchars($user['username']) ?>">
            <input type="date" name="birthdate" required value="<?= htmlspecialchars($user['birthdate']) ?>">
            <button type="submit" name="updateUser">Update User</button>
        </form>
    </div>
    <!-- pjesa kryesore e create user mbaron ketu -->
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="social">
                    <h1>IMAGINE A <br> PLACE</h1>
                    <div class="icons">
                        <a href="#"><i class="fa-brands fa-twitter fa-xl" style="color: #ffffff;"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram fa-xl" style="color: #ffffff;"></i></a>
                        <a href="#"><i class="fa-brands fa-square-facebook fa-xl" style="color: #ffffff;"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube fa-xl" style="color: #ffffff;"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok fa-xl" style="color: #ffffff;"></i></a>
                    </div>
                </div>
                <div class="one">
                    <ul>
                        <p>Product</p>
                        <li>Download</li>
                        <li>Nitro</li>
                        <li>Status</li>
                        <li>App Directory</li>
                    </ul>
                </div>
                <div class="two">
                    <p>Company</p>
                    <ul>
                        <li>About</li>
                        <li>Jobs</li>
                        <li>Brand</li>
                        <li>Newsroom</li>
                        <li>Fall Release</li>
                    </ul>
                </div>
                <div class="three">
                    <p>Resources</p>
                    <ul>
                        <li>College</li>
                        <li>Support</li>
                        <li>Safety</li>
                        <li>Blog</li>
                        <li>Feedback</li>
                        <li>StreamKit</li>
                        <li>Creators</li>
                        <li>Community</li>
                        <li>Developers</li>
                        <li>Gaming</li>
                        <li>Official 3rd Party Merch</li>
                    </ul>
                </div>
                <div class="four">
                    <p>Policies</p>
                    <ul>
                        <li>Terms</li>
                        <li>Privacy</li>
                        <li>Cookie Settings</li>
                        <li>Guidelines</li>
                        <li>Acknowledgements</li>
                        <li>Liscenses</li>
                        <li>Company Information</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <a href="#"><img src="img/logo.png" alt="logo e discord" width="124" height="34"></a>
            <button><a href="register.php">Sign Up</a></button>
        </div>
    </footer>
</body>
<script src="./js/main.js"></script>

</html>