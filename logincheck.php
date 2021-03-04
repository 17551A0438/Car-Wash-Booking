<?php
session_start();
include('db.php');
$phone_number=mysqli_real_escape_string($con,$_POST['phone_number']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$s="SELECT * FROM register WHERE phone_number='".$phone_number."' and password='".md5($password)."'";
$res=mysqli_query($con,$s);
$data=mysqli_fetch_assoc($res);
if($data!==null)
{
    if($data['usertype']=='Admin')
    {
        $_SESSION['username']='admin';
        header("location:adminprofile.php");
    }
    else if($data['usertype']=='user')
    {
        $_SESSION['username']=$data['username'];
        $_SESSION['id']=$data['userid'];
		header("location:profile.php");
    
    }
}
?>