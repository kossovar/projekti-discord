<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/Server.php');

class ServerController {
    private $server;

    public function __construct() {
        global $conn;
        $this->server = new Server($conn);
    }

    public function createServer($userId, $title, $description, $imageUrl) {
        // Add validation here as needed
        return $this->server->createServer($userId, $title, $description, $imageUrl);
    }

    public function getAllServers() {
        return $this->server->getAllServers();
    }

    public function getServerById($id) {
        return $this->server->getServerById($id);
    }

    public function updateServer($id, $title, $description, $imageUrl) {
        // Assuming you have a way to get the current user's ID
        $userId = $_SESSION['user']['id'];
        
        // You might want to add additional checks here to ensure the user is authorized to update the server
        if ($_SESSION['user']['role'] === 'admin' || $this->server->getServerById($id)['user_id'] == $userId) {
             return $this->server->updateServer($id, $userId, $title, $description, $imageUrl);
        } else {
            // Handle unauthorized access attempt
            return false;
        }
    }

    public function deleteServer($serverId, $userId) {
        // Fetch the server to check ownership
        $server = $this->server->getServerById($serverId);
    
        // Check if the user is the owner or an admin
        if ($server && ($server['user_id'] == $userId || $_SESSION['user']['role'] === 'admin')) {
            return $this->server->deleteServerById($serverId);
        }
    
        return false;
    }

    // Add methods to handle update, delete, and get server by id
}