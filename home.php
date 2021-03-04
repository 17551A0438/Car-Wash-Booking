<?php
session_start();
?>
<html>
<head>
	<title>Home Page</title>
	<style>
		h1{
			padding:50px;
			text-align:center;
			font-size:50px;
			color:Blue;
		}
		.center {
		  display: block;
		  margin-left: auto;
		  margin-right: auto;
		  width: 50%;
		}
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Home</a>
			<div>
				<a class="btn btn-primary" href="registration.php">Sign Up</a>
				<a class="btn btn-primary" href="login.php">Login</a>
			</div>
	</nav>
	<div class="container">
		<h1>Car Wash Booking</h1>
		<img class="center" src="car_wash.png" alt="car_wash"> 
	</div>
</body>
</html>

<?php
session_destroy();
?>
