<?php include('partials-font/menu.php'); ?>
   
   



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
//display all categories that are active
//sql query
$sql="SELECT *FROM tbl_category WHERE Active='Yes'";
//execute the query
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
//check whether category available or not
if($count>0)
{
    while($row=mysqli_fetch_assoc($res))
    {
        $Id=$row['Id'];
        $Title=$row['Title'];
        $Image_Name=$row['Image_Name'];
        ?>



               <a href=<?php echo SITEURL;?>category-foods.php?Category_Id=<?php echo $Id; ?>>
                <div class="box-3 float-container">
                    <?php
                    if($Image_Name=="")
                    {
                        echo "<div class='error'>image not found </div>";

                    }
                    else {
                        ?>
                       <img src="<?php  echo SITEURL; ?>images/category/<?php echo $Image_Name;?>"  class="img-responsive img-curve">
                        <?php
                        
                    }
                    ?>
              

                <h3 class="float-text text-white"><?php echo $Title; ?></h3>
                </div>
                </a>

      <?php

    }
}
else {
    
                            
    echo "<div class='error'>Category not found</div>";
}
?>


        

            
            

            <div class="clearfix"></div>
</div>
</section>     


    <?php include('partials-font/footer.php'); ?>
    