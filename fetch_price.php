<?php
include('db.php');
$car_type = $_POST['car_type'];
$wash_type = $_POST['wash_type'];

$sql = mysqli_query($con,"SELECT * FROM manage_pricing WHERE car_type='$car_type' AND wash_type='$wash_type'");
$result = mysqli_fetch_assoc($sql);

$am=$result['amount'];

echo json_encode($am);
?>