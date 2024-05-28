<?php
session_start();
error_reporting(0);
require_once('include/config.php');
require_once('include/config1.php');
if (strlen($_SESSION["uid"]) == 0) {
  header('location:login.php');
} else {
  $uid = $_SESSION['uid'];


  if (isset($_POST['pay'])) {
    $method = $_POST['method'];
    $amount = $_POST['amount'];
    $bookindid = $_POST['bookindid'];

    $sql = "UPDATE `tblbooking` SET `payment` = 'done', `paymentType` = '$method', `paidAmount` = '$amount', `payment_date` = NOW() WHERE `id` = '$bookindid'";
    echo $sql;
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo "<script>alert('Payment Success');</script>";
    }
  }

?>

  <!DOCTYPE html>
  <html lang="zxx">

  <head>
    <title>User | Booking History</title>
    <meta charset="UTF-8">
    <meta name="description" content="Ahana Yoga HTML Template">
    <meta name="keywords" content="yoga, html">
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
      .custom-radio {
        display: inline-block;
        width: 150px;
        height: 70px;
        background-size: cover;
        margin-right: 40px;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 8px;
      }

      #cash {
        background-image: url('img/cash.png');
      }

      #esewa {
        background-image: url('img/esewa.png');
      }

      #khalti {
        background-image: url('img/khalti.png');
      }

      input[type="radio"] {
        display: none;
      }

      input[type="radio"]:checked+.custom-radio {
        border: 2px solid red;
      }
    </style>
  </head>

  <body>
    <?php include 'include/header.php'; ?>
    <section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 m-auto text-white">
            <h2>Booking History</h2>
          </div>
        </div>
      </div>
    </section>
    <section class="contact-page-section spad overflow-hidden">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-hover table-bordered">
              <thead>
                <?php
                $bookindid = $_GET['bookingid'];
                $sql = "SELECT t1.id as bookingid,t3.fname as Name, t3.email as email,t1.booking_date as bookingdate,t2.titlename as title,t2.PackageDuratiobn as PackageDuratiobn,
                  t2.Price as Price,t2.Description as Description,t4.category_name as category_name,t5.PackageName as PackageName,payment,paymentType FROM tblbooking as t1
                  join tbladdpackage as t2
                  on t1.package_id =t2.id
                  join tbluser as t3
                  on t1.userid=t3.id
                  join tblcategory as t4
                  on t2.category=t4.id
                  join tblpackage as t5
                  on t2.PackageType=t5.id
                  where t1.id=:bookindid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':bookindid', $bookindid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                ?>
                    <tr>
                      <th>Booking Date</th>
                      <td><?php echo $result->bookingdate; ?></td>
                      <th>Name</th>
                      <td><?php echo $result->Name; ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td><?php echo $result->email; ?></td>
                      <th>Category</th>
                      <td><?php echo $result->category_name; ?></td>
                    </tr>
                    <tr>
                      <th>Package Name:</th>
                      <td><?php echo $result->PackageName; ?></td>
                      <th>Title</th>
                      <td><?php echo $result->title; ?></td>
                    </tr>
                    <tr>
                      <th>Package Duration</th>
                      <td><?php echo $result->PackageDuratiobn; ?></td>
                      <th>Price</th>
                      <td><?php echo $result->Price; ?></td>
                      <?php $pricess = $result->Price; ?>
                    </tr>
                    <tr>
                      <th>Description</th>
                      <td colspan="3"><?php echo $result->Description; ?></td>

                    </tr>

                    <tr>
                      < <?php
                        $price = $result->Price;
                      }
                    } ?> </thead>
            </table>

            <table class="table table-hover table-bordered">
              <tr>
                <th colspan="3" style="text-align:center;font-size:20px;">Payment History</th>
              </tr>
              <tr>
                <th>Payment Method</th>
                <th>Amount Paid</th>
                <th>Payment Date</th>
              </tr>
              <?php
              global $paymentStatus;
              $sql = "SELECT * FROM `tblbooking` WHERE `id` = '$bookindid'";
              $result = mysqli_query($con, $sql);
              $num = mysqli_num_rows($result);

              while ($row = $result->fetch_assoc()) {
                $paymentStatus = $row['payment'];
                $paymentType = "Not Paid";
                $paidAmount = 0;
                $paymentDate = "---";

                if ($row['payment'] != "not done") {
                  $paymentType = $row['paymentType'];
                  $paidAmount = $row['paidAmount'];
                  $paymentDate = date("Y-m-d", strtotime($row['payment_date']));
                }
              }
              ?>
              <tr>
                <td><?php echo $paymentType; ?></td>
                <td><?php echo $paidAmount; ?></td>
                <td><?php echo $paymentDate; ?></td>
              </tr>
              <?php
              ?>
            </table>
            <?php
            if ($paymentStatus == "not done") {
            ?>
              <form action="" method="post">
                <table class="table table-hover table-bordered">
                  <tbody>
                    <tr>
                      <th colspan="3" style="text-align:center;font-size:20px;">Payment</th>
                    </tr>
                    <tr>
                      <th>
                        <input type="hidden" name="amount" id="" value="<?php echo $price; ?>">
                        <input type="hidden" name="bookindid" id="" value="<?php echo $bookindid; ?>">
                        Amount to pay: <?php echo $price; ?>
                      </th>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-group col-md-12 p-0 d-flex align-items-center justify-content-center">
                          <label>
                            <input type="radio" name="method" value="Cash">
                            <span class="custom-radio" id="cash"></span>
                          </label>
                          <label>
                            <input type="radio" name="method" value="Esewa">
                            <span class="custom-radio" id="esewa"></span>
                          </label>
                          <label>
                            <input type="radio" name="method" value="Khalti">
                            <span class="custom-radio" id="khalti"></span>
                          </label>
                          <div class="">
                            <input type="submit" id="submit" name="pay" value="Submit" class="site-btn sb-gradient">
                          </div>
                        </div>
                      </td>
                  </tbody>
                </table>
              </form>
            <?php
            }
            ?>
          </div>

        </div>
      </div>
    </section>
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
<?php } ?>


<?php
if (isset($_POST['pay'])) {
  $method = $_post['method'];
  $amount = $_post['amount'];

  echo $method;
  echo $amount;
}


?>