<?php include('partials-font/menu.php'); ?>
 <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
         <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                 <input type="submit" name="submit" value="Search" class="btn btn-primary">
         </form>
    </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    if(isset($_SESSION['order']))
                 {
                     echo $_SESSION['order'];
                     unset($_SESSION['order']);
                 }
                 ?>
<!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
<?php
$sql="SELECT *FROM tbl_category WHERE Active='Yes'AND Featured='Yes' LIMIT 4";
$res=mysqli_query($conn,$sql);
$count=mysqli_num_rows($res);
if($count>0)
                           {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $Id=$row['Id'];
                                  $Title=$row['Title'];
                                  $Image_Name=$row['Image_Name'];
                                  ?>
                                  <a href="<?php echo SITEURL; ?>category-foods.php?Category_Id=<?php echo $Id;?>">
                             <div class="box-3 float-container">
                <?php
                //check whether image is available or not
                      if($Image_Name=="")
                      {
                          //display the msg
                          echo "<div class='error'>image not available </div>";

                      }
                      else {
                          //image available
                          ?>
                          <img src="<?php echo SITEURL;?>images/category/<?php echo $Image_Name; ?>"  class="image img-responsive img-curve" height="400px">
             
                          <?php
                      }

               ?>
               <!----<img src="images/breakfast.jpg" alt="Breakfast" class="img-responsive img-curve" height="350">
                    <div class="middle">
                <h3 class="float-text text-black">Breakfast</h3>-->

                <div class="middle">
                <div class="text"><?php echo $Title; ?></div>
                </div>
            </div>
            
            </a>
                                  <?php
                            }
                           }
                           else {
                            echo "<div class='error'>Category not added.</div>";
                           }
?>
                      <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
  <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                   //getting food from database that are active and featured
                   //sql query
                   $sql2="SELECT *FROM tbl_food WHERE Active='Yes' AND Featured='Yes' LIMIT 50";
                   //execute the query
                   $res2=mysqli_query($conn,$sql2);
                   //count rows
                   $count2=mysqli_num_rows($res2);
                   //check whether food available or not
                   if($count2>0)
                   {
                    while($row=mysqli_fetch_assoc($res2))
                    {
                         //get all values
                         $Id=$row['id'];
                         $Title=$row['Title'];
                         $Description=$row['Description'];
                         $Price=$row['Price'];
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
                       echo "<div class='error'>Food Not Available</div>";
                   }
            ?>
  <div class="clearfix"></div>
  </div>
 <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-font/footer.php'); ?>