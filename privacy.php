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
  <link rel="stylesheet" href="css/privacy.css">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Privacy Hub | Discord Safety</title>
</head>
<body>
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
  <div class="hero">
    <div class="container">
      <div class="content">
        <h1>DISCORD <br> PRIVACY HUB</h1>
        <p>Because privacy is an essential part of <span>feeling safe.</span></p>
      </div>
      <div class="content-img">
        <img src="img/privacy.svg" alt="" height="400px" width="600px">
      </div>
    </div>
  </div>
  <!-- section 1 -->
  <div class="section1">
    <div class="section1-text">
      <h1>Our Privacy Principles</h1>
    <p>We created Discord to be a platform that brings people together over shared experiences and gives everyone a place to belong. We understand that not everyone uses Discord in the same way, and people may want different spaces for different experiences. For example, you can talk to friends one-on-one, in small groups, or around your favorite things in large servers. People have different expectations of privacy in each space, and your information may be treated differently depending on the space you’re in. But no matter what, <span>we build privacy into our products, and we will always try to let you know what's happening where and when. </span>Here are our guiding principles:</p>
    </div>
    <div class="section1-content">
      <div class="section1-img">
        <img src="img/privacyKeys.svg" alt="" height="400px" width="500px">
      </div>
      <div class="section1-imgtext">
        <div class="borderText">
          <h2>You’re in control</h2>
          <p>Stronger privacy starts with putting you in control of your experience. Whether that’s limiting the information Discord collects about you, or deciding who can chat with you or what content you see, it’s up to you.</p>
        </div>
        <h2>Less data, more transparency</h2>
        <h2>With data comes great responsibility</h2>
        <h2>You’re not the product</h2>
      </div>
    </div>
  </div>
  <!-- section 2 -->
  <div class="section2">
    <div class="container2">
      <div class="section2-text">
        <h1>Privacy Preserving <br> Products</h1>
        <p> We approach everything we make with privacy principles in mind from the very start, take extra measures to keep you safe, and put you in control of your experience with privacy settings.</p>
        <h4>Learn more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #fff;"></i></h4>
      </div>
      <div class="section2-img">
        <img src="img/privacy2.svg" alt="" height="300px" width="400px">
      </div>
    </div>
  </div>
  <!-- section 3 -->
  <div class="section3">
    <div class="container3">
      <div class="section3-img">
        <img src="img/privacy3.svg" alt="" height="350px" width="420px">
      </div>
      <div class="section3-text">
        <h1>Privacy Policy</h1>
        <p>Our Privacy Policy goes into all the details about how we collect, use, store, protect, and share your personal information.</p>
        <h4>Learn more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #fff;"></i></h4>
      </div>
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
<script src="js/main.js"></script>
</html>