<?php 
session_start();
error_reporting(0);
include 'include/config.php';
include 'include/config1.php';

$sql = "SELECT * FROM `tblbooking`";
$result = mysqli_query($con, $sql);

$userIds = array();
$packageIds = array();
$cnt = 0;

while ($row = mysqli_fetch_assoc($result)) {
  $userId = $row['userid'];
  $packageId = $row['package_id'];

  $userIds[] = $userId;
  $packageIds[] = $packageId;

  $sql1 = "SELECT * FROM tbluser WHERE id = '$userId'";
  $userResult = mysqli_query($con, $sql1);
  while ($user = mysqli_fetch_assoc($userResult)) {
    $name = $user['fname'] . " " . $user['lname'];
    $email = $user['email'];
  }

  $sql2 = "SELECT * FROM tbladdpackage WHERE id = '$packageId'";
  $packageResult = mysqli_query($con, $sql2);
  while ($package = mysqli_fetch_assoc($packageResult)) {
    $packageName = $package['titlename'];
    $price = $package['Price'];
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

  echo "<pre/>";
  print_r($row);

  echo "<pre/>";
  print_r($userIds);

  echo "<pre/>";
  print_r($packageIds);

  $cnt++;
}
