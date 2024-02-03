<?php
session_start();
require_once('controllers/ServerController.php');

// redirect nese nuk jeni login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$serverId = $_GET['id'] ?? null;
$userId = $_SESSION['user']['id'];

if ($serverId) {
    $serverController = new ServerController();
    $success = $serverController->deleteServer($serverId, $userId);

    if ($success) {
        $_SESSION['flash_message'] = 'Server deleted successfully.';
    } else {
        $_SESSION['flash_message'] = 'Failed to delete server.';
    }
}

header('Location: servers.php');
exit;
