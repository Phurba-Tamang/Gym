<?php session_start();
error_reporting(0);
include  'include/config.php';
include  'include/config1.php';
if (strlen($_SESSION['adminid'] == 0)) {
  header('location:logout.php');
} else {
  // if (isset($_POST['editPackage'])) {
  //   $packageId = $_POST['packageId'];
  //   $AddPackage = $_POST['addPackage'];
  //   $category = $_POST['category'];

  //   if (empty($AddPackage) || empty($category)) {
  //       $errormsg = "All fields are required";
  //   } else {
  //       $sql = "UPDATE tblpackage SET PackageName = :Package, cate_id = :category WHERE id = :packageId";
  //       $query = $dbh->prepare($sql);
  //       $query->bindParam(':Package', $AddPackage, PDO::PARAM_STR);
  //       $query->bindParam(':category', $category, PDO::PARAM_STR);
  //       $query->bindParam(':packageId', $packageId, PDO::PARAM_INT);
  //       $query->execute();

  //       if ($query->rowCount() > 0) {
  //           $msg = "Package has been updated successfully!";
  //           echo "<script>window.location.href='add-package.php'</script>";
  //       } else {
  //           $errormsg = "Failed to update the package!";
  //       }
  //   }
  //   if (isset($_POST['editPackage'])) {
  //     $packageId = $_POST['packageId'];
  //     $AddPackage = $_POST['addPackage'];
  //     $category = $_POST['category'];

  //     if (empty($AddPackage) || empty($category)) {
  //         $errormsg = "All fields are required";
  //     } else {
  //         $sql = "UPDATE tblpackage SET PackageName = :Package, cate_id = :category WHERE id = :packageId";
  //         $query = $dbh->prepare($sql);
  //         $query->bindParam(':Package', $AddPackage, PDO::PARAM_STR);
  //         $query->bindParam(':category', $category, PDO::PARAM_STR);
  //         $query->bindParam(':packageId', $packageId, PDO::PARAM_INT);
  //         $query->execute();

  //         if ($query->rowCount() > 0) {
  //             $msg = "Package has been updated successfully!";
  //             echo "<script>window.location.href='add-package.php'</script>";
  //         } else {
  //             $errormsg = "Failed to update the package!";
  //         }
  // }

  // if (isset($_POST['Update'])) {

  //   $id = $_POST['id'];
  //   $category = $_POST['category'];
  //   $titlename = $_POST['titlename'];
  //   $package = $_POST['package'];
  //   $packageduratiobn = $_POST['packageduratiobn'];
  //   $Price = $_POST['Price'];
  //   $description = $_POST['description'];

  //   if (empty($category) || empty($titlename) || empty($package) || empty($packageduratiobn) || empty($Price) || empty($description)) {
  //     $errormsg = "All fields are required!";
  //   } else if (!is_valid_name($titlename)) {
  //     $errormsg = "Enter valid title name!";
  //   } else if (!is_numeric($packageduratiobn) || !is_integer((int)$packageduratiobn)) {
  //     $errormsg = "Enter valid package duration!";
  //   } else if (!is_numeric($Price) || (!is_integer((int)$Price) && !is_float((float)$Price))) {
  //     $errormsg = "Enter valid price!";
  //   } else {
  //     $conn = new mysqli("hostname", "username", "password", "database");

  //     if ($conn->connect_error) {
  //       die("Connection failed: " . $conn->connect_error);
  //     }

  //     $sql = "UPDATE tbladdpackage SET category='$category', titlename='$titlename', PackageType='$package', PackageDuratiobn='$packageduratiobn', Price='$Price', Description='$description' WHERE id=$id";

  //     if ($conn->query($sql) === TRUE) {
  //       echo "<script>alert('Package Updated Successfully!');</script>";
  //       echo "<script> window.location.href='add-post.php';</script>";
  //     } else {
  //       $errormsg = "Failed to Update Data: " . $conn->error;
  //     }

  //     $conn->close();
  //   }
  // }

  // function is_valid_name($name)
  // {
  //   // Add your validation logic here
  //   return preg_match("/^[a-zA-Z0-9 ]*$/", $name);
  // }

  if (isset($_POST['editPackage'])) {
    $packageId = intval($_GET['cid']);
    $categoryId = intval($_POST['category']);
    $packageName = $_POST['addPackage'];

    if (!empty($packageId) && !empty($categoryId) && !empty($packageName)) {
      $sql = "UPDATE tblpackage SET cate_id=:categoryId, PackageName=:packageName WHERE id=:packageId";
      $query = $dbh->prepare($sql);
      $query->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
      $query->bindParam(':packageName', $packageName, PDO::PARAM_STR);
      $query->bindParam(':packageId', $packageId, PDO::PARAM_INT);

      if ($query->execute()) {
        $msg = "Package updated successfully!";
        echo "<script>
        alert('Package updated successfully');
        window.location.href = 'add-package.php';
        </script>";
      } else {
        $errormsg = "Something went wrong. Please try again.";
      }
    } else {
      $errormsg = "All fields are required.";
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta name="description" content="Vali is a">
    <title>Admin | Edit Package Type</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
      <h3>Edit Package</h3>
      <hr />
      <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <!---Success Message--->
            <?php if ($msg) { ?>
              <div class="alert alert-success" role="alert">
                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
              </div>
            <?php } ?>

            <!---Error Message--->
            <?php if ($errormsg) { ?>
              <div class="alert alert-danger" role="alert">
                <strong>Oh snap!</strong> <?php echo htmlentities($errormsg); ?>
              </div>
            <?php } ?>
            <?php
            if ($_GET['cid']) {
              $packageId = intval($_GET['cid']);
              $sql = "SELECT tblpackage.*, tblcategory.category_name FROM tblpackage 
                 JOIN tblcategory 
                 ON tblpackage.cate_id=tblcategory.id WHERE tblpackage.id = '$packageId'";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) {
            ?>
                  <form class="row" method="post" action="">
                    <div class="form-group col-md-12">
                      <label class="control-label">Add Category</label>
                      <select class="form-control" name="category" id="category">
                        <?php
                        $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                        $stmt->execute();
                        $countriesList = $stmt->fetchAll();
                        foreach ($countriesList as $country) {
                          if ($country['category_name'] == htmlentities($result->category_name)) {
                            echo "<option value='" . $country['id'] . "' selected>" . $country['category_name'] . "</option>";
                          } else {
                            echo "<option value='" . $country['id'] . "'>" . $country['category_name'] . "</option>";
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label class="control-label">Add Package Type</label>
                      <input class="form-control" name="addPackage" id="addPackage" type="text" placeholder="Add Package Type" value="<?php echo htmlentities($result->PackageName); ?>">
                    </div>
                    <div class="form-group col-md-4 align-self-end">
                      <input type="submit" name="editPackage" id="submit" class="btn btn-primary" value=" Submit">
                    </div>
                  </form>
            <?php $cnt = $cnt + 1;
                }
              }
            } ?>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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