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
  <link rel="stylesheet" href="css/style.css">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Projekti Web | Discord Clone</title>
</head>

<body>
  <!-- Container qe i mban krejt elementet ne qender -->
  <div class="container">
    <!-- Klasa hero qe permbane pjesen e navigation bar edhe main hero -->
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
      <!-- Pjesa e tekstit ne hero -->
      <div class="content">
        <h1>IMAGINE A PLACE...</h1>
        <h4>...where you can belong to a school club, a gaming group, or a worldwide art community. <br> Where just you
          and a handful of friends can spend time together. A place that makes it <br> easy to talk every day and hang
          out more often.</h4>
        <div class="content-buttons">
          <button class="windows">
            <!-- <svg width="24" height="24" viewBox="0 0 24 24" class="icon-2tQ9Jt"><g fill="currentColor"><path d="M17.707 10.708L16.293 9.29398L13 12.587V2.00098H11V12.587L7.70697 9.29398L6.29297 10.708L12 16.415L17.707 10.708Z"></path><path d="M18 18.001V20.001H6V18.001H4V20.001C4 21.103 4.897 22.001 6 22.001H18C19.104 22.001 20 21.103 20 20.001V18.001H18Z"></path></g></svg> -->
            Download for Windows
          </button>
          <button class="browser">Open Discord in your browser</button>
        </div>
      </div>
      <!-- Perfundon pjesa e tekstit ne hero -->
    </div>
    <!-- Klasa hero perfundon ketu -->
  </div>
  <div class="container-section">
    <div class="section1-content">
      <img src="./img/section1-img.svg" alt="Section 1 image">
      <div class="section1-text">
        <h2>Create an invite- <br> only place where <br> you belong</h2>
        <h4>Discord servers are organized into topic- <br> based channels where you can collaborate, <br> share, and
          just talk about your day without <br> clogging up a group chat.</h4>
      </div>
    </div>
    <div class="section2-content">
      <div class="section2-text">
        <h2>
          Where hanging <br> out is easy
        </h2>
        <h4>Grab a seat in a voice channel when you're <br> free. Friends in your server can see you're <br> around and
          instantly pop in to talk without <br> having to call.</h4>
      </div>
      <img src="./img/section2-img.svg" alt="Section 2 image">
    </div>
    <div class="section3-content">
      <img src="./img/section3-img.svg" alt="Section 3 image" width="750px" height="450px">
      <div class="section3-text">
        <h2>From few to a <br> fandom</h2>
        <h4>Get any community running with moderation <br> tools and custom member access. Give <br> members special
          powers, set up private <br> channels, and more.</h4>
      </div>
    </div>
    <div class="section4-content">
      <div class="section4-text">
        <h1>RELIABLE TECH FOR STAYING CLOSE</h1>
        <h4>Low-latency voice and video feels like youre in the same room. Wave hello over video, watch friends stream
          their <br> games , or gather up and have a drawing session with screen share.</h4>
      </div>
      <div class="section4-other">
        <img src="./img/section4-img.svg" alt="Section 4 image" width="1200px" height="730px">
        <h2>Ready to start your journey?</h2>
        <button>Download for Windows</button>
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
<script src="./js/main.js"></script>

</html>