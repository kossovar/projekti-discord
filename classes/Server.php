<?php

class Server
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createServer($userId, $title, $description, $imageUrl)
    {
        $stmt = $this->conn->prepare("INSERT INTO servers (user_id, title, description, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userId, $title, $description, $imageUrl);
        return $stmt->execute();
    }

    public function getAllServers()
    {
        $stmt = $this->conn->prepare("SELECT servers.*, users.display_name AS creator_name FROM servers JOIN users ON servers.user_id = users.id");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getServerById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM servers WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateServer($id, $userId, $title, $description, $imageUrl, $isAdmin = false)
{
    if ($isAdmin) {
        $stmt = $this->conn->prepare("UPDATE servers SET title = ?, description = ?, image_url = ? WHERE id = ?");
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssi", $title, $description, $imageUrl, $id);
    } else {
        $stmt = $this->conn->prepare("UPDATE servers SET title = ?, description = ?, image_url = ? WHERE id = ? AND user_id = ?");
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("sssii", $title, $description, $imageUrl, $id, $userId);
    }
    
    $result = $stmt->execute();
    if (!$result) {
        return false;
    }
    return $result;
}
}
