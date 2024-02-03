<?php

class ContactMessage
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // shtojme nje contact mesazh ne databaze
    public function insertMessage($email, $subject, $description)
    {
        $stmt = $this->conn->prepare("INSERT INTO contact_messages (email, subject, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $subject, $description);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // i marrim te gjitha mesazhet nga db
    public function getAllMessages()
    {
        $result = $this->conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
