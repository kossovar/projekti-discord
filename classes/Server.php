<?php

class Server {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createServer($userId, $title, $description, $imageUrl) {
        $query = "INSERT INTO servers (user_id, title, description, image_url) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $userId, $title, $description, $imageUrl);
        return $stmt->execute();
    }

    public function getServers() {
        $query = "SELECT servers.*, users.username AS creator FROM servers JOIN users ON servers.user_id = users.id";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserServers($userId) {
        $query = "SELECT * FROM servers WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateServer($serverId, $userId, $title, $description, $imageUrl) {
        $query = "UPDATE servers SET title = ?, description = ?, image_url = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssii", $title, $description, $imageUrl, $serverId, $userId);
        return $stmt->execute();
    }

    public function deleteServer($serverId, $userId) {
        $query = "DELETE FROM servers WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $serverId, $userId);
        return $stmt->execute();
    }
}
?>