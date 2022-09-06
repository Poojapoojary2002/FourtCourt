<?php  include('partials/menu.php'); ?>
    <!--MENU SECTION CLOSE-->



    <!-- CONTENT SECTION BEGIN-->
    <div class="Main-Content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        
        
        <br />  <br />

        
        <!--button to add admin-->
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">ADD FOOD</a>
        <br />  <br />

        <?php
        if(isset($_SESSION['add']))//checking whether the session is set or not
        {
            echo $_SESSION['add'];//displaying session message
            unset($_SESSION['add']);//removing session message
        }
        if(isset($_SESSION['delete']))//checking whether the session is set or not
          {
    echo $_SESSION['delete'];//displaying session message
    unset($_SESSION['delete']);//removing session message
          }
         
          if(isset($_SESSION['unauthorize']))//checking whether the session is set or not
          {
              echo $_SESSION['unauthorize'];//displaying session message
              unset($_SESSION['unauthorize']);//removing session message
          }
          if(isset($_SESSION['upload']))//checking whether the session is set or not
{
    echo $_SESSION['upload'];//displaying session message
    unset($_SESSION['upload']);//removing session message
}
if(isset($_SESSION['failed-remove']))//checking whether the session is set or not
{
    echo $_SESSION['failed-remove'];//displaying session message
    unset($_SESSION['failed-remove']);//removing session message
}
if(isset($_SESSION['update']))//checking whether the session is set or not
{
    echo $_SESSION['update'];//displaying session message
    unset($_SESSION['update']);//removing session message
}
 

        ?>
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
</tr>
<?php
//create sql query to get all food
$sql="SELECT *FROM tbl_food";
//execute the query
$res=mysqli_query($conn,$sql);
//count rows to check whether we have food or not
$count=mysqli_num_rows($res);
$sn=1;
if($count>0)
{
// we have food in database
//get the food from database and display
while($row=mysqli_fetch_assoc($res))
{
    //get the value from individual columns
    $Id=$row['id'];
   $Title=$row['Title'];
   $Price=$row['Price'];
   $Image_Name=$row['Image_Name'];
   $Featured=$row['Featured'];
   $Active=$row['Active'];
   ?>
       <tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $Title; ?></td>
    <td><?php echo $Price; ?></td>
    <<td><?php 
    //check whether we have image or not
      if($Image_Name!="")
      {
  //display the image
  ?>
  <img src="<?php echo  SITEURL;?>images/category/<?php echo  $Image_Name ;?>" width="100px">
  <?php
  
  
      }
      else {
          //display the msg
          echo "<div class='error'>image not added</div>";
      }
      ?> </td>
    <td><?php echo $Featured ; ?></td>
    <td><?php echo  $Active; ?></td>
    <td>
        <a href="  <?php echo SITEURL;?>admin/update-food.php?Id=<?php echo $Id; ?>" class="btn-secondary">Update Food</a>
       
        <a href="<?php echo SITEURL;?>admin/delete-food.php?Id=<?php echo $Id; ?>&Image_Name=<?php  echo $Image_Name;?>" class="btn-danger"> Delete Food</a>
    </td>
</tr>
   <?php
}
}
else {
    //food not added in database
    echo "<tr><td colspan='7' class='error'>Food Not Added At</td> </tr>";
}

?>


</table>
</div>
</div>
<?php include('partials\footer.php'); ?>
