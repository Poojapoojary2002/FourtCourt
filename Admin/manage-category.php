<?php  include('partials/menu.php'); ?>
    <!--MENU SECTION CLOSE-->



    <!-- CONTENT SECTION BEGIN-->
    <div class="Main-Content">
    <div class="wrapper">
        <h1>MANAGE CATEGORY</h1>
        <br />  <br />

        <?php

if(isset($_SESSION['add']))//checking whether the session is set or not
{
    echo $_SESSION['add'];//displaying session message
    unset($_SESSION['add']);//removing session message
}
if(isset($_SESSION['remove']))//checking whether the session is set or not
{
    echo $_SESSION['remove'];//displaying session message
    unset($_SESSION['remove']);//removing session message
}
if(isset($_SESSION['delete']))//checking whether the session is set or not
{
    echo $_SESSION['delete'];//displaying session message
    unset($_SESSION['delete']);//removing session message
}
if(isset($_SESSION['no-category-found']))//checking whether the session is set or not
{
    echo $_SESSION['no-category-found'];//displaying session message
    unset($_SESSION['no-category-found']);//removing session message
}
if(isset($_SESSION['update']))//checking whether the session is set or not
{
    echo $_SESSION['update'];//displaying session message
    unset($_SESSION['update']);//removing session message
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


        ?>
<br/>
<br/>




        <!--button to add admin-->
        <a href="<?php echo SITEURL;?>Admin/add-category.php" class="btn-primary">ADD CATEGORY</a>
        <br />  <br />
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>

</tr>
<?php
//query to get all category from database
$sql="SELECT *FROM tbl_category";
//execute query
$res=mysqli_query($conn,$sql);
//count the rows
$count=mysqli_num_rows($res);
//create serial no variable 
$sn=1;

//check whether we have data in database or not
if($count>0){
    //we have data in database
    //get the data and display
    while($row=mysqli_fetch_assoc($res))
    {
        $Id=$row['Id'];
        $Image_Name=$row['Image_Name'];
        $Title=$row['Title'];
        $Featured=$row['Featured'];
        $Active=$row['Active'];
        ?>

<tr>
    <td><?php echo $sn++; ?></td>
    <td><?php echo $Title; ?></td>
    <td>
    <?php 
    //check whether image name is available or not
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
    
    ?>

    </td>

    <td><?php echo  $Featured; ?></td>
    <td><?php echo  $Active; ?></td>
    <td>
        <a href="<?php echo SITEURL;?>admin/update-category.php?Id=<?php echo $Id; ?>" class="btn-secondary">update Category</a>
        <a href="<?php echo SITEURL;?>admin/delete-category.php?Id=<?php echo $Id; ?>&Image_Name=<?php  echo $Image_Name;?>" class="btn-danger"> delete Category</a>
    </td>
</tr>
        <?php
    }
}
else {
    //else we dont have data
    //we will display the msg inside table
    ?>
    <tr>
        <td colspan="6"><div class="error">No category added</div></td>


</tr>
    <?php
}



?>




</table>
        


</div>
</div>
    <!--CONTENT SECTION CLOSE-->





    <?php include('partials\footer.php'); ?>
