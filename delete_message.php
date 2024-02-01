<?php
require_once('controllers/ContactController.php');

if (isset($_GET['id'])) {
    $contactController = new ContactController();
    $result = $contactController->deleteMessage($_GET['id']);

    if ($result['success']) {
        // redirect ne dashboard pas fshirjes se mesazhit
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $result['message'];
    }
} else {
    // mesazhi error nese mesazhi nuk ka nje ID 
    echo "Error: No ID provided for deletion.";
}
