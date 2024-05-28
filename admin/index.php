<?php session_start();
error_reporting(0);
include  'include/config.php';
include  'include/config1.php';
if (strlen($_SESSION['adminid'] == 0)) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>Admin | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-6 col-lg-6">
          <?php
          $sql = "SELECT * FROM tblcategory;";
          $query = mysqli_query($con, $sql);
          $numCat = mysqli_num_rows($query);
          ?>
          <a href="add-category.php">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
              <div class="info">
                <h4>Listed Categories</h4>
                <p><b><?php echo $numCat; ?></b></p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <?php

          $sql = "SELECT * FROM tblpackage;";
          $query = mysqli_query($con, $sql);
          $numPackageType = mysqli_num_rows($query);
          ?>
          <a href="add-package.php">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
              <div class="info">
                <h4>Listed Package Type</h4>
                <p><b><?php echo $numPackageType; ?></b></p>
              </div>
            </div>
          </a>
        </div>


        <div class="col-md-6 col-lg-6">
          <?php
          $sql = "SELECT * FROM tbladdpackage;";
          $query = mysqli_query($con, $sql);
          $numAddPackage = mysqli_num_rows($query);
          ?>

          <a href="manage-post.php">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-file fa-3x"></i>
              <div class="info">
                <h4>Listed Packages</h4>
                <p><b><?php echo $numAddPackage; ?></b></p>
              </div>
            </div>
          </a>
        </div>


        <div class="col-md-6 col-lg-6">
          <?php
          $sql = "SELECT * FROM tblbooking;";
          $query = mysqli_query($con, $sql);
          $numAddPackage = mysqli_num_rows($query);
          ?>
          <a href="booking-history.php">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Total Bookings</h4>
                <p><b><?php echo $numAddPackage; ?></b></p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-6">
          <?php
          $sql = "SELECT count(id) as totalbookings FROM tblbooking where  paymentType is null or paymentType=''";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          foreach ($results as $result) {
          ?>
            <a href="new-bookings.php">
              <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                <div class="info">
                  <h4>New Bookings</h4>
                  <p><b><?php echo $result->totalbookings; ?></b></p>
                </div>
              </div>
            </a>
          <?php  } ?>
        </div>

        <div class="col-md-6 col-lg-6">
          <?php
          $sql = "SELECT * FROM tbluser;";
          $query = mysqli_query($con, $sql);
          $numUser = mysqli_num_rows($query);
          ?>
          <a href="users.php">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
              <div class="info">
                <h4>Total Users</h4>
                <p><b><?php echo $numUser; ?></b></p>
              </div>
            </div>
          </a>
        </div>
      </div>

    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $('#sampleTable').DataTable();
    </script>

  </body>

  </html>
<?php } ?>