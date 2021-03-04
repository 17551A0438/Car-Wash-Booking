<html>
<head>
<title>
Admin Page
</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<style>
body{
	background-image:linear-gradient(pink,yellow);
}
.admin-title{
	color:blue;
}
.admin-input,.admin-button{
	font-size:20px;
}
.link{
    position: absolute;
	top:-30px;
    right: 0px;
    padding: 30px;
	text-align:right;
	font-size:20px;
}
</style>
<?php
require('db.php');
session_start();
if (isset($_POST['username'])) {
    $username = $_REQUEST['username']; 
    $password = $_REQUEST['password'];
    $query    = "SELECT * FROM admin WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_num_rows($result);
    if($rows == 1){
        $_SESSION['username'] = $username;
        header("Location: adminprofile.php");
        }else{
			echo "<div class='form'>
                <h3>Incorrect Username/password.</h3><br/>
                <p class='link'>Click here to <a href='adminlogin.php'>Login</a> again.</p>
                </div>";
        }
    }else{
?>
<body>
<p class="link"><a href="home.php">Home</a></p>
<center>
<form class="form" method="post" name="admin">
<h1 class="admin-title">Admin</h1>
<input type="text" class="admin-input" name="username" placeholder="Username" required><br><br>
<input type="password" class="admin-input" name="password" placeholder="Password" required><br><br>
<input type="submit" value="Login" name="submit" class="admin-button"/>
</form>
</center>
</body>
<?php
    }
?>
</html>