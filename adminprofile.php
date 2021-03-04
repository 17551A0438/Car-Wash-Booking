<?php 
 session_start();
	if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}
	include("header1.php");
	require('db.php');
	$sql = "SELECT register.username,register.phone_number,car_wash.id,car_wash.registration_number,manage_pricing.car_type,manage_pricing.wash_type,car_wash.slot_time,car_wash.status,manage_pricing.amount as price FROM car_wash LEFT JOIN register on car_wash.id= register.userid left join manage_pricing on car_wash.wash_type_id=manage_pricing.id";
	$result = mysqli_query($con, $sql);
?>
<div class="container-md">
<table class="table container table-bordered table-striped mt-3">
<thead>
	<tr> 
		<th>Name</th>
		<th>Car Number</th> 
		<th>Car Type</th> 
		<th>Wash Type</th> 
		<th>Slot_Time</th> 
		<th>Price</th>
		<th>Status</th>
	</tr>
</thead>
<?php
while($row = mysqli_fetch_array($result))
{ 
?>
<tbody>
	<tr>
		<td>
		<?php 
			echo $row['username'];
			echo("<br>");
			echo $row['phone_number'];
		?>
		</td>
		<td><?php echo $row['registration_number'];?></td>
		<td><?php echo $row['car_type'];?></td>
		<td><?php echo $row['wash_type'];?></td>
		<td><?php echo $row['slot_time'];?></td>
		<td><?php echo $row['price'];?></td>
		<td><?php  if($row['status']=="approved")
					{ 
						echo "Approved"; 
					} 
					else if($row['status']=="rejected")
					{
						echo "Rejected";
					} else 
					{ 
						echo '<button class="btn btn-success approve" data-id='.$row['id'].' >Approve</button>
						<button class="btn btn-danger reject" data-id='.$row['id'].'>Reject</button>'; 
					} 
			?>
		</td>
	</tr> 
</tbody>     
<?php
}
?>
<body>
<form method="post" action="manage_pricing.php">
<div class="row justify-content-center">
	<div class="col-2">
		<a class="btn btn-warning" href="manage_pricing.php">Manage Pricing</a>
	</div>
</div>
</form>
<script>
$(document).ready(function(){
	$(".approve").click(function(){
		var ID = $(this).attr("data-id");
		console.log(ID);
		$.ajax({
				url: 'approve.php',
				type: 'post',
				data:{'S_P':ID},
				dataType: 'json',
				success:function(data)
				{
					alert("Approved");
					$('.reject').hide();
				}
			});
	});
	$(".reject").click(function(){
		var ID = $(this).attr("data-id");
		console.log(ID);
		$.ajax({
				url: 'reject.php',
				type: 'post',
				data:{'S_P':ID},
				dataType: 'json',
				success:function(data)
				{
					alert("Rejected");
					$('.approve').hide();
					
				}
			});
	});
});
</script>
<?php include("footer.php"); ?>
