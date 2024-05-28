<?php
error_reporting(0);
require_once('include/config.php');

if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$Password = $_POST['password'];
	$pass = md5($Password);
	$RepeatPassword = $_POST['RepeatPassword'];

	// Email id Already Exit

	$usermatch = $dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
	$usermatch->execute(array(':usreml' => $email, ':mblenmbr' => $mobile));
	while ($row = $usermatch->fetch(PDO::FETCH_ASSOC)) {
		$usrdbeml = $row['email'];
		$usrdbmble = $row['mobile'];
	}


	if (empty($fname)) {
		$nameerror = "Please Enter First Name";
	} else if (empty($mobile)) {
		$mobileerror = "Please Enter Mobile No";
	} else if (empty($email)) {
		$emailerror = "Please Enter Email";
	} else if ($email == $usrdbeml || $mobile == $usrdbmble) {
		$error = "Email Id or Mobile Number Already Exists!";
	} else if ($Password == "" || $RepeatPassword == "") {

		$error = "Password And Confirm Password Not Empty!";
	} else if ($_POST['password'] != $_POST['RepeatPassword']) {

		$error = "Password And Confirm Password Not Matched";
	} else {
		$sql = "INSERT INTO tbluser (fname,lname,email,mobile,state,city,password) Values(:fname,:lname,:email,:mobile,:state,:city,:Password)";

		$query = $dbh->prepare($sql);
		$query->bindParam(':fname', $fname, PDO::PARAM_STR);
		$query->bindParam(':lname', $lname, PDO::PARAM_STR);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$query->bindParam(':state', $state, PDO::PARAM_STR);
		$query->bindParam(':city', $city, PDO::PARAM_STR);
		$query->bindParam(':Password', $pass, PDO::PARAM_STR);

		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId > 0) {
			echo "<script>alert('Registration successfull. Please login');</script>";
			echo "<script> window.location.href='login.php';</script>";
		} else {
			$error = "Registration Not successfully";
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Main CSS-->
	<link rel="stylesheet" type="text/css" href="admin/css/main.css?v=2">
	<!-- Font-icon css-->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>GYM MS | Admin login</title>
	<style>
		.login-content .login-box {
			position: relative;
			min-width: 500px;
			min-height: 650px;
			margin-bottom: 30px;
		}
	</style>
</head>

<body>
	<section class="material-half-bg">
		<div class="cover"></div>
	</section>
	<section class="login-content">
		<div class="logo">
			<h1>GYM | User Registration</h1>
		</div>
		<div class="login-box">
			<form class="login-form" method="post">
				<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN UP</h3>
				<?php if ($error) { ?><div class="errorWrap" style="color:red;"><strong>ERROR</strong> : <?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" style="color:red;"><strong>ERROR</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
				<div class="form-group">
					<input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $fname; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name" autocomplete="off" value="<?php echo $lname; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $email; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="mobile" id="mobile" maxlength="10" placeholder="Mobile Number" autocomplete="off" value="<?php echo $mobile; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="state" id="state" placeholder="Your State" autocomplete="off" value="<?php echo $state; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="city" id="city" placeholder="Your City" autocomplete="off" value="<?php echo $city; ?>" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" id="password" placeholder="Password" autocomplete="off">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="RepeatPassword" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required>
				</div>

				<div class="form-group btn-container">

					<input type="submit" name="submit" id="submit" value="SIGN UP" class="btn btn-primary btn-block">
				</div>
				<hr />
				<p class="semibold-text mb-0">Already have an account?<a href="login.php" data-toggle="flip"> Login</a></p>
			</form>

		</div>
	</section>
	<!-- Essential javascripts for application to work-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<!-- The javascript plugin to display page loading on top-->
	<script src="js/plugins/pace.min.js"></script>
	<script type="text/javascript">
		// Login Page Flipbox control
		$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
	</script>
</body>

</html>