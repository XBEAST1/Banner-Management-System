<?php

$servername = "127.0.0.1";
$username = "root";
$password = "beastofx321";
$dbname = "bannerimg";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connected successfully";
} catch (PDOException $e) {
    // echo "Database Connection failed: " . $e->getMessage();
}

?>