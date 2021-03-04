<?php
require('db.php');
$phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$sql = mysqli_query($con,"SELECT * FROM register WHERE phone_number='$phone_number'");
$row = mysqli_num_rows($sql);
if($row==1){
    $result= mysqli_fetch_array($sql);
	
    if ($result["password"]== md5($password))
    {
        $data['arr']=0;
    }
    else{
        $data['arr']=1;
    }
}
else 
{
    $data['arr']=2;
    
}
echo json_encode($data);
?>