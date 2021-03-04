<?php
 session_start();
	if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}
include("header1.php");
require('db.php');
$sql = "SELECT * FROM manage_pricing";
$result = mysqli_query($con, $sql);
?>    
<table class="table container table-bordered table-striped mt-3">
	<thead>
			<tr> 
				<th>Car Type</th> 
				<th>Wash Type</th> 
				<th>Price</th> 
				<th>Service</th>
			</tr>
	</thead>
	<tbody>
<?php
while($row = mysqli_fetch_array($result))
{   
?>
    <tr> 
        <td><?php echo $row['car_type'];?></td>
        <td><?php echo $row['wash_type'];?></td>
        <td><?php echo $row['amount'];?></td>
		<td>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-id="<?php echo $row['id'];?>">Edit</button>
		</td>
    </tr>
<?php
}
?>
<tbody>
<div class="row justify-content-center">
	<div class="col-2">
		<a class="btn btn-primary" href="adminprofile.php">View Bookings</a>
	</div>
</div>
</table>

<div class="container" >
   <div class="modal fade" id="empModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Update Price</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form id="update_form">
						<input type="hidden" class="form-control mt-2" id="wash_id" name="id"/>
						<label>Amount</label>
						<input type="text" class="form-control mt-2" id="edit_price" name="edit_price" placeholder="Price" required />
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="update">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$(".empModal").click(function(){
		var ID = $(this).attr("data-id");
		console.log(ID);
		$.ajax({
				url: 'saveprice.php',
				type: 'post',
				data: {'S_P':ID},
				dataType: 'json',
				success:function(data)
				{
					$("#empModal").modal('show');
					$("#wash_id").val(data['id']);
					$("#edit_price").val(data['amount']);
				}
			});
	});
	$("#update").click(function(){
		var amount = $('#edit_price').val();
		if(amount=="")
		{
			$("#empModal").modal('show');
			alert("Please enter the amount")
		}
		else
		{
        $("#update_form").ajaxSubmit({
            url:'updateprice.php',
            type:'POST',
            dataType:'JSON',
            success: function(data)
                {
                    window.location.reload();
                    alert('Updated successfully');
                    $('#update').modal('hide');
                }
        })
		}
	});
});
</script>

<?php include("footer.php"); ?>
