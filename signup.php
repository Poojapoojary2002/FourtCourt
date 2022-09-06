<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "food-order";


$conn = mysqli_connect($servername,$username,$password,$database_name);
//now check the connection

if(!$conn)
{
	die("connection failed:" . mysqli_connect_error());
}

if(isset($_POST['REGISTER']))
{
	
	
	$username = $_POST['UserName'];
    $email = $_POST['Email_id'];
	$Password=$_POST['Password'];
	
	$sql_query ="INSERT INTO `tbl_reg`(`UserName`, `Email_id`, `Password`) VALUES ('$username','$email','$Password')";
	if(mysqli_query($conn,$sql_query))
	{
	echo "New Details entry inserted successfully !";
    header('location:signin.php');
	}
	else
	{
		echo "Error: " . $sql_query . "" . mysqli_error($conn);
	}
	mysqli_close($conn);
}

?>