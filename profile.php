<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if (strlen($_SESSION["uid"]) == 0) {
	header('location:login.php');
} else {


	if (isset($_POST['submit'])) {
		$uid = $_SESSION['uid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$address = $_POST['address'];
		$sql = "update tbluser set fname=:fname,lname=:lname,mobile=:mobile,city=:city,state=:state,address=:Address where id=:uid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fname', $fname, PDO::PARAM_STR);
		$query->bindParam(':lname', $lname, PDO::PARAM_STR);
		$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$query->bindParam(':city', $city, PDO::PARAM_STR);
		$query->bindParam(':state', $state, PDO::PARAM_STR);
		$query->bindParam(':Address', $address, PDO::PARAM_STR);
		$query->bindParam(':uid', $uid, PDO::PARAM_STR);
		$query->execute();
		//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";
		echo "<script>alert('Profile has been updated.');</script>";
		echo "<script> window.location.href =profile.php;</script>";
	}


?>
	<!DOCTYPE html>
	<html lang="zxx">

	<head>
		<title>Gym | User Profile</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Stylesheets -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/owl.carousel.min.css" />
		<link rel="stylesheet" href="css/nice-select.css" />
		<link rel="stylesheet" href="css/slicknav.min.css" />

		<!-- Main Stylesheets -->
		<link rel="stylesheet" href="css/style.css?v=2" />

		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.pricing-item .pi-top {
				height: 80px;
			}

			.singup-form input {
				border-radius: 5px;
			}

			.row {
				margin: 0;
			}

			#submit {
				width: 100%;
			}
		</style>

	</head>

	<body>
		<!-- Page Preloder -->


		<!-- Header Section -->
		<?php include 'include/header.php'; ?>
		<!-- Header Section end -->



		<!-- Page top Section -->
		<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 m-auto text-white">
						<h2>Update Profile</h2>
					</div>
				</div>
			</div>
		</section>


		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-6 col-sm-6">
					<div class="pricing-item entermediate">
						<div class="pi-top">
							<h4>Update Profile</h4>
						</div>
						<?php if ($error) { ?><div class="errorWrap" style="color:red;"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" style="color:green;"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
						<form class="singup-form contact-form" method="post">
							<div class="row">
								<?php
								$uid = $_SESSION['uid'];
								$sql = "SELECT id, fname, lname, email, mobile, password, address,state,city, create_date from tbluser where id=:uid ";
								$query = $dbh->prepare($sql);
								$query->bindParam(':uid', $uid, PDO::PARAM_STR);
								$query->execute();
								$results = $query->fetchAll(PDO::FETCH_OBJ);
								$cnt = 1;
								if ($query->rowCount() > 0) {
									foreach ($results as $result) {				?>
										<div class="col-md-12">
											<input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $result->fname; ?>">
										</div>
										<div class="col-md-12">
											<input type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $result->lname; ?>">
										</div>
										<div class="col-md-12">
											<input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $result->email; ?>" disabled>
										</div>
										<div class="col-md-12">
											<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" autocomplete="off" value="<?php echo $result->mobile; ?>">
										</div>
										<div class="col-md-12">
											<input type="text" name="state" id="state" placeholder="State" autocomplete="off" value="<?php echo $result->state; ?>">
										</div>
										<div class="col-md-12">
											<input type="text" name="city" id="city" placeholder="City" autocomplete="off" value="<?php echo $result->city; ?>">
										</div>

										<div class="col-md-12">
											<input type="text" name="address" id="address" placeholder="Address" autocomplete="off" value="<?php echo $result->address; ?>">
										</div>
										<div class="col-md-12">
											<input type="submit" id="submit" name="submit" value="Update" class="site-btn sb-gradient">

										</div>
								<?php }
								} ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<?php include 'include/footer.php'; ?>

		<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

		<script src="js/vendor/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.slicknav.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.nice-select.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.magnific-popup.min.js"></script>
		<script src="js/main.js"></script>

	</body>

	</html>
<?php } ?>

<style>
	.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #dd3d36;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}

	.succWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #5cb85c;
		color: #fff;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
	}
</style>