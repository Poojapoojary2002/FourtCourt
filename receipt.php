<?php include('partials-font/menu.php'); ?>



<section class="receipt">
      
           
            <?php 
                  //get the search keyword
                  $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price * $qty;
                    $reserve_time=$_POST['Available-Time'];
                    $Status='Ordered';
                 
                 $user_id=$_POST['user_id'];
                  $customer_name=$_POST['full-name'];
             $customer_contact=$_POST['contact'];
                 $customer_email=$_POST['email'];
                 if(isset($_POST['payment']))
                 {
                     //get the value from form
                     $payment = $_POST['payment'];
                 }
                 else
                 {
                     //set the default value
                     $payment= "No";
                 }
                 $card=$_POST['card'];
                 $credit_no=$_POST['credit_no'];
                 $exp_month=$_POST['exp_month'];
                 $user_id=$_POST['user_id'];

                 $sql3="INSERT INTO `tbl_order`( `food`, `price`, `qty`, `total`, `reserve_time`, `status`, `customer_name`, `customer_contact`, `customer_email`,`user_id`) VALUES ('$food','$price','$qty',' $total',' $reserve_time',' $Status','$customer_name','$customer_contact','$customer_email','$user_id')";
                        //echo $sql2;die();
                    $res3=mysqli_query($conn,$sql3);
                    $sql="SELECT *FROM tbl_order WHERE  price=$price && qty=$qty && total=$total && user_id='$user_id'";

                    //execute th query
                    $res=mysqli_query($conn,$sql);

                    //count rows to check whether we have categories or not
                    $count=mysqli_num_rows($res);
                    //if count is greater than zero,we have categories else we donot have categories 
                    if($count>0)
                    {
                        //we have categories
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the details of categories
                            $id=$row['id'];
                        }
                    }
                        
                            
                   
                    $sql4="INSERT INTO `tbl_payment` (`type_of_payment`, `card`, `exp_month`, `credit_no`, `customer_name`,`user_id`, `order_id`) VALUES ('$payment','$card','$exp_month ','$credit_no',' $customer_name','$user_id',$id)";
                    $res4=mysqli_query($conn,$sql4);


            
            ?>
           
            <div class="container">

               
                    <h3 class="title">Bill Generation</h3>
                     </br></br>
                     <div class="billing-label">
                            <div>Order ID : <span style="color:purple"><?php echo $id; ?></span></div>
                           
                        </div>
                        <div class="billing-label">
                            <div>USER NAME : <span style="color:purple"><?php echo $customer_name; ?></span></div>
                           
                        </div>
                        <div class="billing-label">
                            <div>USER ID:<span style="color:purple"> <?php echo $user_id; ?></span></div>
                           
                        </div>
                        <div class="billing-label">
                            <div>PHONE NUMBER :<span style="color:purple"> <?php echo $customer_contact; ?></span></div>
                           
                        </div>
                        <div class="billing-label">
                            <div>EMAIL ID: <span style="color:purple"><?php echo $customer_email; ?></span></div>
                            
                        </div>
                        <div class="billing-label">
                            <div>AVAILABLE TIME :<span style="color:purple"> <?php echo $reserve_time; ?></span></div>
                            
                        </div>
                        <div class="billing-label">
                            <div>ORDERED FOOD: <span style="color:purple"><?php echo $food; ?></span></div>
                            
                        </div>
                        <div class="billing-label">
                            <div>QUANTITY : <span style="color:purple"><?php echo $qty; ?></span></div>
                            
                        </div>
                        <div class="billing-label">
                            <div>TOTAL AMOUNT :<span style="color:purple"> <?php echo $total; ?></span></div>
                            
                         </div>
                        <div class="billing-label">
                            <div>TYPE OF PAYMENT : <span style="color:purple"><?php echo $payment; ?></span></div>
                </div>
                            <div class="billing-label">
                            <div>STATUS : <span style="color:purple"><?php echo $Status; ?></span></div>
                            
                        </div>
                        <div class="ordered">Food Ordered Successfully</div>
                              <!--  <div class="content">-->
                </div>
                
                      
                </br>
                </br>
               
                        

                </section>
<?php include('partials-font/footer.php'); ?>