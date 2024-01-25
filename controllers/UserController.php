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
            return ['success' => false, 'message' => $validationErrors];
        }

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $registrationResult = $this->user->register($email, $hashedPassword, $displayName, $username, $birthdate);

        return ['success' => true, 'message' => 'Registration successful'];;
    }

    public function loginUser($email, $password) {
        $loginResult = $this->user->login($email, $password);

        if (!$loginResult) {
            $response = ['success' => false, 'message' => 'Email or password combination is incorrect'];
        } else {
            $response = ['success' => true, 'message' => 'Login successful'];
        }

        return $response;
    }

    private function validateUserInputs($email, $password, $displayName, $username, $birthdate) {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if ($this->user->isEmailTaken($email)) {
            $errors['email'] = 'This email is already taken';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (strlen($displayName) < 4) {
            $errors['display_name'] = 'Display name must be at least 4 characters';
        }

        if ($this->user->isDisplayNameTaken($displayName)) {
            $errors['display_name'] = 'This display name is already taken';
        }

        if (strlen($username) < 4) {
            $errors['username'] = 'Username must be at least 4 characters';
        }

        if ($this->user->isUsernameTaken($username)) {
            $errors['username'] = 'This username is already taken';
        }

        return $errors;
    }
}

?>
