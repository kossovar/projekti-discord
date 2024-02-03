<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/Server.php');

class ServerController
{
    private $server;

    public function __construct()
    {
        global $conn;
        $this->server = new Server($conn);
    }

    public function createServer($userId, $title, $description, $imageUrl)
    {
        return $this->server->createServer($userId, $title, $description, $imageUrl);
    }

    public function getAllServers()
    {
        return $this->server->getAllServers();
    }

    public function getServerById($id)
    {
        return $this->server->getServerById($id);
    }

    public function updateServer($id, $title, $description, $imageUrl)
{
    $userId = $_SESSION['user']['id'];
    $isAdmin = $_SESSION['user']['role'] === 'admin';

    return $this->server->updateServer($id, $userId, $title, $description, $imageUrl, $isAdmin);
}

    public function deleteServer($serverId, $userId)
    {
        $server = $this->server->getServerById($serverId);
        if ($server && ($server['user_id'] == $userId || $_SESSION['user']['role'] === 'admin')) {
            return $this->server->deleteServerById($serverId);
        }

        return false;
    }
}
