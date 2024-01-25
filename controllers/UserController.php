<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/User.php');

class UserController {
    private $conn;
    private $user;

    public function __construct() {
        global $conn;  // Use the connection established in database-config.php
        $this->conn = $conn;

        // Check if the connection was successful
        if (!$this->conn) {
            die("Connection failed!");
        }

        $this->user = new User($this->conn);
    }

    public function registerUser($email, $displayName, $username, $password, $birthdate) {
        $validationErrors = $this->validateUserInputs($email, $displayName, $username, $password, $birthdate);

        if (!empty($validationErrors)) {
            return $validationErrors;
        }

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $registrationResult = $this->user->register($email, $displayName, $username, $hashedPassword, $birthdate);

        return $registrationResult;
    }

    public function loginUser($email, $password) {
        $loginResult = $this->user->login($email, $password);

        return $loginResult;
    }

    private function validateUserInputs($email, $displayName, $username, $password, $birthdate) {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }


        return $errors;
    }
}

?>
