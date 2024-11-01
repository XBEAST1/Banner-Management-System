<?php

include "includes/connection.php";
include "includes/logic.php";

$stmt = $conn->prepare("SELECT path,image_url FROM bannerpage1 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
$stmt->execute();

$result = $stmt->fetchAll();

if ($result) {
    foreach ($result as $x) {
        echo '<a target="_blank" href="' . htmlspecialchars($x['image_url']) . '"><img src="' . htmlspecialchars($x['path']) . '" alt=""></a>';
    }
}
