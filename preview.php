<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Banner View</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    include "includes/connection.php";
    include "includes/logic.php";
    include 'includes/header.php';

    echo '<div class="app-content main-content mt-0">';
    echo '<div class="side-app">';
    echo '<div class="main-container container-fluid">';
    echo '<div class="page-header">';
    echo '<div>';
    echo '<h1 class="page-title">Banner Page 1</h1>';
    echo '</div>';
    echo '</div>';


    $bannerpage1 = $conn->prepare("SELECT path,image_url FROM bannerpage1 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
    $bannerpage1->execute();
    $result = $bannerpage1->fetchAll();

    if ($result) {
        foreach ($result as $x) {
            echo '<a target="_blank" href="' . htmlspecialchars($x['image_url']) . '"><img src="' . htmlspecialchars($x['path']) . '" alt=""></a>';
        }
    } else {
        echo '<h6 style="display: flex;justify-content: center;">No Banners Found</h6>';
    }

    echo '<div class="page-header">';
    echo '<div>';
    echo '<h1 class="page-title">Banner Page 2</h1>';
    echo '</div>';
    echo '</div>';

    $bannerpage2 = $conn->prepare("SELECT path,image_url FROM bannerpage2 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
    $bannerpage2->execute();
    $bannerpage2result = $bannerpage2->fetchAll();

    if ($bannerpage2result) {
        foreach ($bannerpage2result as $x) {
            echo '<a target="_blank" href="' . htmlspecialchars($x['image_url']) . '"><img src="' . htmlspecialchars($x['path']) . '" alt=""></a>';
        }
    } else {
        echo '<h6 style="display: flex;justify-content: center;">No Banners Found</h6>';
    }

    echo '<div class="page-header">';
    echo '<div>';
    echo '<h1 class="page-title">Banner Page 3</h1>';
    echo '</div>';
    echo '</div>';


    $bannerpage3 = $conn->prepare("SELECT path,image_url FROM bannerpage3 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
    $bannerpage3->execute();
    $bannerpage3result = $bannerpage3->fetchAll();

    if ($bannerpage3result) {
        foreach ($bannerpage3result as $x) {
            echo '<a target="_blank" href="' . htmlspecialchars($x['image_url']) . '"><img src="' . htmlspecialchars($x['path']) . '" alt=""></a>';
        }
    } else {
        echo '<h6 style="display: flex;justify-content: center;">No Banners Found</h6>';
    }

    echo '</div>';
    echo '</div>';

    include 'includes/footer.php';

    ?>

</body>

</html>