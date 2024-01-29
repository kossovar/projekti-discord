<?php
require_once('./controllers/ContactController.php');

$contactController = new ContactController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get the user inputs from the form
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $description = $_POST['description'];

  $submitResult = $contactController->create($email, $subject, $description);

  // Handle the result and return JSON response
  if ($submitResult['success'] === true) {
    // Redirect to index.php
    $message = 'Thanks for getting in touch! Your message has been duly acknowledged';
    header('Location: contact.php?message=' . $message);
    exit();
  } else {
    $errors = $submitResult['message'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/contact.css">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Contact Us</title>
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
              <a href="index.html"><img src="img/blacklogo.png" alt="Logo e Discord" width="124" height="34"></a>
              <i class="fa-solid fa-xmark fa-xl close-menu"></i>
            </div>
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="safety.html" class="nav-link">Safety</a></li>
            <li class="nav-item"><a href="support.html" class="nav-link">Support</a></li>
            <li class="nav-item"><a href="privacy.html" class="nav-link">Privacy</a></li>
            <li class="nav-item"><a href="safety-transparency.html" class="nav-link">Transparency</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link">Contact Us</a></li>
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
    </div>
    <div class="content">
      <div class="form-container">
        <h1>Contact Us</h1>
        <?php
        if (isset($_GET['message'])) {
          echo "<div class='message-success'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        ?>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          if (isset($errors)) {
            echo '<div class="error-message">';
            foreach ($errors as $error) {
              echo '<span>' . htmlspecialchars($error) . '</span>';
            }
            echo '</div>';
          }
        }
        ?>

        <form action="contact.php" method="post">
          <div class="input-group">
            <label for="email">Your email address</label>
            <input type="email" name="email" id="email" />
          </div>
          <div class="input-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" />
          </div>
          <div class="input-group">
            <label for="description">Description</label>
            <textarea name="description" id="description">

                      </textarea>
          </div>
          <button type="submit">Submit</button>
        </form>
      </div>
      <img class="contact-img" src="./img/dev-support.svg">
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
      <div class="footer-bottom">
        <a href="index.html"><img src="img/logo.png" alt="logo e discord" width="124" height="34"></a>
        <button><a href="register.php">Sign Up</a></button>
      </div>
    </div>
  </footer>

</body>
<script src="./js/main.js"></script>

</html>