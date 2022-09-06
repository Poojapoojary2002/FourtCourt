<?php
//include constant file
include('../config/constant.php');

//echo "Delete Page";
//check whether id and image_name value is set or not
if(isset($_GET['Id'])AND isset($_GET['Image_Name']))
{
    //get the value and delete
    //echo "get value and delete";
    $Id=$_GET['Id'];
    $Image_Name=$_GET['Image_Name'];

    //remove the physical image file if available 

    if($Image_Name!=="")
    {


        //image is available .so remove image
        $path="../images/category/".$Image_Name;
        //remove the image
        $remove=unlink($path);
        //if failed to remove img the add an error msg and stop the process
        if($remove==false)
        {
            //set the session msg
      
            $_SESSION['remove'] = "<div class='error'>failed to delete category image</div>";
     
     
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }
    //delete data from database
    //sql querry to delete data from database
    $sql="DELETE FROM `tbl_category` WHERE Id=$Id";
//execute the querry
$res=mysqli_query($conn,$sql);
//check whether data is delete from database or not
if($res==true)
{
    //set sucess msg and redirect
    $_SESSION['delete']="<div class='success'>category deleted successfully</div>";
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}
else {
    //set fail msg and redirect
    $_SESSION['delete']="<div class='error'>failed to  deleted category</div>";
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}
   
}
else {
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');

}





?>