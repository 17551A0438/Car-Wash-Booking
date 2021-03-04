<?php
include("db.php");
$id=mysqli_real_escape_string($con,$_POST['id']);
$price=mysqli_real_escape_string($con,$_POST['edit_price']);
mysqli_query($con,"UPDATE manage_pricing SET amount='".$price."' WHERE id='".$id."'");
$data= array('status'=>"Success");
echo json_encode($data);
?>