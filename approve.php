<?php
include("db.php");
$id=mysqli_real_escape_string($con,$_POST['S_P']);
mysqli_query($con,"UPDATE car_wash SET status='approved' WHERE id='".$id."'");
$data= array('status'=>"Success");
echo json_encode($data);
?>