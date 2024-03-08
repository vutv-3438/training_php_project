<?php
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "php_project_demo_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>