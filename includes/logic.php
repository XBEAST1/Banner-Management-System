<?php

include 'connection.php';

// Get current date
$currentDate = date('d-m-Y');


// Banner Page 1 Logic

// Expire Entry From Database

$query = "SELECT expiry_date FROM bannerpage1 WHERE expiry_date = :currentDate";
$stmt = $conn->prepare($query);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();
$expired_records = $stmt->fetchAll();

if ($expired_records) {
    foreach ($expired_records as $record) {
        $expireDate = $record['expiry_date'];
        $expirequery = "UPDATE bannerpage1 SET expired = 'yes' WHERE expiry_date = :expireDate";
        $expirestmt = $conn->prepare($expirequery);
        $expirestmt->bindParam(':expireDate', $expireDate);
        $expirestmt->execute();
    }
}



// Banner Page 3 Logic

// Expire Entry From Database

$query = "SELECT expiry_date FROM bannerpage3 WHERE expiry_date = :currentDate";
$stmt = $conn->prepare($query);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();
$expired_records = $stmt->fetchAll();

if ($expired_records) {
    foreach ($expired_records as $record) {
        $expireDate = $record['expiry_date'];
        $expirequery = "UPDATE bannerpage3 SET expired = 'yes' WHERE expiry_date = :expireDate";
        $expirestmt = $conn->prepare($expirequery);
        $expirestmt->bindParam(':expireDate', $expireDate);
        $expirestmt->execute();
    }
}



// Banner Page 2 Logic

// Expire Entry From Database

$query = "SELECT expiry_date FROM bannerpage2 WHERE expiry_date = :currentDate";
$stmt = $conn->prepare($query);
$stmt->bindParam(':currentDate', $currentDate);
$stmt->execute();
$expired_records = $stmt->fetchAll();

if ($expired_records) {
    foreach ($expired_records as $record) {
        $expireDate = $record['expiry_date'];
        $expirequery = "UPDATE bannerpage2 SET expired = 'yes' WHERE expiry_date = :expireDate";
        $expirestmt = $conn->prepare($expirequery);
        $expirestmt->bindParam(':expireDate', $expireDate);
        $expirestmt->execute();
    }
}
