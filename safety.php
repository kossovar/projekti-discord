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
  <link rel="stylesheet" href="css/safety.css">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Discord Safety Center</title>
</head>

<body>
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
    <!-- pjesa e content -->
    <main>
      <div class="content">
        <div class="text">
          <h1>DISCORD <br> SAFETY CENTER</h1>
          <p>Discord is the place to hang out with your friends and build community around <br> shared interests. We’re
            committed to creating a safe, inclusive and welcoming <br> place.
          </p>
          <p>That’s why we’re working to make Discord private and safe, by design. Learn how <br> to shape the best
            experience for yourself and find the resources you need, <br> whether you’re a teen, parent, educator, or
            long-time Discord user.</p>
        </div>
        <div class="content-img">
          <img src="img/safety.svg" alt="" height="455px" width="630px">
        </div>
      </div>
      <div class="boxes">
        <div class="boxes-1">
          <button>SAFETY LIBRARY</button>
          <button>PRIVACY HUB</button>
          <button>PARENT HUB</button>
        </div>
        <div class="boxes-2">
          <button>TRANSPARENCY HUB</button>
          <button>SAFETY NEWS HUB</button>
          <button>POLICY HUB</button>
        </div>
      </div>
      <div class="video-container">
        <div class="video-section">
          <h2>Building Safer Spaces</h2>
          <iframe width="100%" height="400px" src="https://www.youtube.com/embed/LvtpbOarcWE">
          </iframe>
        </div>
      </div>
      <div class="safety-content">
        <div class="safety-container">
          <div class="safety-library">
            <div class="safety-text">
              <h2>Safety Library</h2>
              <p>Everything you could ever want to know about safety on Discord. <br> Whether you're a user, a
                moderator, or a parent, discover all of our <br> tools and resources and how to use them.</p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
            <div class="safety-img">
              <img src="img/safetylib.svg" alt="" width="448px" height="290px">
            </div>
          </div>
          <div class="privacy-hub">
            <div class="privacy-img">
              <img src="img/privacyhub.svg" alt="" width="448px" height="290px">
            </div>
            <div class="privacy-text">
              <h2>Privacy Hub</h2>
              <p>Privacy is an essential part of feeling safe. No matter what, we <br> build privacy into our products,
                and we will always try to let you <br> know what's happening where and when. Learn more about what <br>
                that means, including the data we collect and the tools to put <br> you in control.</p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
          </div>
          <div class="safety-library">
            <div class="safety-text">
              <h2>Parent Hub</h2>
              <p>Learn more about what we’re doing to help your teen stay safer on <br> our platform, explore our Family
                Center tool, and download our <br> Parent's Guide to Discord. </p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
            <div class="safety-img">
              <img src="img/parenthub.svg" alt="" width="448px" height="290px">
            </div>
          </div>
          <div class="privacy-hub">
            <div class="privacy-img">
              <img src="img/transparencyhub.svg" alt="" width="448px" height="290px">
            </div>
            <div class="privacy-text">
              <h2>Transparency Hub</h2>
              <p>Explore data, trends, and analysis into the work done to help <br> keep people on Discord safe.
                Transparency reports cover <br> information about enforcement of our platform policies, as well <br> as
                our response to legal, emergency, and intellectual property <br> removal requests.</p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
          </div>
          <div class="safety-library">
            <div class="safety-text">
              <h2>Safety News Hub</h2>
              <p>The latest news and updates on Discord’s Safety, Privacy, and Policy <br> initiatives.</p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
            <div class="safety-img">
              <img src="img/newshub.svg" alt="" width="448px" height="290px">
            </div>
          </div>
          <div class="privacy-hub">
            <div class="privacy-img">
              <img src="img/policyhub.svg" alt="" width="448px" height="290px">
            </div>
            <div class="privacy-text">
              <h2>Policy Hub</h2>
              <p>Learn about our Community Guidelines, developed to help keep <br> people safe and make Discord the best
                place to hang out with <br> friends.</p>
              <h4>Explore more <i class="fa-solid fa-circle-arrow-right fa-sm" style="color: #5865f2;"></i></h4>
            </div>
          </div>
        </div>
    </main>
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