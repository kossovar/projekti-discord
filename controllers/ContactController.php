<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/ContactMessage.php');

class ContactController
{
    private $conn;
    private $message;

    public function __construct()
    {
        global $conn;  // Use the connection established in DatabaseConfig.php
        $this->conn = $conn;

        // Check if the connection was successful
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
}
