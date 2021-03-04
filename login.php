<html>
<head>
    <title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
<style>
	.link{
		position: absolute;
		top:-30px;
		right: 0px;
		padding: 30px;
		text-align:right;
		font-size:20px;
	}
	.login-title{
		padding-left:12px;
	}
	.invalid{
		color:red;
	}
</style>
</head>
<body>
<p class="link"><a href="home.php">Home</a></p>
<nav class="navbar navbar-dark bg-dark">
	<a class="navbar-brand p-2" href="#">Login</a>
	<div>
		<a class="btn btn-primary" href="home.php">Home</a>
		<a class="btn btn-primary" href="registration.php">Sign Up</a>
		
	</div>
</nav>
<div class="row justify-content-center">
	<div class="col-3">
		<form name="myform" id="myform" action="logincheck.php" method="post" onsubmit="return true">
			<h1 class="login-title">Login</h1>
				<div class="col-md-10">
					<input type="text" maxlength="10" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number"/>
					<span id="p5" class="invalid"></span>
				</div>
				<br>
				<div class="col-md-10">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
					<span id="p6" class="invalid"></span>
				</div>
				<br>
				<div class="col-10">
					<button class="btn btn-primary" type="button" name="save" id="save">Login</button>
					<span id="p7" class="invalid"></span>
					<br>
					<p>Don't have an account? <a href="registration.php">Registration Now</a></p>
				</div>
		</form>		
	</div>
</div>
<script>
$(document).ready(function(){
	$('#save').click(function(){
		validateForm();
	});
	$('#phone_number').keyup(function(){
		$("#p5").html("");
	});
	$('#password').keyup(function(){
		$("#p6").html("");
	});
	function validateForm()
	{
		var valid = true;
		var phone_number = $("#phone_number").val();
		var password = $("#password").val();
		
		if(phone_number == '' || phone_number == null){
			valid = false;
			$("#p5").html("*Please enter phone_number");
		}
		else{
			$("#p5").html("");
		}
		
		if(password == '' || password == null){
			valid = false;
			$("#p6").html("*Please enter password");
		}
		else{
			$("#p6").html("");
		}
		if(valid==true){
			$.ajax({
			url: 'loginmatch.php',
			type: 'post',
			data: {'phone_number':phone_number,'password':password},
			dataType: 'json',
			success:function(data)
			{
				if(data.arr==1)
				{
				valid=false;
				$("#p6").html("*Wrong Password");
				}
				else if(data.arr==2)
				{
				valid=false;
				$("#p7").html("*User not register");
				
				}
				else if(data.arr==0){
					$("#myform").submit();
				}
			}
		});
		}
	}
});

//function logincheck(){
	//var phone_number=document.myform.phone_number.value;  
    //var password=document.myform.password.value;
	//if (phone_number==""){
		//alert("Enter the Username");  
		//return false;	
	//}
	//if (password==""){
		//alert("Enter the password");  
		//return false;	
	//}
//}
</script>
</body>
</html>