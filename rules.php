<?php
session_start();
require('db.php');
$car_type = mysqli_real_escape_string($con, $_REQUEST['car_type']);         
$wash_type = mysqli_real_escape_string($con, $_REQUEST['wash_type']);
$slot_time = mysqli_real_escape_string($con, $_REQUEST['slot_time']);
$date = mysqli_real_escape_string($con, $_REQUEST['date']);

$flip=true;
$sql = "SELECT id FROM car_wash WHERE date = '$date' and slot_time = '$slot_time' and id = '".$_SESSION['id']."'";
$row = mysqli_query($con,$sql);
$result = mysqli_num_rows($row);
if($result>0)
{
	$data['arr'] = 'single';
	$flip=false;
}
$sql1 = "SELECT id FROM car_wash WHERE date = '$date' and slot_time = '$slot_time'";
$row1 = mysqli_query($con,$sql1);

$result1 = mysqli_num_rows($row1);
if($result1>2)
{
	$data['arr'] = 'slots';
	$flip=false;
}
if($flip==true)
{
	$data['arr'] = 'go';
}
echo json_encode($data);
?>