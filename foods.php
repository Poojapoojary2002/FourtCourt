<?php include('partials-font/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center food-searchh">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->  
    <section class="food-menu ">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
                        <?php
                       //Display the food that are active
                       $sql="SELECT *FROM tbl_food WHERE Active='Yes'";
                       //execute the query 
                       $res=mysqli_query($conn,$sql);
                       $count=mysqli_num_rows($res);
                       //check whether foods are available or not
                       if($count>0)
                       {
                           //food available
                           while($row=mysqli_fetch_assoc($res))
                           {
                            $Id=$row['id'];
                            $Title=$row['Title'];
                            $Description=$row['Description'];
                             $Price=$row['Price'];
                             $Image_Name=$row['Image_Name'];
                             ?>
                <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    //check whether  image available or not
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
                           //food not available
                           echo "<div class='error'>Food Not Found</div>";
                       }



                        ?>


           

           
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include('partials-font/footer.php'); ?>