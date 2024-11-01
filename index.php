<?php

session_start();

if (!isset($_SESSION['user_id'])) {
	header('Location: login.php');
	exit;
}

include 'includes/header.php';
include 'includes/connection.php';
include 'includes/logic.php';


// Queries

$stmt = $conn->prepare("SELECT * FROM bannerpage1 UNION ALL SELECT * FROM bannerpage2 UNION ALL SELECT * FROM bannerpage3 ORDER BY submission_date DESC;");
$stmt->execute();
$result = $stmt->fetchAll();

$stmtexpiry = $conn->prepare("SELECT * FROM (SELECT *, 'bannerpage1' as source_table FROM bannerpage1 UNION ALL SELECT *, 'bannerpage2' as source_table FROM bannerpage2 UNION ALL SELECT *, 'bannerpage3' as source_table FROM bannerpage3) AS combined_table ORDER BY expiry_date ASC;");
$stmtexpiry->execute();
$resultexpiry = $stmtexpiry->fetchAll();

$bannerpage1 = $conn->prepare("SELECT * FROM bannerpage1 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
$bannerpage1->execute();
$bannerpage1result = $bannerpage1->fetchAll();

$bannerpage2 = $conn->prepare("SELECT * FROM bannerpage2 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
$bannerpage2->execute();
$bannerpage2result = $bannerpage2->fetchAll();

$bannerpage3 = $conn->prepare("SELECT * FROM bannerpage3 WHERE status != 'inactive' AND expired != 'yes' ORDER BY STR_TO_DATE(start_date, '%d-%m-%Y') ASC LIMIT 1");
$bannerpage3->execute();
$bannerpage3result = $bannerpage3->fetchAll();

$countactivestmt = $conn->prepare("SELECT COUNT(*) AS banner_count FROM ( SELECT * FROM bannerpage1 UNION ALL SELECT * FROM bannerpage2 UNION ALL SELECT * FROM bannerpage3) AS combined_banners WHERE status = 'active' AND expired = 'no';");
$countactivestmt->execute();
$countactiveresult = $countactivestmt->fetchAll();

$countinactivestmt = $conn->prepare("SELECT COUNT(*) AS banner_count FROM ( SELECT * FROM bannerpage1 UNION ALL SELECT * FROM bannerpage2 UNION ALL SELECT * FROM bannerpage3) AS combined_banners WHERE status = 'inactive';");
$countinactivestmt->execute();
$countinactiveresult = $countinactivestmt->fetchAll();

$countexpiredstmt = $conn->prepare("SELECT COUNT(*) AS banner_count FROM ( SELECT * FROM bannerpage1 UNION ALL SELECT * FROM bannerpage2 UNION ALL SELECT * FROM bannerpage3) AS combined_banners WHERE expired = 'yes';");
$countexpiredstmt->execute();
$countexpiredresult = $countexpiredstmt->fetchAll();

$counttotalstmt = $conn->prepare("SELECT COUNT(*) AS banner_count FROM ( SELECT * FROM bannerpage1 UNION ALL SELECT * FROM bannerpage2 UNION ALL SELECT * FROM bannerpage3) AS combined_banners;");
$counttotalstmt->execute();
$counttotalresult = $counttotalstmt->fetchAll();

?>

<div class="container-fluid">


	<div class="app-content main-content mt-0">
		<div class="side-app">
			<div class="main-container container-fluid">
				<div class="page-header">
					<div>
						<h1 class="page-title">Dashboard</h1>
					</div>
				</div>
			</div>
		</div>

		<!-- ROW-1 -->
		<div class="row">
			<div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
				<div class="card overflow-hidden">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<?php
								if ($countactiveresult) {
									foreach ($countactiveresult as $l) {
										echo '<h3 class="mb-2 fw-semibold">' . htmlspecialchars($l['banner_count']) . "</h3>";
									}
								}
								?>
								<p class="text-muted fs-13 mb-0">Active Banners</p>
							</div>
							<div class="col col-auto top-icn dash">
								<div class="counter-icon bg-primary dash ms-auto box-shadow-primary">
									<svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
										<path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
				<div class="card overflow-hidden">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<?php
								if ($countinactiveresult) {
									foreach ($countinactiveresult as $m) {
										echo '<h3 class="mb-2 fw-semibold">' . htmlspecialchars($m['banner_count']) . "</h3>";
									}
								}
								?>
								<p class="text-muted fs-13 mb-0">Inactive Banners</p>
							</div>
							<div class="col col-auto top-icn dash">
								<div class="counter-icon bg-inactive dash ms-auto box-shadow-inactive">
									<svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
										<path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
				<div class="card overflow-hidden">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<?php
								if ($countexpiredresult) {
									foreach ($countexpiredresult as $o) {
										echo '<h3 class="mb-2 fw-semibold">' . htmlspecialchars($o['banner_count']) . "</h3>";
									}
								}
								?>
								<p class="text-muted fs-13 mb-0">Expired Banners</p>
							</div>
							<div class="col col-auto top-icn dash">
								<div class="counter-icon bg-expired dash ms-auto box-shadow-expired">
									<svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
										<path d="M12,8c-2.2091675,0-4,1.7908325-4,4s1.7908325,4,4,4c2.208252-0.0021973,3.9978027-1.791748,4-4C16,9.7908325,14.2091675,8,12,8z M12,15c-1.6568604,0-3-1.3431396-3-3s1.3431396-3,3-3c1.6561279,0.0018311,2.9981689,1.3438721,3,3C15,13.6568604,13.6568604,15,12,15z M21.960022,11.8046875C19.9189453,6.9902344,16.1025391,4,12,4s-7.9189453,2.9902344-9.960022,7.8046875c-0.0537109,0.1246948-0.0537109,0.2659302,0,0.390625C4.0810547,17.0097656,7.8974609,20,12,20s7.9190063-2.9902344,9.960022-7.8046875C22.0137329,12.0706177,22.0137329,11.9293823,21.960022,11.8046875z M12,19c-3.6396484,0-7.0556641-2.6767578-8.9550781-7C4.9443359,7.6767578,8.3603516,5,12,5s7.0556641,2.6767578,8.9550781,7C19.0556641,16.3232422,15.6396484,19,12,19z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
				<div class="card overflow-hidden">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<?php
								if ($counttotalresult) {
									foreach ($counttotalresult as $n) {
										echo '<h3 class="mb-2 fw-semibold">' . htmlspecialchars($n['banner_count']) . "</h3>";
									}
								}
								?>
								<p class="text-muted fs-13 mb-0">Total Banners</p>
							</div>
							<div class="col col-auto top-icn dash">
								<div class="counter-icon bg-info dash ms-auto box-shadow-info">
									<svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24">
										<path d="M7.5,12C7.223877,12,7,12.223877,7,12.5v5.0005493C7.0001831,17.7765503,7.223999,18.0001831,7.5,18h0.0006104C7.7765503,17.9998169,8.0001831,17.776001,8,17.5v-5C8,12.223877,7.776123,12,7.5,12z M19,2H5C3.3438721,2.0018311,2.0018311,3.3438721,2,5v14c0.0018311,1.6561279,1.3438721,2.9981689,3,3h14c1.6561279-0.0018311,2.9981689-1.3438721,3-3V5C21.9981689,3.3438721,20.6561279,2.0018311,19,2z M21,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h14c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z M12,6c-0.276123,0-0.5,0.223877-0.5,0.5v11.0005493C11.5001831,17.7765503,11.723999,18.0001831,12,18h0.0006104c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-11C12.5,6.223877,12.276123,6,12,6z M16.5,10c-0.276123,0-0.5,0.223877-0.5,0.5v7.0005493C16.0001831,17.7765503,16.223999,18.0001831,16.5,18h0.0006104C16.7765503,17.9998169,17.0001831,17.776001,17,17.5v-7C17,10.223877,16.776123,10,16.5,10z" />
									</svg>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ROW-1 END-->

		<!-- ROW-2 -->
		<div class="row">
			<div class="col-xl-4 col-md-12">
				<div class="card">
					<div class="card-header border-bottom">
						<h4 class="card-title fw-semibold">Banners History Log</h4>
					</div>
					<div class="card-body pb-0 scrollable-div">

						<?php

						if ($result) {
							foreach ($result as $x) {
								echo '<ul class="mb-2">
								<li style="display: inline-block;">
									<img src="' . htmlspecialchars($x['path']) . '" alt="" style="vertical-align: middle; max-width: 100px;">
									<div style="display: inline-block; vertical-align: middle; margin-left: 10px;">
										<p class="fw-semibold mb-1 fs-13">Name: ' . htmlspecialchars($x['banner_name']) . '</p>
										<p class="text-info2 mb-1 fs-12">Submission Date: ' . htmlspecialchars($x['submission_date']) . '</p>
										<p class="text-muted fs-12">Url: ' . htmlspecialchars($x['image_url']) . '</p>
									</div>
								</li>
							</ul>';
							}
						} else {
							echo '<h6 style="display: flex;justify-content: center;margin-bottom: 20px;">No Banners Found</h6>';
						}

						?>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-12">
				<div class="card">
					<div class="card-header border-bottom">
						<h4 class="card-title fw-semibold">Near To Expire</h4>
					</div>
					<div class="card-body pb-0 scrollable-div">
						<?php

						if ($resultexpiry) {
							foreach ($resultexpiry as $d) {
								echo '<ul class="mb-2">
							<li style="display: inline-block;">
								<img src="' . htmlspecialchars($d['path']) . '" alt="" style="vertical-align: middle; max-width: 100px;">
								<div style="display: inline-block; vertical-align: middle; margin-left: 10px;">
									<p class="fw-semibold mb-1 fs-13">Name: ' . htmlspecialchars($d['banner_name']) . '</p>
									<p class="fw-semibold text-danger fs-12">Expiry Date: ' . htmlspecialchars($d['expiry_date']) . '</p>
								</div>
							</li>
						</ul>';
							}
						} else {
							echo '<h6 style="display: flex;justify-content: center;margin-bottom: 20px;">No Banners Found</h6>';
						}
						?>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-md-12">
				<div class="card">
					<div class="card-header border-bottom">
						<h4 class="card-title fw-semibold">Active Banners On Pages</h4>
					</div>
					<div class="card-body pb-0 scrollable-div">
						<?php

						$hasBanners = false;

						if ($bannerpage1result) {
							$hasBanners = true;
							foreach ($bannerpage1result as $i) {
								echo '<ul class="mb-2">
							<li style="display: inline-block;">
								<img src="' . htmlspecialchars($i['path']) . '" alt="" style="vertical-align: middle; max-width: 100px;">
								<div style="display: inline-block; vertical-align: middle; margin-left: 10px;">
									<p class="fw-semibold mb-1 fs-13">Name: ' . htmlspecialchars($i['banner_name']) . '</p>
									<p class="fw-semibold text-primary fs-12">Page: Banner Page 1</p>
								</div>
							</li>
						</ul>';
							}
						}
						if ($bannerpage2result) {
							$hasBanners = true;
							foreach ($bannerpage2result as $j) {
								echo '<ul class="mb-2">
							<li style="display: inline-block;">
								<img src="' . htmlspecialchars($j['path']) . '" alt="" style="vertical-align: middle; max-width: 100px;">
								<div style="display: inline-block; vertical-align: middle; margin-left: 10px;">
									<p class="fw-semibold mb-1 fs-13">Name: ' . htmlspecialchars($j['banner_name']) . '</p>
									<p class="fw-semibold text-primary fs-12">Page: Banner Page 2</p>
								</div>
							</li>
						</ul>';
							}
						}
						if ($bannerpage3result) {
							$hasBanners = true;
							foreach ($bannerpage3result as $k) {
								echo '<ul class="mb-2">
							<li style="display: inline-block;">
								<img src="' . htmlspecialchars($k['path']) . '" alt="" style="vertical-align: middle; max-width: 100px;">
								<div style="display: inline-block; vertical-align: middle; margin-left: 10px;">
									<p class="fw-semibold mb-1 fs-13">Name: ' . htmlspecialchars($k['banner_name']) . '</p>
									<p class="fw-semibold text-primary fs-12">Page: Banner Page 3</p>
								</div>
							</li>
						</ul>';
							}
						}

						if (!$hasBanners) {
							echo '<h6 style="display: flex;justify-content: center;margin-bottom: 20px;">No Banners Found</h6>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ROW-2 END -->

<?php include 'includes/footer.php'; ?>