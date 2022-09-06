<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br/>
        <br/>

        <?php

if(isset($_SESSION['add']))//checking whether the session is set or not
{
    echo $_SESSION['add'];//displaying session message
    unset($_SESSION['add']);//removing session message
}
if(isset($_SESSION['upload']))//checking whether the session is set or not
{
    echo $_SESSION['upload'];//displaying session message
    unset($_SESSION['upload']);//removing session message
}


        ?>

        <br/>
        <br/>
       
        
         <!-- add category form start-->
<form action=""method="POST"  enctype="multipart/form-data">
<table class="tbl-30">
                <tr>
                <td>Title: </td>
                    <td><input type="text" name="Title" placeholder="category title"> </td>
                   
                </tr>
                <tr>
                <td> Select Image:</td>
                <td>
                    <input type="file" name="Image_Name">
               </td>
               </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="Featured" value="Yes">Yes
                        <input type="radio" name="Featured" value="No">No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input type="radio" name="Active" value="Yes">Yes
                    <input type="radio" name="Active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit"  value="Add Category" class="btn-secondary"></td>
                </tr>
</table>


</form>
<?php
//check whether submit button is clicked or not 
if(isset($_POST['submit']))
{
   // echo "clicked";
   //get the value from the category form
   $Title = $_POST['Title'];
   //for radio input type we need to check whether button is selected or not
   if(isset($_POST['Featured']))
   {
//get the value from form
$Featured=$_POST['Featured'];
   }
   else{

       //set default value
       $Featured="No";
   }

   if(isset($_POST['Active']))
   {
//get the value from form
$Active=$_POST['Active'];
   }
   else{
//if the value is not set
       //set default value
       $Active="No";
   }
//check whether image is selected or not and set the value for image name accordingly
if(isset($_FILES['Image_Name']['name']));
//printr is used to display the value of array
{

//upload the image
//to upload the image we need image,name,source path and destination path
      $Image_Name=$_FILES['Image_Name']['name'];
      //upload image only if image is selected
      if($Image_Name!="")
      {

      
      //auto rename our image
      //get the extension of our image(jpg,png,gif,etc)eg :"food1.jpg"
      $ext=end(explode('.',$Image_Name));

      //rename the image 
      $Image_Name="food_category_".rand(000,999).'.'.$ext;//e.g food_category_834.jpg
        


      $source_path=$_FILES['Image_Name']['tmp_name'];


      $destination_path="../images/category/".$Image_Name;
//finally upload the image
      $upload=move_uploaded_file($source_path,$destination_path);
//check wherther image is uploaded or not
//and if image is not uploaded we will stop the process ,redirect with error msg
          if($upload==false)
           {
              $_SESSION['upload']= "<div class='error'> failed to upload image</div>";
        //redirect to add category page

                header('location:'.SITEURL.'admin/add-category.php');
        //stop the process
             die();
            }
        }


else
 {
    $Image_Name="";

 }
}


//die();//break the code here




   //create sql querry to insert category to database
   $sql="INSERT INTO `tbl_category` SET 
   Title='$Title',
   Image_Name='$Image_Name',
Featured='$Featured',
   Active='$Active'
    ";
    //$sql="INSERT INTO `tbl_category`(`Id`, `Title`, `Image_Name`, `Featured`, `Active`) VALUES ('$Id','$Title','$Image_Name','$Featured','$Active')";

    //execute the querry and save in database
    $res=mysqli_query($conn,$sql);
    //check whether query is executed or not and data is added or not
    if($res==TRUE)
    {
        //querry executed and category added
        $_SESSION['add']= "<div class='success'>Category added successfully.</div>";
        //redirect to manage category page

        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else{
        //failed to add category
        $_SESSION['add']="<div class='error'>failed to add category</div>";
        //redirect to manage category page

        header('location:'.SITEURL.'admin/add-category.php');
    }
	
}


?>



          <!-- add category form stop-->

</div>
    </div>



<?php include('partials/footer.php'); ?>