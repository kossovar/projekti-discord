<?php
require_once('./classes/Database.php');

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "discord";

$database = new Database($servername, $username, $password, $dbname);

$conn = $database->getConnection();


if ($conn) {
    return $database;
} else {
    echo "Connection failed!";
}
