<?php
require_once('controllers/UserController.php');
$userController = new UserController();

// shikon nese nje ID eshte dhene
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // e therret metoden deleteUser
    $result = $userController->deleteUser($userId);
}

// na kthen ne dashboard pas fshirjes
header('Location: dashboard.php');
exit;
