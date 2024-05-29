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
    <meta name="description" content="Vali is a">
    <title>Admin | All Bookings</title>
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
              <h3>All Bookings</h3>
              <hr />
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>S.N.</th>
                    <th>Booking ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Booking Date</th>
                    <th>Package Name</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM `tblbooking`";
                  $result = mysqli_query($con, $sql);

                  $cnt = 0;

                  while ($row = mysqli_fetch_assoc($result)) {
                    $userId = $row['userid'];
                    $packageId = $row['package_id'];

                    // Fetch user details
                    $sql1 = "SELECT * FROM tbluser WHERE id = '$userId'";
                    $userResult = mysqli_query($con, $sql1);
                    // $user = mysqli_fetch_assoc($userResult);
                    while ($user = mysqli_fetch_assoc($userResult)) {
                      $name = $user['fname'] . " " . $user['lname'];
                      $email = $user['email'];
                    }

                    $sql2 = "SELECT * FROM tbladdpackage WHERE id = '$packageId'";
                    $packageResult = mysqli_query($con, $sql2);
                    $package = mysqli_fetch_assoc($packageResult);
                    if ($package) {
                      $packageName = $package['titlename'];
                      $price = $package['Price'];
                    } else {
                      $packageName = "Unknown";
                      $price = "Unknown";
                    }

                    if ($row['payment'] == "") {
                      $payment = "Not Paid";
                    } else {
                      $payment = "Paid";
                    }

                    if ($row['paymentType'] == "") {
                      $paymentType = "---";
                    } else {
                      $paymentType = $row['paymentType'];
                    }

                  ?>
                    <tr>
                      <td><?php echo $cnt + 1; ?></td>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo ($name); ?></td>
                      <td><?php echo ($email); ?></td>
                      <td><?php echo date("Y-m-d", strtotime($row['booking_date'])); ?></td>
                      <td><?php echo ($packageName); ?></td>
                      <td><?php echo ($price); ?></td>
                      <td>
                        <a href="booking-history-details.php?bookingid=<?php echo $row['id']; ?>"><button class="btn btn-primary" type="button">View</button></a>
                      </td>
                    </tr>
                  <?php
                    $cnt++;
                  }
                  ?>
                </tbody>
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