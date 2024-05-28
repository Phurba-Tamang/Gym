<?php session_start();
error_reporting(0);
include  'include/config1.php';
if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $query = mysqli_query($con, "DELETE FROM `tbluser` WHERE `id` = '$userId'");
        if ($query) {
            echo "<script>alert('Record deleted successfully!');</script>";
            echo "<script>window.location.href='users.php'</script>";
        }
    }



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="description" content="Vali is a">
        <title>Admin | All Users</title>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `tbluser`";
                                    $result = mysqli_query($con, $sql);

                                    $cnt = 0;

                                    while ($user = mysqli_fetch_assoc($result)) {

                                        $name = $user['fname'] . " " . $user['lname'];
                                        $email = $user['email'];
                                        $mobile = $user['mobile'];
                                        $address = $user['city'] . ", " . $user['state'];
                                        $date = date("Y-m-d", strtotime($user['create_date']));
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt + 1; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $mobile; ?></td>
                                            <td><?php echo $address; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td>
                                                <a onclick="return confirm('Do you really want to delete this record?')" href="users.php?userId=<?php echo $user['id']; ?>"><button class="btn btn-danger" type="button">Delete</button></a>
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