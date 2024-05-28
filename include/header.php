	<header class="header-section">
		<div class="header-top">
			<div class="row m-0">
				<div class="col-md-6 d-none d-md-block p-0">
					<div class="header-info">
						<i class="material-icons"></i>
						<p></p>
					</div>
					<div class="header-info">
						<i class="material-icons"></i>
						<p></p>
					</div>
				</div>
				<div class="col-md-6 text-left text-md-right p-0">
					<?php if (strlen($_SESSION['uid']) == 0) : ?>
						
					<?php else : ?>
						<div class="header-info d-none d-md-inline-flex">
							<i class="material-icons">account_circle</i>
							<a href="profile.php">
								<p>My Profile</p>
							</a>
						</div>
						<div class="header-info d-none d-md-inline-flex">
							<i class="material-icons">brightness_7</i>
							<a href="changepassword.php">
								<p>Change Password</p>
							</a>
						</div>
						<div class="header-info d-none d-md-inline-flex">
							<i class="material-icons">logout</i>
							<a href="logout.php">
								<p>Logout</p>
							</a>
						</div>

					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<a href="index.php" class="site-logo" style="color:#fff; font-weight:bold; font-size:26px;">
				GYM<br />
				<small style="margin-top:-4%;">Gym Management System</small>
			</a>

			<div class="container">
				<ul class="main-menu">
					<li><a href="index.php" class="active">Home</a></li>

					<?php if (strlen($_SESSION['uid']) == 0) : ?>
						<li><a href="admin/login.php">Admin</a></li>
					<?php else : ?>
						<li><a href="booking-history.php">Booking History</a></li>
					<?php endif;
					if (!isset($_SESSION['uid'])) {
					?>
						<li><a href="login.php">User</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</header>