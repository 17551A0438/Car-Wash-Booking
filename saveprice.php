<?php
include("db.php");
$id=mysqli_real_escape_string($con,$_POST['S_P']);
$res=mysqli_query($con,"SELECT * FROM manage_pricing WHERE id='".$id."'");
while($row=mysqli_fetch_assoc($res))
{
	$data['id']=$row['id'];
	$data['amount']=$row['amount'];
}
echo json_encode($data);
?>