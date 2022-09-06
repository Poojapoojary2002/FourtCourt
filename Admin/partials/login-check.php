<?php
//authorization -access control
//check whether user is loged or not
if(!isset($_SESSION['user']))
{
//user not loged in
//redirect to login page with msg
$_SESSION['no-login-msg']="<div class='error'>Please login to access Admin pannel</div>";
//redirect to login page
header("location:".SITEURL.'Admin/login.php');
}

?>