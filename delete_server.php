<?php
session_start();
require_once('controllers/ServerController.php'); // Adjust path as needed

// Redirect if not logged in
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
        // Optionally, set a session flash message to show success
        $_SESSION['flash_message'] = 'Server deleted successfully.';
    } else {
        // Optionally, set a session flash message to show failure
        $_SESSION['flash_message'] = 'Failed to delete server.';
    }
}

header('Location: servers.php');
exit;