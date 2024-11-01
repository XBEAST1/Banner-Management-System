<!doctype html>
<html lang="en" dir="ltr">

<head>

	<!-- META DATA -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Noa - Bootstrap 5 Admin & Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

	<!-- FAVICON -->
	<link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />

	<!-- TITLE -->
	<title>Login</title>

	<!-- BOOTSTRAP CSS -->
	<link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

	<!-- STYLE CSS -->
	<link href="../assets/css/style.css" rel="stylesheet" />
	<link href="../assets/css/skin-modes.css" rel="stylesheet" />

	<!--- FONT-ICONS CSS -->
	<link href="../assets/css/icons.css" rel="stylesheet" />

</head>

<body class="ltr login-img">

	<?php
	session_start();
	include "includes/connection.php";

	$loginerr = '';

	if (isset($_POST['submit'])) {
		$name = $_POST['username'];
		$password = $_POST['password'];

		$hashed_password = md5($password);

		$query = "SELECT * FROM users WHERE username = :name AND password = :password";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($result) {
			$_SESSION['user_id'] = $result['user_id'];
			header('Location: index.php');
			exit;
		} else {
			$loginerr = "Invalid username or password";
		}
	}
	?>

	<!-- GLOABAL LOADER -->
	<div id="global-loader">
		<img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
	</div>
	<!-- /GLOABAL LOADER -->

	<!-- PAGE -->
	<div class="page">
		<div>
			<!-- CONTAINER OPEN -->
			<div class="container-login100">
				<div class="wrap-login100 p-0">
					<div class="card-body">
						<form action="#" method="post" class="login100-form validate-form">
							<span class="login100-form-title">
								Login
							</span>
							<div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
								<input class="input100" type="text" name="username" placeholder="Username">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="zmdi zmdi-email" aria-hidden="true"></i>
								</span>
							</div>
							<div class="wrap-input100 validate-input" data-bs-validate="Password is required">
								<input class="input100" type="password" name="password" placeholder="Password">
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="zmdi zmdi-lock" aria-hidden="true"></i>
								</span>
							</div>
							<div class="container-login100-form-btn">
								<button name="submit" type="submit" class="login100-form-btn btn-primary">
									Login
								</button>
							</div>
							<div class="container d-flex justify-content-center">
								<?php if (!empty($loginerr)) echo "<span class='mt-3 text-danger'>$loginerr</span>"; ?>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- CONTAINER CLOSED -->
		</div>
	</div>
	<!-- End PAGE -->


	<!-- BACKGROUND-IMAGE CLOSED -->

	<!-- JQUERY JS -->
	<script src="../assets/js/jquery.min.js"></script>

	<!-- BOOTSTRAP JS -->
	<script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Perfect SCROLLBAR JS-->
	<script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

	<!-- STICKY JS -->
	<script src="../assets/js/sticky.js"></script>

	<!-- COLOR THEME JS -->
	<script src="../assets/js/themeColors.js"></script>

	<!-- CUSTOM JS -->
	<script src="../assets/js/custom.js"></script>

</body>

</html>