<?php
session_start();

$user = null;

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

if (isset($_COOKIE['visited'])) {
  echo '<div class="welcome-message">Welcome back to the site!</div>';
} else {
  setcookie('visited', 'true', time() + 3600 * 24 * 30);
}

require_once('controllers/ServerController.php');
$serverController = new ServerController();
$servers = $serverController->getAllServers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/servers.css">
  <link rel="icon" type="image/x-icon" href="./img/discord-round-color-icon.webp">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Support</title>
</head>

<body>
  <div class="container">
    <div class="hero">
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
            <li class="nav-item"><a href="servers.php" class="nav-link">Servers</a></li>
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
            echo '<a href="logout.php" class="logout">Logout</a>';
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
      <div class="content">
        <div class="content-text">
          <h1>FIND YOUR COMMUNITY ON <br> DISCORD</h1>
          <h4>Create or find your server! From gaming, to music, to learning, there's a place for you.</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <!-- Navbar and hero content remains unchanged -->
    <!-- Server Container -->
    <div class="server-container">
      <?php if ($user) : ?>
        <div class="create-server">
          <!-- Anchor Tag Styled as a Button -->
          <a href="create_server.php" class="serverButton">Create Your Server</a>
        </div>
      <?php endif; ?>

      <?php foreach ($servers as $server) : ?>
        <div class="server">
          <div class="serverImg">
            <img src="<?= htmlspecialchars($server['image_url']) ?>" alt="Server Image">
          </div>
          <div class="serverContent">
            <h2><?= htmlspecialchars($server['title']) ?></h2>
            <p><?= htmlspecialchars($server['description']) ?></p>
            <p>Created by: <?= htmlspecialchars($server['creator_name']) ?></p>
            <!-- Check if the current user is the creator or an admin -->
            <div class="buttons">
              <?php if ($user && ($user['id'] == $server['user_id'] || $user['role'] === 'admin')) : ?>
                <button onclick="window.location.href='edit_server.php?id=<?= $server['id'] ?>'">Edit</button>
                <button onclick="if(confirm('Are you sure you want to delete this server?')) window.location.href='delete_server.php?id=<?= $server['id'] ?>'">Delete</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
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
<script src="./js/main.js"></script>

</html>