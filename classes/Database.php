<?php

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor to set up the database connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        $this->connect(); // Call the connect method in the constructor
    }

    // Connect to the database
    private function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get the database connection
    public function getConnection() {
        return $this->conn;
    }

    // Close the database connection
    public function closeConnection() {
        $this->conn->close();
    }
}
?>
