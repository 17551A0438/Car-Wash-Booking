<?php
include('db.php');
$phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$sql = mysqli_query($con,"SELECT * FROM register WHERE phone_number='$phone_number' and username = '$username'");
$row = mysqli_num_rows($sql);
if($row==1){
	$data['arr']= 1;
}
else{
	$data['arr']= 0;
	$query    = "INSERT into register (username, password, email,phone_number) VALUES ('$username', '" . md5($password) . "', '$email','$phone_number')";
	$result   = mysqli_query($con, $query);
}
echo json_encode($data);
?>