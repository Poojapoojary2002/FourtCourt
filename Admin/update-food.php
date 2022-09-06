<?php include('partials/menu.php'); ?>

<div class="main-content">
            <div class="wrapper">
                <h1>Update Food</h1>


                <br /><br />



                <?php
                   //check whether id is set or not
                if(isset($_GET['Id']))
                {
                    $Id=$_GET['Id'];
                  //create sql querry to get all detail
                  $sql2="SELECT *FROM tbl_food WHERE Id=$Id";
                  //execute the query
                  $res2=mysqli_query($conn,$sql2);
                  $row2=mysqli_fetch_assoc($res2);
                  //count the rows to check whether id is valid or not
                      $Title=$row2['Title'];
                      $Description=$row2['Description'];
                      $Price=$row2['Price'];
                      $Current_Image=$row2['Image_Name'];
                      $Current_Category=$row2['Category_Id'];
                      $Featured=$row2['Featured'];
                      $Active=$row2['Active'];



                }
                else {
                    //redirect to manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                }




                ?>
                <form action="" method="POST"  enctype="multipart/form-data">
                <table class="tbl-30">
                <tr>
                <td>Title: </td>
                    <td><input type="text" name="Title" value="<?php echo $Title;?>" > </td>
                   
                </tr>
                <tr>
                <td>Description: </td>
                    <td> <textarea name="Description" cols="30" rows="5" value="<?php echo $Description;?>" ></textarea> </td>
                   
                </tr>
                <tr>
                <td>Price: </td>
                    <td><input type="number" name="Price" value="<?php echo $Price;?>" > </td>
                   
                </tr>
                <tr>
                <td> Current Image:</td>
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
                            echo "<div class='error'>Image not available</div>";
                        }



               ?>
               </td>
               </tr>

               <tr>
                <td> Select New Image:</td>
                <td>
                    <input type="file" name="Image_Name">
               </td>
               </tr>
               <tr>
               <td> Category:</td>
                <td>
                    <select name="Category" >
                        <?php
                               //create sql to get all active food from database

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
                                  $Category_Id=$row['Id'];
                                  $Category_Title=$row['Title'];
                                  ?>    
                                  <option <?php if($Current_Category==$Category_Id){echo "selected";} ?>      value="<?php echo $Current_Id;?>"><?php  echo $Category_Title;   ?></option>
                                  <?php
                               }
                            }
                           
                           else {
                            //we donot have categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                   

                        ?>
                        
                        
                     </select>
                     </td>
              </tr>
              
              <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($Featured=="Yes"){ echo "checked";} ?>   type="radio" name="Featured" value="Yes">Yes
                        <input <?php if($Featured=="No"){ echo "checked";} ?>  type="radio" name="Featured" value="No">No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                    <input  <?php if($Active=="Yes"){ echo "checked";} ?> type="radio" name="Active" value="Yes">Yes
                    <input   <?php if($Active=="No"){ echo "checked";} ?>  type="radio" name="Active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td >
                    <input type="hidden" name="Current_Image" value="<?php echo $Current_Image; ?>" >
                    <input type="hidden" name="Id" value="<?php echo $Id; ?>" >
                   <input type="submit" name="submit"  value="Update Food" class="btn-secondary">
                </td>
                </tr>



</table>
</form>
<?php
if(isset($_POST['submit']))
{
    //1.get all the details from the form 

    $Id=$_POST['Id'];
         $Title=$_POST['Title'];
         $Description=$_POST['Description'];
        $Price=$_POST['Price'];
          $Current_Image=$_POST['Current_Image'];
          $Category=$_POST['Category'];
          $Featured=$_POST['Featured'];
          $Active=$_POST['Active'];
    //2.upload the image if selected
    if(isset($_FILES['Image_Name']['name']))
    {
        //get image detail
        $Image_Name=$_FILES['Image_Name']['name'];
        //check whether image is available or not
        if( $Image_Name!=="")
        {
            //uploading new image
            $ext=end(explode('.',$Image_Name));
            $Image_Name="Food-Name-".rand(000,999).'.'.$ext;
            $source_path=$_FILES['Image_Name']['tmp_name'];
            $destination_path="../images/category/".$Image_Name;
            $upload=move_uploaded_file($source_path,$destination_path);
                   if($upload==false)
           {
              $_SESSION['upload']= "<div class='error'> failed to upload  new image</div>";
              header('location:'.SITEURL.'admin/manage-food.php');
        //stop the process
             die();
           }
           //B.remove current image if available
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
                 header('location:'.SITEURL.'admin/manage-food.php');
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
  
    //3.remove the image if new  image uploaded and current image exist
    //4.update the food in database
    $sql3=" UPDATE `tbl_food` SET `Title`='$Title',`Description`='$Description',`Price`='$Price',`Image_Name`='$Image_Name',`Category_Id`='$Category',`Featured`='$Featured',`Active`='$Active' WHERE Id=$Id"; 
     //execute the query
     $res3=mysqli_query($conn,$sql3);

    //redirect to manage food with session msg

          //check whether query executed or not
          if($res3==true)
          {
              //category updated
              $_SESSION['update']= "<div class='success'>Food updated successfully.</div>";
              header('location:'.SITEURL.'admin/manage-food.php');
          }
          else {
              //failed to update category
              $_SESSION['update']= "<div class='error'>failed to updated food</div>";
              header('location:'.SITEURL.'admin/manage-food.php');
          }
}




?>
</div>
</div>
<?php include('partials/footer.php'); ?>