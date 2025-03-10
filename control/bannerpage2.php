<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner Page 2 Control Panel</title>
    <link rel="stylesheet" type="text/css" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: ../login.php');
        exit;
    }

    include "../includes/connection.php";
    include "../includes/logic.php";
    include '../includes/header.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bannerpage2_Id = $_POST['bannerpage2_Id'];
        $action = $_POST['action'];

        try {
            switch ($action) {
                case 'deactivate':
                    $deactivatequery = "UPDATE bannerpage2 SET status = 'inactive' WHERE bannerpage2_Id = :bannerpage2_Id";
                    $deactivatestmt = $conn->prepare($deactivatequery);
                    $deactivatestmt->bindParam(':bannerpage2_Id', $bannerpage2_Id, PDO::PARAM_INT);
                    $deactivatestmt->execute();
                    break;
                case 'activate':
                    $activatequery = "UPDATE bannerpage2 SET status = 'active' WHERE bannerpage2_Id = :bannerpage2_Id";
                    $activatestmt = $conn->prepare($activatequery);
                    $activatestmt->bindParam(':bannerpage2_Id', $bannerpage2_Id, PDO::PARAM_INT);
                    $activatestmt->execute();
                    break;
                case 'delete':
                    $expirequery = "UPDATE bannerpage2 SET expired = 'yes' WHERE bannerpage2_Id = :bannerpage2_Id";
                    $expirestmt = $conn->prepare($expirequery);
                    $expirestmt->bindParam(':bannerpage2_Id', $bannerpage2_Id, PDO::PARAM_INT);
                    $expirestmt->execute();
                    break;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Table

    try {
        $stmt = $conn->prepare("SELECT * FROM bannerpage2 WHERE expired <> 'yes';");
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo '<div class="app-content main-content mt-0">';
            echo '<div class="side-app">';
            echo '<div class="main-container container-fluid">';
            echo '<div class="page-header">';
            echo '<div>';
            echo '<h1 class="page-title">Control Banner Page 2</h1>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col-12 col-sm-12">';
            echo '<div class="card product-sales-main">';
            echo '<div class="card-body">';
            echo '<div class="table-responsive">';
            echo '<table id="data-table" class="table text-nowrap mb-0 table-bordered">';
            echo '<thead class="table-head">';
            echo '<table id="data-table" class="table text-nowrap mb-0 table-bordered">';
            echo '<thead class="table-head">';
            echo '<tr>';
            echo '<th class="bg-transparent border-bottom-0 wp-15">Banner Name</th>';
            echo '<th class="bg-transparent border-bottom-0 wp-15">Banner Image</th>';
            echo '<th class="bg-transparent border-bottom-0">Url</th>';
            echo '<th class="bg-transparent border-bottom-0">Start Date</th>';
            echo '<th class="bg-transparent border-bottom-0">Expiry Date</th>';
            echo '<th class="bg-transparent border-bottom-0">Status</th>';
            echo '<th class="bg-transparent border-bottom-0">Action</th>';
            echo '<th class="bg-transparent border-bottom-0 del-btn no-btn">Delete</th>';
            echo '</tr>';
            echo '</thead>';

            foreach ($result as $row) {
                echo '<tbody class="table-body">';
                echo '<tr>';
                echo '<td class="text-dark fs-14 fw-semibold">' . htmlspecialchars($row['banner_name']) . '</td>';

                echo '<td>';
                echo '<span class="data-image avatar avatar-md" style="background-image: url(' . htmlspecialchars($row['path']) . ')"></span>';
                echo '<div class="d-flex align-items-center">';
                echo '</div>';
                echo '</td>';
                echo '<td class="text-muted fs-14 fw-semibold"><a target="_blank" href="' . htmlspecialchars($row['image_url']) . '" class="text-dark">' . htmlspecialchars($row['image_url']) . '</a></td>';
                echo "<td class='text-success fs-14 fw-semibold'>" . htmlspecialchars($row['start_date']) . "</td>";
                echo "<td class='text-danger fs-14 fw-semibold'>" . htmlspecialchars($row['expiry_date']) . "</td>";
                echo "<td class='text-dark fs-14 fw-semibold'>" . htmlspecialchars($row['status']) . "</td>";
                echo "<td>
                        <form method='post' action='bannerpage2.php'>
                            <input type='hidden' name='bannerpage2_Id' value='" . htmlspecialchars($row['bannerpage2_Id']) . "' />
                            <button class='btn btn-success' type='submit' name='action' value='activate'>Activate</button>
                            <br>
                            <br>
                            <input type='hidden' name='bannerpage2_Id' value='" . htmlspecialchars($row['bannerpage2_Id']) . "' />
                            <button class='btn btn-primary' type='submit' name='action' value='deactivate'>Deactivate</button>
                        </form>
                      </td>";
                echo '<div class="d-flex align-items-stretch">';
                echo '<form method="post" action="bannerpage2.php">';
                echo "<td>
                        <form method='post' action='bannerpage2.php'>
                            <input type='hidden' name='bannerpage2_Id' value='" . htmlspecialchars($row['bannerpage2_Id']) . "' />
                            <button class='btn btn-danger' type='submit' name='action' value='delete'>Delete</button>
                        </form>
                      </td>";
                echo '</form>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
                echo '</tbody>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</section>';
        } else {
            echo '<div class="app-content main-content mt-0">';
            echo '<div class="side-app">';
            echo '<div class="main-container container-fluid">';
            echo '<div class="page-header">';
            echo '<div>';
            echo '<h1 class="page-title">No Banners Found</h1>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    include '../includes/footer.php';

    ?>

</body>

</html>