<?php
session_start();
require_once('controllers/ServerController.php');

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php'); // user-at qe nuk jane admin kthehen ne homepage
    exit;
}


$serverController = new ServerController();
$serverId = $_GET['id'];
$server = $serverController->getServerById($serverId);

// Check if the server exists
if (!$server) {
    echo "Server not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageUrl = $_POST['image_url'];

    // Simple validation
    if (!empty($title) && !empty($description) && !empty($imageUrl)) {
        $success = $serverController->updateServer($serverId, $title, $description, $imageUrl);
        if ($success) {
            header('Location: servers.php');
            exit;
        } else {
            echo "An error occurred. Please try again.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/create_server.css">
    <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
    <title>Edit Server | Discord Clone</title>
</head>

<body>
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
    <div class="container-edit">
        <h2>Edit Server</h2>
        <form action="edit_server.php?id=<?= htmlspecialchars($serverId) ?>" method="POST">
            <div class="form-group">
                <label for="title">Server Title:</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($server['title']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Server Description:</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($server['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url" value="<?= htmlspecialchars($server['image_url']) ?>" required>
            </div>
            <button type="submit">Update Server</button>
        </form>
    </div>
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


</html>