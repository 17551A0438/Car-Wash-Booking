<?php 
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
	exit;
} 
include("header.php");
require('db.php');
?>
<div class="container-md">
	<div class="row justify-content-center">
		<div class="col-3">
			<form id="myform" action="confirm.php" method="post">
				<h2> Book your slot</h2>
			<div class="mt-2">
				<label>Car Type</label>
				<select name='car_type' id="car_type" class="form-control mb-2">
					<option disabled selected>-- Select Car Type --</option>
					<?php
						$records = mysqli_query($con, "SELECT Distinct car_type FROM manage_pricing"); 
						while($data = mysqli_fetch_array($records)){
								echo "<option value='". $data['car_type'] ."'>" .$data['car_type'] ."</option>";  
							}       
					?>  
				</select>
				<span id="p2" class="invalid"></span>
			</div>
			
			<div class="mt-2">
				<label>Wash Type</label>
				<select name='wash_type' id="wash_type" class="form-control mb-2">
					<option disabled selected>-- Select Wash Type --</option>
					<?php
					// require('db.php');
					// $records = mysqli_query($con, "SELECT Distinct wash_type FROM manage_pricing"); 
					// while($data1 = mysqli_fetch_array($records)){
							// echo "<option value='". $data1['wash_type'] ."'>" .$data1['wash_type'] ."</option>";  
						// }       
					?>  
				</select>
				<span id="p3" class="invalid"></span>
			</div>
			
			<div class="mt-2">
				<label for="date">Date</label>
				<input type="text" id="date" name="date" class="form-control mb-2">
				<span id="p4" class="invalid"></span>
			</div>
			
			<div class="mt-2">
				<label for="slot_time" class="slot_time">Select Slot Time</label>
				<select id="slot_time" name="slot_time" class="form-control mb-2"> <br>
					<option value="">Time Slot</option>
					<option value="10:00-11:00">10:00-11:00</option>
					<option value="11:00-12:00">11:00-12:00</option>
					<option value="12:00-01:00">12:00-01:00</option>
					<option value="01:00-02:00">01:00-02:00</option>
					<option value="02:00-03:00">02:00-03:00</option>
					<option value="03:00-04:00">03:00-04:00</option>
					<option value="04:00-05:00">04:00-05:00</option>
					<option value="05:00-06:00">05:00-06:00</option>
				</select>
				<span id="p5" class="invalid"></span>
			</div>
			
			<div class="mt-2">
				<label for="reg_num" class="reg_num">Registration Number</label>
				<input type="text" id="reg_num" name="reg_num" placeholder="Enter Car's Registration number" class="form-control mb-2"> 
				<span id="p1" class="invalid"></span>
			</div>
			
			<div class="mt-2">
				<label for="price" class="price">Price</label>
				<input type="text" id="price" name="price" class="form-control mb-2" disabled> 
			</div>
			
				<a class="btn btn-danger" href="profile.php">Cancel</a>
				<button type="button" name="book_slot" id="book_slot" class="btn btn-primary">Book Slot</button>
				<span id="p10" class="invalid"></span>
			</form>
	</div>
</div>
</div>
<script>
$(document).ready(function(){
	$('#book_slot').click(function(){
		validateForm();
	});
	$("#date").datepicker({
		minDate:0,
		dateFormat:"yy-mm-dd"
	});
	
	$('#car_type').on('change',function(){
		$("#p2").html("");
	});
	$('#wash_type').on('change',function(){
		$("#p3").html("");
	});
	$('#date').keyup(function(){
		$("#p4").html("");
	});
	$('#slot_time').on('change',function(){
		$("#p5").html("");
	});
	$('#reg_num').keyup(function(){
		$("#p1").html("");
	});
		
	function validateForm()
	{
		var valid = true;
		var car_type = $("#car_type").val();
		var wash_type = $("#wash_type").val();
		var date = $("#date").val();
		var slot_time = $("#slot_time").val();
		var reg_num = $("#reg_num").val();
		
		if(car_type == '' || car_type == null){
			valid = false;
			$("#p2").html("*Please choose car_type");
		}
		else{
			$("#p2").html("");
		}
		if(wash_type == '' || wash_type == null){
			valid = false;
			$("#p3").html("*Please choose wash_type");
		}
		else{
			$("#p3").html("");
		}
		if(date == '' || date == null){
			valid=false;
			$("#p4").html("*Please Choose date");
		}
		else{
			$("#p4").html("");
		}
		if(slot_time == '' || slot_time == null){
			valid=false;
			$("#p5").html("*Please Choose Slot Time");
		}
		else{
			$("#p5").html("");
		}
		/*if(reg_num == '' || reg_num == null){
			valid=false;
			$("#p1").html("*Please Enter Registration Number");
		}
		else{
			$("#p1").html("");
		}*/
		
		var reg=/^([A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4})$/;
		if(!reg_num.match(reg)){
			valid = false;
			$("#p1").html("*Enter the Correct Registration Number");
		}
		else{
			$("#p1").html("");
		}
		
		if(valid){
			$.ajax({
					url: 'rules.php',
					type: 'post',
					data: {'car_type':car_type,'wash_type':wash_type,'slot_time':slot_time,'date':date},
					dataType: 'json',
					success:function(response)
					{
						console.log(response)
						if(response['arr']=='single')
						{
							valid=false;
							$("#p5").html("*Already booked");
						}	
						if(response['arr']=='slots')
						{
							$("#p5").html("*Slot filled");
						}
						if(response['arr']=='go')
						{
							$("#myform").submit();
						}
					}
			});
		}
	}
	
	$('#car_type').change(function(){
		$('#wash_type').html('<option disabled selected>-- Select Wash Type --</option>');
		var ct=$(this).val();
		$.ajax({
			url:'import_data.php',
			type:'post',
			data:{'car_type':ct},
			dataType:'json',
			success:function(response)
			{
				if(response)
				{
					for(i=0;i<response.length;i++)
					{
						$('#wash_type').append('<option value="'+response[i]+'">'+response[i]+'</option>');
					}
				}
			},
			error:function(err)
			{
				console.log(err);
			}
		});
	});
	
	$("#car_type").change(function(){
		var car_tp=$("#car_type").val();
		console.log(car_tp)
	$("#wash_type").click(function(){
		var wash_tp=$("#wash_type").val();
		console.log(wash_tp)
		$.ajax({
				url: 'fetch_price.php',
				type: 'post',
				data: {'car_type':car_tp,'wash_type':wash_tp},
				dataType: 'json',
				success:function(data)
				{
					console.log(data)
					$("#price").val(data);
					$("#price").show();
				}
			});
		});
	});
});
	
	/*$('#import_data').click(function(){
		$('#data_div').html('');
		$.ajax({
			url:'import_data.php',
			type:'post',
			data:{'car_type':'SUV'},
			dataType:'json',
			success:function(response)
			{
				if(response)
				{
					for(i=0;i<response.length;i++)
					{
						$('#data_div').append('<h2>'+response[i]+'</h2>');
					}
				}
			},
			error:function(err)
			{
				console.log(err);
			}
		});
	});*/
</script>
<?php include("footer.php"); ?>