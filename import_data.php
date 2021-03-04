<?php
include('db.php');
$car_type=$_POST['car_type'];
$records = mysqli_query($con, "SELECT Distinct wash_type FROM manage_pricing WHERE car_type='$car_type'"); 
$data_arr=array();
while($data = mysqli_fetch_assoc($records))
{
	array_push($data_arr,$data['wash_type']);
}
echo json_encode($data_arr);
?>