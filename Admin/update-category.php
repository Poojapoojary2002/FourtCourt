<?php include('partials/menu.php'); ?>

<div class="main-content">
            <div class="wrapper">
                <h1>Update Category</h1>


                <br /><br />

                <?php
                //check whether id is set or not
                if(isset($_GET['Id']))
                {
                  //get the id and all other detail
                  //echo "get the data";
                  $Id=$_GET['Id'];
                  //create sql querry to get all detail
                  $sql="SELECT *FROM tbl_category WHERE Id=$Id";
                  //execute the query
                  $res=mysqli_query($conn,$sql);
                  //count the rows to check whether id is valid or not
                  $count=mysqli_num_rows($res);
                  if($count==1)
                  {
                      //get all data
                      $row=mysqli_fetch_assoc($res);
                      $Title=$row['Title'];
                      $Current_Image=$row['Image_Name'];
                      $Featured=$row['Featured'];
                      $Active=$row['Active'];
                      
                  }
                  else {
                      //redirect to manage category with session msg
                      $_SESSION['no-category-found']= "<div class='error'>Category not found.</div>";
                      header('location:'.SITEURL.'admin/manage-category.php');

                  }
                }
                else {
                    //redirect to manage category
                    header('location:'.SITEURL.'admin/manage-category.php');
                }



                ?>
                <form action="" method="POST"  enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="Title" value="<?php echo $Title;?>">
                        </td>   
                     </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                          <?php
                           if($Current_Image!=="")
                           {
                               //display the image
                               ?>
                               
                               <img src="<?php echo SITEURL;?>images/category/<?php echo $Current_Image; ?>" width="150px">
                               <?php
                           }
                           else {
                               //display msg
                               echo "<div class='error'>Image not added</div>";
                           }


                          ?>
                        </td>   

                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="Image_Name" value="">
                        </td>   

                    </tr>
                    <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($Featured=="Yes"){ echo "checked";} ?> type="radio" name="Featured" value="Yes">Yes
                        <input   <?php if($Featured=="No"){ echo "checked";} ?> type="radio" name="Featured" value="No">No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($Active=="Yes"){ echo "checked";} ?>  type="radio" name="Active" value="Yes">Yes
                    <input <?php if($Active=="No"){ echo "checked";} ?>  type="radio" name="Active" value="No">No
                    </td>
                </tr>
                <tr>
                <td>
                    <input type="hidden" name="Current_Image" value="<?php echo $Current_Image; ?>" >
                    <input type="hidden" name="Id" value="<?php echo $Id; ?>" >

                    <input type="submit" name="submit"  value="Update Category" class="btn-secondary"></td>
                </tr>



</table>
</form> 
<?php
     if(isset($_POST['submit']))
     {
         //get all the values from our form
         $Id=$_POST['Id'];
         $Title=$_POST['Title'];
          $Current_Image=$_POST['Current_Image'];
          $Featured=$_POST['Featured'];
          $Active=$_POST['Active'];
          //update new image if selected
          //Check whether image is selected or not
          if(isset($_FILES['Image_Name']['name']))
          {
              //get image detail
              $Image_Name=$_FILES['Image_Name']['name'];
              //check whether image is available or not
              if( $Image_Name!=="")
              {
                  //image available
                  //upload the new image
                   
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

                header('location:'.SITEURL.'admin/manage-category.php');
        //stop the process
             die();
            }
        
                  //remove the current image if available
                  if($Current_Image!="")
                  {
                    $remove_path="../images/category/".$Current_Image;
                    $remove=unlink( $remove_path);

                    //check wther image is removed or not 
                    //if failed to remove display msg and stop process
                    if($remove==false)
                    {
                        //failed to remove image
                        $_SESSION['failed-remove'] = "<div class='error'>failed to remove current image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        //stop the process
                        die();
   
                    }

                  }
                  


           }
              else {
                $Image_Name=$Current_Image;
              }
          }
          else {
            $Image_Name=$Current_Image;
          }

          //update data base
          $sql2="UPDATE `tbl_category` SET Image_Name='$Image_Name',`Title`='$Title',`Featured`=' $Featured',`Active`='$Active'  
           WHERE Id=$Id 
           ";
           //execute the query
           $res2=mysqli_query($conn,$sql2);


          //redirect to manage category with msg
          //check whether query executed or not
          if($res2==true)
          {
              //category updated
              $_SESSION['update']= "<div class='success'>Category updated successfully.</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
          }
          else {
              //failed to update category
              $_SESSION['update']= "<div class='error'>failed to updated category</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
          }

           }


?>
</div>
</div>
<?php include('partials/footer.php'); ?>