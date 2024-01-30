<?php
require_once('includes/DatabaseConfig.php');

session_start();

$user = null;

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header('Location: index.php'); // user-at qe nuk jane admin kthehen ne homepage
  exit;
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
  <link rel="stylesheet" href="css/create.css">
  <script defer src="https://kit.fontawesome.com/473661cbea.js" crossorigin="anonymous"></script>
  <title>Create Users | Discord Clone</title>
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
          <li class="nav-item"><a href="safety.html" class="nav-link">Safety</a></li>
          <li class="nav-item"><a href="support.html" class="nav-link">Support</a></li>
          <li class="nav-item"><a href="privacy.html" class="nav-link">Privacy</a></li>
          <li class="nav-item"><a href="safety-transparency.html" class="nav-link">Transparency</a></li>
          <li class="nav-item"><a href="contact.html" class="nav-link">Contact Us</a></li>
          <?php
          if ($user && $user['role'] === 'admin') {
            echo '<li class="nav-item admin-menu"><a href="dashboard.php" class="nav-link">Dashboard</a></li>';
          }
          ?>
          <div class="buttons">
            <?php
            if ($user) {
              echo '<div class="profile-mobile">' . htmlspecialchars($user['display_name']) . '</div>';
              echo '<button class="logout"><a href="logout.php">Logout</a></button>';
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
  <!-- pjesa kryesore e create -->
  <div class="main">
    <h1 class="main-text">Create New User</h1>
    <form action="create.php" method="post">
      <label for="email">Email address:</label>
      <input type="email" id="email" name="email" required>
      <br>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <br>

      <label for="display_name">Display Name:</label>
      <input type="text" id="display_name" name="display_name" required>
      <br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <br>

      <label for="birthdate">Birthdate (optional):</label>
      <input type="date" id="birthdate" name="birthdate">

      <button type="submit" class="newUsr">Create User</button>
    </form>
  </div>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = []; // varg qe i rruan error-at

    function isValidEmail($email)
    {
      return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function isValidUsername($username)
    {
      return strlen($username) >= 5 && !preg_match('/[^a-zA-Z0-9_]/', $username);
    }

    function isValidPassword($password)
    {
      return strlen($password) >= 8 && preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password);
    }

    // validimi i inputeve duke u bazuar ne funksionet me larte
    if (!isValidEmail($_POST['email'])) {
      $errors[] = 'Invalid email address!';
    }

    if (!isValidPassword($_POST['password'])) {
      $errors[] = 'Invalid password!';
    }

    if (!isValidUsername($_POST['username'])) {
      $errors[] = 'Invalid username!';
    }

    // check nese nje email veq se ekziston
    $email = $_POST['email'];
    $checkEmailSql = "SELECT COUNT(*) FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowCount = $result->fetch_row()[0];
    if ($rowCount > 0) {
      $errors[] = 'This email address is already taken!';
    }

    // check nese nje username veq se ekziston
    $username = $_POST['username'];
    $checkUsernameSql = "SELECT COUNT(*) FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($checkUsernameSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowCount = $result->fetch_row()[0];
    if ($rowCount > 0) {
      $errors[] = 'This username is already taken!';
    }

    // shikon errorat dhe i shfaq ato
    if (count($errors) > 0) {
      echo '<p style="color: red;">Please correct the following errors:</p>';
      echo '<ul style="list-style: none;">';
      foreach ($errors as $error) {
        echo "<li>$error</li>";
      }
      echo '</ul>';
    } else {
      $sql = "INSERT INTO users (email, username, display_name, password, birthdate, role) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      // caktojm si default rolin e userave te ri ne kete variabel
      $role = 'user';

      // ekzekutohet
      $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $stmt->bind_param("ssssss", $_POST['email'], $_POST['username'], $_POST['display_name'], $hashedPassword, $_POST['birthdate'], $role);

      // ekzekutohet
      $stmt->execute();

      if ($stmt->affected_rows === 1) {
        header('Location: dashboard.php');
        exit();
      } else {
        echo '<p style="color: red;">Error creating user! Please try again.</p>';
      }

      // mbyllet lidhja me databaze
      $stmt->close();
    }
  }
  ?>
  <!-- pjesa kryesore e create mbaron ketu -->
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