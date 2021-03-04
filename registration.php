<html>
<head>
	<title>Registration</title>
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
	<a class="navbar-brand p-2" href="#">Registration</a>
	<div>
		<a class="btn btn-primary" href="home.php">Home</a>
		<a class="btn btn-primary" href="login.php">Login</a>
	</div>
</nav>
<div class="row justify-content-center">
	<div class="col-2">
		<form name="myform" id="myForm" action="" method="post" onsubmit = "return true">
			<h1 class="login-title">Registration</h1>
			<br>
				<div class="col-md-14">
					<input type="text" class="form-control" id="username" name="username" placeholder="Username"/>
						<span id="p1" class="invalid"></span>
					</div>
					<br>
					<div class="col-md-14">
						<input type="text" class="form-control" id="email" name="email" placeholder="Email"/>
						<span id="p2" class="invalid"></span>
					</div>
					<br>
					<div class="col-md-14">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
						<span id="p3" class="invalid"></span>
					</div>
					<br>
					<div class="col-md-14">
						<input type="text" maxlength="10" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" />
						<span id="p4" class="invalid"></span>
					</div>
			        <br>
					<div class="col-10">
						<button class="btn btn-primary" type="button" name="save" id="save">Register</button>
						<p>Already have an account? <a href="login.php">Login here</a></p>
					</div>
				</div>
		</form>	
	</div>
</div>
<script>
$(document).ready(function(){
	$('#save').click(function(){
		validateForm();
	});
	$('#username').keyup(function(){
		$("#p1").html("");
	});
	$('#email').keyup(function(){
		$("#p2").html("");
	});
	$('#password').keyup(function(){
		$("#p3").html("");
	});
	$('#phone_number').keyup(function(){
		$("#p4").html("");
	});
	
	function validateForm()
	{
		var valid = true;
		var username = $("#username").val();
		var email = $("#email").val();
		var password = $("#password").val();
		var phone_number = $("#phone_number").val();
		
		if(username == '' || username == null){
			valid = false;
			$("#p1").html("*Please enter username");
		}
		else{
			$("#p1").html("");
		}
		/*if(email == '' || email == null){
			valid = false;
			$("#p2").html("*Please enter email");
		}
		else{
			$("#p2").html("");
		}*/
		
		var reg=/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+.[a-z]$/;
		if(!email.match(reg)){
			valid = false;
			$("#p2").html("*Enter the Correct Email Address");
		}
		else{
			$("#p2").html("");
		}
		
		if(password.length < 5){
			valid = false;
			$("#p3").html("*Password must be 5 letters");
		}
		else{
			$("#p3").html("");
		}
		if(phone_number == '' || phone_number == null){
			valid = false;
			$("#p4").html("*Please enter phone_number");
		}
		else{
			$("#p4").html("");
		}
		if(valid==true){
			$.ajax({
					url: 'registermatch.php',
					type: 'post',
					data: {'phone_number':phone_number,'username':username,'password':password,'email':email},
					dataType: 'json',
					success:function(response)
					{
						if(response.arr==1)
						{
							valid=false;
							$("#p4").html("*Phone Number Already exit");
						}	
						else if(response.arr==0)
						{
							$("#myForm").submit();
							alert("Registration Successful");
							window.location.href = 'login.php';
						}
					}
			});
		}
	}
});
</script>
</body>
</html>