<?php

class Server {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createServer($userId, $title, $description, $imageUrl) {
        $stmt = $this->conn->prepare("INSERT INTO servers (user_id, title, description, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $title, $description, $imageUrl);
        return $stmt->execute();
    }

    public function getAllServers() {
        $stmt = $this->conn->prepare("SELECT servers.*, users.display_name AS creator_name FROM servers JOIN users ON servers.user_id = users.id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getServerById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM servers WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Fetches the server as an associative array
    }

    public function updateServer($id, $userId, $title, $description, $imageUrl) {
        $stmt = $this->conn->prepare("UPDATE servers SET title = ?, description = ?, image_url = ? WHERE id = ? AND user_id = ?");
        if (!$stmt) {
            // Log or handle error
            return false;
        }
        $stmt->bind_param("sssii", $title, $description, $imageUrl, $id, $userId);
        $result = $stmt->execute();
        if (!$result) {
            // Log or handle error
            return false;
        }
        return $result;
    }

    public function deleteServerById($serverId) {
        $stmt = $this->conn->prepare("DELETE FROM servers WHERE id = ?");
        $stmt->bind_param("i", $serverId);
        return $stmt->execute();
    }

    // Add methods for updateServer, deleteServer, and getServerById as needed
}