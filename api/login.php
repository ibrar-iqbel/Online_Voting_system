<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'");

if(mysqli_num_rows($check) > 0) {
  $userdata = mysqli_fetch_array($check);
  $groupdata = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
  $groupdata = mysqli_fetch_all($groupdata, MYSQLI_ASSOC);

  $_SESSION['userdata'] = $userdata;
  $_SESSION['groupdata'] = $groupdata;

  echo '
  <script> 
  alert("Invalid Credentials or user not found!");
  window.location = "../";
  </script>
  ';
} else {
    echo '
    <script> 
    window.location = "../routes/dashboard.php";
    </script>
    ';
}
?>
