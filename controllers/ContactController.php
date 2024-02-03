<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/ContactMessage.php');

class ContactController
{
    private $conn;
    private $message;

    public function __construct()
    {
        // e perdorim lidhjen e krijuar ne DatabaseConfig.php
        global $conn;
        $this->conn = $conn;

        // shikojm nese lidhja eshte bere me sukses
        if (!$this->conn) {
            die("Connection failed!");
        }

        $this->message = new ContactMessage($this->conn);
    }

    public function create($email, $subject, $description)
    {

        $validationResult = $this->validateInputs($email, $subject, $description);

        if (!empty($validationResult)) {

            return ['success' => false, 'message' => $validationResult];
        }

        $this->message->insertMessage($email, $subject, $description);

        return ['success' => true, 'message' => 'Message store successfuly'];
    }

    public function validateInputs($email, $subject, $description)
    {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if (empty(trim($email))) {
            $errors['email'] = 'Email cannot be empty';
        }

        if (empty(trim($subject))) {
            $errors['subject'] = 'Subject cannot be empty';
        }

        if (strlen($subject) < 3) {
            $errors['subject'] = 'Subject cannot be less than 3 characters';
        }

        if (empty(trim($description))) {
            $errors['description'] = 'Description cannot be empty';
        }

        return $errors;
    }

    public function deleteMessage($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return ['success' => true, 'message' => 'Message deleted successfully'];
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'An error occurred during message deletion'];
        }
    }
}
