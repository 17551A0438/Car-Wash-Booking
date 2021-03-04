<?php
require('db.php');
if(isset($_POST['save'])){
$car_type = mysqli_real_escape_string($con, $_REQUEST['car_type']);
$wash_type = mysqli_real_escape_string($con, $_REQUEST['wash_type']);
$price = mysqli_real_escape_string($con, $_REQUEST['price']);
$sql = "UPDATE manage_pricing SET amount='$price' WHERE car_type='$car_type' and wash_type='$wash_type'";
if(mysqli_query($con, $sql) ){
	header("Location: manage_pricing.php");
} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
echo '<a href="update_price.php">Click here to Re-set</a>';
}
}
mysqli_close($con);
?>