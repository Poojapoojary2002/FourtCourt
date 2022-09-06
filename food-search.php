<?php include('partials-font/menu.php'); ?>
<!--<div class="food-searchh">-->
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center food-searchh">
        <div class="container ">
            <?php

                   //get the search keyword
                    $search=$_POST['search'];
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container ">
            <h2 class="text-center">Food Menu</h2>
            <?php
              
              //sql query to get food based on serach keyword
              $sql="SELECT *FROM tbl_food WHERE Title LIKE '%$search%' OR Description LIKE '%$search%'";
              //execute the query
              $res=mysqli_query($conn,$sql);
              $count=mysqli_num_rows($res);
              //check whether food available or not
              if($count>0)
              {
                  //food available
                  while($row=mysqli_fetch_assoc($res))
                            {
                                $Id=$row['id'];
                                $Title=$row['Title'];
                                $Price=$row['Price'];
                                $Description=$row['Description'];
                                $Image_Name=$row['Image_Name'];
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
                    <p class="food-price">₹<?php echo $Price;?></p>
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
                  echo "<div class='error'>Food not found</div>";
              }
           ?>

          


            <div class="clearfix"></div>

            

        </div>

    </section>
           <!-- </div>-->
    <!-- fOOD Menu Section Ends Here -->

    
    <?php include('partials-font/footer.php'); ?>