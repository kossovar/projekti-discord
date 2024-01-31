<?php

require_once('./includes/DatabaseConfig.php');
require_once('./classes/User.php');

class UserController
{
    private $conn;
    private $user;

    public function __construct()
    {
        global $conn;  // Use the connection established in DatabaseConfig.php
        $this->conn = $conn;

        // Check if the connection was successful
        if (!$this->conn) {
            die("Connection failed!");
        }

        $this->user = new User($this->conn);
    }

    public function registerUser($email, $displayName, $username, $password, $birthdate)
    {
        $validationErrors = $this->validateUserInputs($email, $displayName, $username, $password, $birthdate);

        if (!empty($validationErrors)) {

            return ['success' => false, 'message' => $validationErrors];
        }

        $birthdate = DateTime::createFromFormat('Y-m-d', $birthdate);
        $birthdateString = $birthdate->format('Y-m-d');

        $this->user->register($email, $displayName, $username, $password, $birthdateString);

        return ['success' => true, 'message' => 'Registration successful'];
    }

    public function loginUser($email, $password)
    {
        $loginResult = $this->user->login($email, $password);

        if (!$loginResult) {
            $response = ['success' => false, 'message' => 'Email or password combination is incorrect'];
        } else {
            $response = ['success' => true, 'message' => 'Login successful'];
        }

        return $response;
    }

    private function validateUserInputs($email, $displayName, $username, $password, $birthdate)
    {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if ($this->user->isEmailTaken($email)) {
            $errors['email'] = 'This email is already taken';
        }

        if ($this->user->isUsernameTaken($username)) {
            $errors['username'] = 'This username is already taken';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (strlen($displayName) < 4) {
            $errors['display_name'] = 'Display name must be at least 4 characters';
        }

        if (strlen($username) < 4) {
            $errors['username'] = 'Username must be at least 4 characters';
        }


        if (isset($birthdate)) {
            $dateObject = DateTime::createFromFormat('Y-m-d', $birthdate);

            if ($dateObject->format('Y-m-d') !== $birthdate) {
                $errors['birthdate'] = 'Invalid date format';
            }
        }

        return $errors;
    }

    // FUNKSIONET QE PERDOREN PER NE CRUD


    // READ
    // metoda qe perdoret per 'read' ku i merr te gjithe user-at
    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("SELECT id, email, display_name, username, birthdate, role FROM users");
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $users;
    }

    // CREATE
    // metoda qe perdoret per te krijuar nje user te ri
    public function createUser($email, $displayName, $username, $password, $birthdate)
    {
        // Validate user inputs
        $validationErrors = $this->validateUserInputs($email, $displayName, $username, $password, $birthdate);

        if (!empty($validationErrors)) {
            return ['success' => false, 'message' => $validationErrors];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user into the database
        $stmt = $this->conn->prepare("INSERT INTO users (email, display_name, username, password, birthdate, role) VALUES (?, ?, ?, ?, ?, 'user')");
        $stmt->bind_param("sssss", $email, $displayName, $username, $hashedPassword, $birthdate);

        if ($stmt->execute()) {
            $stmt->close();
            return ['success' => true, 'message' => 'User created successfully'];
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'An error occurred during user creation'];
        }
    }

    // metoda qe perdoret per te marr ID e useri te caktuar
    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        return $user;
    }


    // UPDATE
    // metoda qe perdoret per te perditesuar te dhenat e userit bazuar ne ID te caktuar
    public function updateUser($id, $email, $displayName, $username, $birthdate)
    {
        // Include validation and password hashing if necessary
        $stmt = $this->conn->prepare("UPDATE users SET email = ?, display_name = ?, username = ?, birthdate = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $email, $displayName, $username, $birthdate, $id);
        if ($stmt->execute()) {
            $stmt->close();
            header('Location: dashboard.php');
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'An error occurred during user update'];
        }
    }

    // DELETE
    // metoda qe mundeson te fshij nje user
    public function deleteUser($id)
    {
        // Prepare the DELETE statement to remove the user with the specified ID
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            return ['success' => true, 'message' => 'User deleted successfully'];
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'An error occurred during user deletion'];
        }
    }
}
