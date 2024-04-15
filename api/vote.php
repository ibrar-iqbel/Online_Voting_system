<?php
session_start();
include('connect.php');

$votes = $_POST['gvotes'];
$total_votes = $votes +1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

//$update_votes = mysqli($connect,"UPDATE user SET votes='$total_votes' WHERE id='$gid'");
$update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$gid'");

$update_user_status = mysqli_query($connect,"UPDATE user SET STATUS=1 WHERE id='$uid' ");

if($update_votes AND $update_user_status)
{
    $group = mysqli_query($connect,"SELECT * FROM user WHERE ROLE =2");
    //$groupdata = mysqli_fetch_all($group,MYSQL_ASSOC);
    $groupdata = mysqli_fetch_all($group, MYSQLI_ASSOC);

    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupdata;

    echo '
    <script> 
    alert("Voting Successfull!");
    window.location = "../routes/dashboard.php";//error
    </script>
    ';
}
else
{
    echo '
    <script> 
    alert("Some error occured!");
    window.location = "../routes/dashboard.php";
    </script>
    ';
}

?>