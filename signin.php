<?php
  
     
  session_start();
  $conn = mysqli_connect('localhost','root','','food-order');
  if(!$conn){
      echo 'connection error:',mysqli_connect_error();
  }
  $UserName=$_POST['UserName'];
  //$Email_id=$_POST['Email_id'];
  $Password=$_POST['Password'];

  $sql="select * from tbl_reg where UserName='$UserName' && Password='$Password'";
 $res= mysqli_query($conn,$sql);
 $num=mysqli_num_rows($res);
  if($num == 1)
  {
    '<script>alert("successfully logged in")</script>';
   header('location:index.php');

  }
  else{
    header('location:signup.php');
  }
  ?>

