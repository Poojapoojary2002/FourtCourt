<?php
//include constant file
include('../config/constant.php');
//echo "delete food page";

if(isset($_GET['Id']) && isset($_GET['Image_Name']))
{
    //process to delete
    //1.get id and image name
    $Id=$_GET['Id'];
    $Image_Name=$_GET['Image_Name'];


    //2.remove the image if available
    //check whether imsge is available or not and delete if available
    if($Image_Name!=="")
    {
        //it  has image need to remove from folder
        //get the image path
        $path="../images/category/".$Image_Name;
        //remove the image file from folder
        $remove=unlink($path);
        //check whether image is removed or not
        if($remove==false)
        {
            //set the session msg failed to remove msg
      
            $_SESSION['upload'] = "<div class='error'>failed to remove image</div>";
     
     
            //redirect to manage food page
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process
            die();
        }
    }
    //3. delete the food from database

    //delete data from database
    //sql querry to delete data from database
    $sql="DELETE FROM `tbl_food` WHERE Id=$Id";
//execute the querry
$res=mysqli_query($conn,$sql);
//check whether data is delete from database or not

    //4.redirect to manage food eith seesion msg
if($res==true)
{

//set sucess msg and redirect
$_SESSION['delete']="<div class='success'>food deleted successfully</div>";
//redirect to manage category
header('location:'.SITEURL.'admin/manage-food.php');

}
else {
    //set fail msg and redirect
    $_SESSION['delete']="<div class='error'>failed to  deleted food</div>";
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-food.php');
}

}
else {
    //redirect to manage food page
    $_SESSION['unauthorize']="<div class='error'>Unauthorized Access</div>";
    
    header('location:'.SITEURL.'admin/manage-food.php');
    
}
?>