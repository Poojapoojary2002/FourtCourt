<?php  include('partials/menu.php'); ?>

<div class="Main-Content">
    <div class="wrapper">
        <h1>Add Food</h1>
        
        
        <br />  <br />

        <?php
        if(isset($_SESSION['upload']))//checking whether the session is set or not
        {
            echo $_SESSION['upload'];//displaying session message
            unset($_SESSION['upload']);//removing session message
        }


        ?>
        <form action=""method="POST"  enctype="multipart/form-data">
<table class="tbl-30">
                <tr>
                <td>Title: </td>
                    <td><input type="text" name="Title" placeholder=" Title of the Food"> </td>
                   
                </tr>
                <tr>
                <td>Description: </td>
                    <td> <textarea name="Description" cols="30" rows="5"placeholder="Description of Food"></textarea> </td>
                   
                </tr>
                <tr>
                <td>Price: </td>
                    <td><input type="number" name="Price"> </td>
                   
                </tr>
                <tr>
                <td> Select Image:</td>
                <td>
                    <input type="file" name="Image_Name">
               </td>
               </tr>

               <tr>
                <td> Category:</td>
                <td>
                    <select name="Category" >
                        <?php
                           //create php code to display categories from database
                           //create sql to get all active categories from database

                           $sql="SELECT  *FROM tbl_category   WHERE Active='Yes'";
                           $res=mysqli_query($conn,$sql);//executing query
                           //count the rows to check whether we have categories or not
                           $count=mysqli_num_rows($res);
                           //if count is >0 we have categories else we donot have categories
                           if($count>0)
                           {
                               //we have categories
                               while($row=mysqli_fetch_assoc($res))
                               {
                                  //get the details of category
                                  $Id=$row['Id'];
                                  $Title=$row['Title'];
                                  ?>    
                                  <option value="<?php echo $Id;?>"><?php  echo $Title;   ?></option>



                                  <?php
                               }
                           }
                           else {
                               //we donot have categories
                               ?>
                               <option value="0">No Category Found</option>
                               <?php
                           }
                           //display on dropdown


                        ?>
                    
</select>
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
                    <td colspan="2"><input type="submit" name="submit"  value="Add Food" class="btn-secondary"></td>
                </tr>




</table>
</form>

<?php
   //check whether the  button is clicked or not
   if(isset($_POST['submit']))
{
    //add the food in database
    //1.get the data from form
    $Title=$_POST['Title'];
    $Description=$_POST['Description'];
    $Price=$_POST['Price'];
    $Category=$_POST['Category'];

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
    

     //2.upload the image if selected
     //check whether the select image is clicked or not and upload the image only if image is selected
     if(isset($_FILES['Image_Name']['name']))
     {
         //get the details of selected image
         $Image_Name=$_FILES['Image_Name']['name'];
         //check whether image is selected or not and upload image only if selected
         
         if($Image_Name!="")
         {
             //image is selected
             //A.rename the image
             $ext=end(explode('.',$Image_Name));

             //rename the image 
             $Image_Name="Food-Name-".rand(000,999).'.'.$ext;
             //B.upload the image
             //get the source and destination path
             $source_path=$_FILES['Image_Name']['tmp_name'];
             $destination_path="../images/category/".$Image_Name;
             //finally upload the image
             $upload=move_uploaded_file($source_path,$destination_path);
             //check wherther image is uploaded or not
             //and if image is not uploaded we will stop the process ,redirect with error msg
          if($upload==false)
          {
              //failed to uplaod the image
             $_SESSION['upload']= "<div class='error'> failed to upload image</div>";
             //redirect to add category page

               header('location:'.SITEURL.'admin/add-category.php');
              //stop the process
            die();
          }









         }
   
     }
     else {
        $Image_Name="";//SETTING default value as blank
     }

     
    //3.insert into database
    //create sql query to save or add food
     //for numerical value donot need to pass value inside quotes'' but for string it is compalsory
    $sql2="INSERT INTO tbl_food SET
    Title='$Title',
   Description='$Description',
   Price=$Price,
   Image_Name='$Image_Name',
   Category_Id=$Category,
Featured='$Featured',
   Active='$Active'
    ";
     //execute the querry 
     $res2=mysqli_query($conn,$sql2);
     //check whether data is inserted or not
       //4.redirect with msg to manage food page
    if($res==TRUE)
    {
        //data inserted successfully
        $_SESSION['add']= "<div class='success'>food added successfully.</div>";
        //redirect to manage food page

        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
        //failed to add food
        $_SESSION['add']="<div class='error'>failed to add food</div>";
        //redirect to manage food page

        header('location:'.SITEURL.'admin/manage-food.php');
    }

  

}



?>


</div>
</div>
<?php include('partials/footer.php'); ?>