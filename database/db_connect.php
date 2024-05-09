<?php
$username = "root";
$host = "localhost";
$db_name = "senior_system";
$db_password = "MilkTeaLover02040402";

$conn = new mysqli($host, $username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed " . $conn->connect_error);
}

?>