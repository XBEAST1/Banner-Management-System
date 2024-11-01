<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Banner Page 1</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    include "../includes/connection.php";
    include '../includes/header.php';

    if (isset($_POST['submit'])) {
        $startdate = $_POST['startdate'];
        $bannername = $_POST['bannername'];
        $expirydate = $_POST['expirydate'];
        $imageurl = $_POST['imageurl'];
        $currentDate = date('d-m-Y');

        $startdateerr = $expirydateerr = $imageurlerr = $bannernameerr = "";
        $isValid = true;

        if (empty($bannername)) {
            $bannernameerr = "Banner Name is required";
            $isValid = false;
        }

        if (empty($startdate)) {
            $startdateerr = "Start Date is required";
            $isValid = false;
        }

        if (empty($expirydate)) {
            $expirydateerr = "Expiry Date is required";
            $isValid = false;
        }

        if (empty($imageurl)) {
            $imageurlerr = "Image url is required";
            $isValid = false;
        }

        if ($isValid) {
            if (isset($_FILES['bannerimg']) && is_uploaded_file($_FILES['bannerimg']['tmp_name'])) {
                $file_ext = strtolower(pathinfo($_FILES['bannerimg']['name'], PATHINFO_EXTENSION));
                $allowed_file_types = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp');

                if (in_array($file_ext, $allowed_file_types)) {
                    $new_filename = time() . '.' . $file_ext;
                    $target_dir = "../uploads/";
                    $target_file = $target_dir . $new_filename;
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }
                    if (move_uploaded_file($_FILES['bannerimg']['tmp_name'], $target_file)) {
                        try {
                            $sql = "INSERT INTO bannerpage1 (banner_name, submission_date, start_date, expiry_date, path, image_url) VALUES (:bannername, :submissiondate, :startdate, :expirydate, :targetfile, :imageurl)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':bannername', $bannername);
                            $stmt->bindParam(':submissiondate', $currentDate);
                            $stmt->bindParam(':startdate', $startdate);
                            $stmt->bindParam(':expirydate', $expirydate);
                            $stmt->bindParam(':targetfile', $target_file);
                            $stmt->bindParam(':imageurl', $imageurl);
                            $stmt->execute();
                            $submitmsg = "Banner Submitted Successfully";
                        } catch (PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                    } else {
                        $submitmsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $submitmsg = "Sorry, only JPG, JPEG, PNG, GIF, BMP, and WEBP files are allowed.";
                }
            } else {
                $imageerr = "Banner Image is required";
            }
        } else {
            $fielderr = "Please fill all required fields.";
        }
    }

    ?>

    <div class="app-content main-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <div class="col-lg-12 col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header border-botto">
                            <h3 class="card-title">Add Banner Page 1</h3>
                        </div>
                        <div class="card-body">
                            <form action="/forms/bannerpage1.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3" data-validate="Banner Name is required">
                                        <input class="form-control p-3" type="text" name="bannername" placeholder="Banner Name">
                                        <span class="focus-input100"></span>
                                        <?php if (isset($bannernameerr)) echo "<span class='text-danger'>$bannernameerr</span>"; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3" data-validate="Start Date is required">
                                        <label for="datepicker-start-date">Start Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text bg-primary-transparent text-primary">
                                                <i class="fe fe-calendar text-20"></i>
                                            </div>
                                            <input class="form-control" id="datepicker-start-date" name="startdate" placeholder="DD-MM-YYYY" type="text">
                                        </div>
                                        <?php if (isset($startdateerr)) echo "<div class='text-danger'>$startdateerr</div>"; ?>
                                    </div>
                                    <div class="col-lg-6 mb-3" data-validate="Expiry Date is required">
                                        <label for="datepicker-expiry-date">Expiry Date</label>
                                        <div class="input-group">
                                            <div class="input-group-text bg-primary-transparent text-primary">
                                                <i class="fe fe-calendar text-20"></i>
                                            </div>
                                            <input class="form-control" id="datepicker-expiry-date" name="expirydate" placeholder="DD-MM-YYYY" type="text">
                                        </div>
                                        <?php if (isset($expirydateerr)) echo "<div class='text-danger'>$expirydateerr</div>"; ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3">
                                        <label for="bannerimg" class="form-label">Select Banner Image</label>
                                        <input class="form-control file-input" type="file" id="bannerimg" name="bannerimg">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-3" data-validate="Banner Name is required">
                                        <input class="form-control p-3" type="text" name="imageurl" placeholder="Image Url">
                                        <span class="focus-input100"></span>
                                        <?php if (isset($imageurlerr)) echo "<span class='text-danger'>$imageurlerr</span>"; ?>
                                    </div>
                                </div>
                                <div>
                                    <button name="submit" type="submit" class="btn btn-primary">Submit form</button>
                                    <br>
                                    <?php if (isset($fielderr)) echo "<span class='mt-3 text-danger'>$fielderr</span>"; ?>
                                    <?php if (isset($submitmsg)) echo "<span class='mt-3 text-success'>$submitmsg</span>"; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

    include '../includes/footer.php';

    ?>

</body>

</html>