<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
	exit;
} 
include("header.php");
require('db.php');
session_start();
$action = mysqli_real_escape_string($con, $_REQUEST['action']);
$car_type = mysqli_real_escape_string($con, $_REQUEST['car_type']);         
$wash_type = mysqli_real_escape_string($con, $_REQUEST['wash_type']);
$slot_time = mysqli_real_escape_string($con, $_REQUEST['slot_time']);
$reg_num = mysqli_real_escape_string($con, $_REQUEST['reg_num']);
$date = mysqli_real_escape_string($con, $_REQUEST['date']);
if ($_POST['action'] == 'Cancel') {
    header ("Location:slot-booking.php");
} else if ($_POST['action'] == 'Confirm') {
	$sql1 = "SELECT * FROM manage_pricing WHERE car_type='$car_type' AND wash_type='$wash_type'";  
    $result1 = mysqli_query($con, $sql1);
    $row = mysqli_fetch_array($result1);
	$sql = "INSERT INTO car_wash (id,wash_type_id,slot_time,registration_number,date) VALUES ('".$_SESSION['id']."','".$row['id']."','$slot_time','$reg_num','$date')";
}
if(mysqli_query($con, $sql) ){
    header("Location: profile.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
        echo '<a href="confirm.php">Click here to Re-set</a>';
}
?>