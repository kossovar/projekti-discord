<?php
session_start();

$user = null;

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

if (isset($_COOKIE['visited'])) {
  // user-i ka vizituar faqen me pare, shfaqim nje mesazh
  echo '<div class="welcome-message">Welcome back to the site!</div>';
} else {
  // user-i viziton faqen per here te pare, e krijojme nje cookie
  setcookie('visited', 'true', time() + 3600 * 24 * 30); // cookie skadon mbrenda 30 dite
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/support.css">
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
          <h1>Help Center</h1>
        </div>
        <div class="search-bar">
          <input type="text" id="search-bar" name="search-bar" placeholder="Search">
        </div>
      </div>
    </div>
    <div class="container-section">
      <h2>Need help? We've got your back.</h2>
      <p>From account settings to permissions, find help for everything Discord <br>
        If you're new to Discord and looking for tips, check out our <a href="#">Beginner's Guide</a></p>
    </div>

    <div class="section">
      <ul class="section-wrapper">
        <li class="announcements">
          <h2>Announcements</h2>
          <hr />
          <h3>We've got out ear to the ground. <br> Here's what you need to know.</h3>
        </li>
        <li class="interface">
          <h2>Discords's Interface</h2>
          <hr />
          <h3>WHAT DOES THIS BUTTON <br> DO!?!11</h3>
        </li>
        <li class="account-settings">
          <h2>Account Settings</h2>
          <hr />
          <h3>You're a special snowflake and <br> so is your account.</h3>
        </li>
        <li class="getting-started">
          <h2>Getting Started</h2>
          <hr />
          <h3>Start off on the right foot! Not <br> the left one!</h3>
        </li>
        <li class="server-setup">
          <h2>Server Setup</h2>
          <hr />
          <h3>Almost as exciting as interior <br> decorating.</h3>
        </li>
        <li class="community-programs">
          <h2>Community Programs</h2>
          <hr />
          <h3>Bringing people together from <br> all around the globe &lpar; and <br> occasionally Mars &rpar; </h3>
        </li>
        <li class="perks">
          <h2>Perks and Subscriptions</h2>
          <hr />
          <h3>Please don't shop until <br> drop. Let us hlep.</h3>
        </li>
        <li class="billing">
          <h2>Billing</h2>
          <hr />
          <h3>That feel when you look at your <br> bank account.</h3>
        </li>
        <li class="trust">
          <h2>Trust & Safety</h2>
          <hr />
          <h3>Keep things safe & sound for <br> you and your buddies.</h3>
        </li>
        <li class="faq">
          <h2>F.A.Q.s</h2>
          <hr />
          <h3>All you can eat self-serve <br> problem solving.</h3>
        </li>
      </ul>
    </div>

    <div class="intro-section">
      <h2>Other ways to find help.</h2>
      <ul class="section-wrapper">
        <li class="support">
          <h2>Developer Support</h2>
          <hr />
          <h3>Your home for support with <br> developing bots, apps, & games <br> using our API and SDK!</h3>
        </li>
        <li class="twitter">
          <h2>Twitter</h2>
          <hr />
          <h3>Have a quick question? Hit us up <br> on Twitter!</h3>
        </li>
      </ul>
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