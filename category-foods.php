<?php include('partials-font/menu.php'); ?>


<?php

//check whether id is passed or not
if(isset($_GET['Category_Id']))
{
    //category id is set and get the id
    $Category_Id=$_GET['Category_Id'];
    //get the category title based on category id
    $sql="SELECT Title  FROM tbl_category WHERE Id=$Category_Id";
    //execute the query
    $res=mysqli_query($conn,$sql);
    //get the value from database
    $row=mysqli_fetch_assoc($res);
    //get the title
    $Category_Title=$row['Title'];

}
else {
    //category not passed
    //redirect to home page
    header('location:'.SITEURL);
}

?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center food-searchh">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $Category_Title;?> "</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                   //create sql query to get food based on selected category
                   $sql2="SELECT *FROM tbl_food WHERE Category_Id=$Category_Id";
                   //execute the query
                   $res2=mysqli_query($conn,$sql2);
                   //count the rows
                   $count2=mysqli_num_rows($res2);
                   //check whether food is available or not
                   if($count2>0)
                   {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $Id=$row2['id'];
                        $Title=$row2['Title'];
                        $Description=$row2['Description'];
                        $Price=$row2['Price'];
                        $Image_Name=$row2['Image_Name'];
                        ?>
                        <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                     if($Image_Name=="")
                     {
                            echo "<div class='error>Image not available</div>";
                     }
                     else {
                         ?>
                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $Image_Name;?>"  class="img-responsive img-curve">
                         <?php
                         
                     }



                    ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $Title ;?></h4>
                    <p class="food-price"> ₹<?php echo $Price;?></p>
                    <p class="food-detail">
                    <?php echo $Description;?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $Id;?>" class="btn btn-primary">Book Now</a>
                </div>
            </div>
                        <?php
                    }
                   }
                   else {
                       echo "<div class='error'>Food not available</div>";
                   }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-font/footer.php'); ?>