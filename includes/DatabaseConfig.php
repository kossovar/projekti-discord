<?php
require_once('./classes/Database.php');

$servername = "localhost";
$username = "root";
$password = "adminharris";
$dbname = "discord";

$database = new Database($servername, $username, $password, $dbname);

$conn = $database->getConnection();


if ($conn) {
    return $conn;
} else {
    echo "Connection failed!";
}
