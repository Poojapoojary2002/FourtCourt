<?php include('partials-font/menu.php'); ?>
<?php
    if(isset($_GET['food_id']))
    {
        //get the food id and details of selected food
        $food_id=$_GET['food_id'];

        $sql="SELECT *FROM tbl_food WHERE id=$food_id";

        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);
            $title=$row['Title'];
            $price=$row['Price'];
            $image_name=$row['Image_Name'];
            
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        //redrect to homepage
        header('location:'.SITEURL);
    }
?>

<script>
                function text(x){
                       if(x==1){
                        document.getElementById("mycode").style.display="block";
                    }
                     else{
                            document.getElementById("mycode").style.display="none";
                     }
                         return;
                     }
                     </script>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white color">Fill this form to confirm your order</h2>

            <form action="<?php echo SITEURL;?>receipt.php" method="POST" class="order">
                <fieldset>
                    <legend class="legend">Selected Food</legend>

                    <div class="food-menu-img">
                    <?php
                                    //check whether image available or not
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                 
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <p class="order-price"><?php echo "₹$price";?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend class="legend">Reserve Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive" required>
                    <div class="order-label">User Id</div>
                    <input type="text" name="user_id" placeholder="Enter your USN/FID" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g.abc@gmail.com" class="input-responsive" required>
                    <div class="order-label">Available Time</div>
                    <input type="time" name="Available-Time" placeholder="E.g 1.00pm" class="input-responsive" required>
                    </fieldset>
                     <fieldset>
                     <legend class="legend">Reserve Details</legend>
                     </br></br>
                      
                </br>
                        <h3 style="color:blue; font-size=10;">Type of Mode</h3>
                </br>
                
                            
                        <input type="radio" class="payment-label" name="payment" value="cash on delivery" onclick="text(0)" >Cash on delivery
                        </br></br>
                        <input type="radio" class="payment-label" name="payment" value="online payment" onclick="text(1)" >Online payment
                </br>
                </br>
                              <!--  <div class="content">-->
                        <div id="mycode"  style="display:none">
                               
                                <div class="payment-label">
                                    <div>Name on Card :</div>
                                    <input type="text" name="card" placeholder="mr. john deo">
                                </div>
                                <div class="payment-label">
                                    <div>Credit Card number :</div>
                                    <input type="number" name="credit_no" placeholder="1111-2222-3333-4444">
                                </div>
                                <div class="payment-label">
                                    <div>Exp Month :</div>
                                    <input type="text" name="exp_month" placeholder="january">
                                </div>

                        </div>
                    
                    <br/>
                    <br/>
                   <input type="submit" name="submit" value="Proceed" class="btn btn-primary">
                   <!-- <a href="<?php echo SITEURL;?>receipt.php?id=<?php echo $id; ?>" class="btn btn-primary" type="submit" name="submit">Delete Admin</a>
                </fieldset>

            </form>     

            

        </div>
    </section>
    <! fOOD sEARCH Section Ends Here -->

    <?php include('partials-font/footer.php'); ?>