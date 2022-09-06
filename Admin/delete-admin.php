<?php
include('../config/constant.php');
//1. get id of admin to be deleted
//2. create sql querry to delete admin
//3.redirect to manage admin page with msg
$id=$_GET['id'];
$sql="DELETE FROM tbl_admin WHERE id=$id";
$res=mysqli_query($conn,$sql);
if($res==true)
{
    //echo "Admin Deleted";
     //create a session variable to diaplay message
     $_SESSION['delete'] = "<div class='success'>Admin deleted successfully.</div>";
     //Redirecting page manage admin
     header("location:".SITEURL.'admin/manage-admin.php');

}
else{
   // echo "failed to delete";
    //create a session variable to diaplay message
    $_SESSION['delete'] = "<div class='error'>failed to delete.</div>";
    //Redirecting page manage admin
    header("location:".SITEURL.'admin/manage-admin.php');
}
?>