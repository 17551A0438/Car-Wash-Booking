<?php 
session_start();
if(!isset($_SESSION['username'])){
	header("location:login.php");
	exit;
} 
include("header.php");
?>
<form method="post" action="slot-booking.php" >
<div class="row justify-content-center">
	<div class="col-6">
		<input type="submit" class="btn btn-success" value="Book a slot">
		<br><br>
		<h3> Bookings </h3>   
		<table class="table container table-bordered table-striped mt-3">
		<thead>
			<tr>
				<th>CarType</th>
				<th>WashType</th>
				<th>SlotTime</th>
				<th>Registration Number</th>
				<th>Date</th>
				<th>Price</th>
				<th>Status</th>
			</tr>
		</thead>
		<?php
		require('db.php');
		$result = mysqli_query($con,"SELECT manage_pricing.car_type,manage_pricing.wash_type,manage_pricing.amount,car_wash.date,car_wash.id,car_wash.status,car_wash.slot_time,car_wash.registration_number from manage_pricing join car_wash on manage_pricing.id=car_wash.wash_type_id and car_wash.id='".$_SESSION['id']."'");
		while($row = mysqli_fetch_assoc($result)){
				echo "<tbody>";
				echo "<tr>";
				echo "<td>" . $row['car_type'] . "</td>";
				echo "<td>" . $row['wash_type'] . "</td>";
				echo "<td>" . $row['slot_time'] . "</td>";
				echo "<td>" . $row['registration_number'] . "</td>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['amount'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "</tr>";
				echo "</tbody>";
		}?>
		</table>
	</div>
</div>
</form>
<?php
mysqli_close($con);
include("footer.php");
?>