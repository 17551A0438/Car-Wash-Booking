<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
	exit;
} 
include("header.php");
require('db.php');
$car_type = mysqli_real_escape_string($con,$_POST['car_type']);         
$wash_type = mysqli_real_escape_string($con,$_POST['wash_type']);
$slot_time = mysqli_real_escape_string($con,$_POST['slot_time']);
$reg_num = mysqli_real_escape_string($con,$_POST['reg_num']);
$date = mysqli_real_escape_string($con,$_POST['date']);

$query = "SELECT * FROM manage_pricing WHERE car_type = '$car_type' AND wash_type = '$wash_type'";
$result = mysqli_query($con, $query);
$rows = mysqli_fetch_array($result);

mysqli_close($con);
?>
<div class="container-md">
	<div class="row justify-content-center">
		<div class="col-3">
			<form method="post" action="book.php">
				
				<h3> Confirm your booking</h3><br>
				
				<label for="reg_num">Registration Number</label>
				<input  type="text" value="<?php echo $reg_num;?>" name="reg_num" class="form-control mb-2">

				<label for="car_type">Car Type</label>
				<input  type="text" value="<?php echo $car_type;?>" name="car_type" class="form-control mb-2">

				<label for="wash_type">Wash Type</label>
				<input  type="text" value="<?php echo $wash_type;?>" name="wash_type" class="form-control mb-2">

				<label for="slot_time">Slot Time</label>
				<input  type="text" value="<?php echo $slot_time;?>" name="slot_time" class="form-control mb-2">

				<label for="date">Date</label>
				<input type="date" value="<?php echo $date;?>" name="date" class="form-control mb-2">

				<label for="price">Price</label>
				<input type="text" value="<?php echo $rows['amount'];?>" disabled class="form-control mb-2">
				
				<input  type="submit" name="action" value="Cancel" class="btn btn-danger">
				<input  type="submit" name="action"  value="Confirm" class="btn btn-success">
			</form>
		</div>
	</div>
</div>
<?php include("footer.php"); ?>
