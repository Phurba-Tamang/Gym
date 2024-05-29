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
    <meta name="description" content="Vali is a responsive">

    <title>Admin | Manage Package </title>
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

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <h3>Manage Packages</h3>
              <hr />
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Category</th>
                    <th>Package Type</th>
                    <th>Package Title</th>
                    <th>Package Duration</th>
                    <th>Price</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>

                <?php

                $result = mysqli_query($con, "SELECT * FROM `tbladdpackage`");

                $cnt = 0;
                $categoryIds = array();
                $PackageTypes = array();

                while ($row = mysqli_fetch_assoc($result)) {
                  $categoryId = $row['category'];
                  $PackageTypeId = $row['PackageType'];

                  $titlename = $row['titlename'];
                  $PackageDuratiobn = $row['PackageDuratiobn'];
                  $Price = $row['Price'];

                  $categoryIds[] = $categoryId;
                  $PackageTypes[] = $PackageTypeId;


                  $sql1 = "SELECT * FROM `tblcategory` WHERE id = '$categoryId'";
                  $categoryResult = mysqli_query($con, $sql1);
                  while ($category = mysqli_fetch_assoc($categoryResult)) {
                    $categoryName = $category['category_name'];
                  }

                  $sql2 = "SELECT * FROM `tblpackage` WHERE id = '$PackageTypeId'";
                  $packageResult = mysqli_query($con, $sql2);
                  while ($package = mysqli_fetch_assoc($packageResult)) {
                    $packageType = $package['PackageName'];
                  }

                  // if ($query->rowCount() > 0) {
                  //   foreach ($results as $result) {
                ?>

                  <tbody>
                    <tr>
                      <td><?php echo $cnt + 1; ?></td>
                      <td><?php echo $categoryName; ?></td>
                      <td><?php echo $packageType; ?></td>
                      <td><?php echo  $titlename; ?></td>
                      <td><?php echo $PackageDuratiobn; ?></td>
                      <td><?php echo $Price; ?></td>

                    </tr>


                  </tbody>

                <?php $cnt = $cnt + 1;
                }
                ?>
              </table>
            </div>
          </div>
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