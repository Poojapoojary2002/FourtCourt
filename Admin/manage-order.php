<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Order</h1>

    <br /><br />
                <!-- Button to admin -->
                
                <?php
                 if(isset($_SESSION['update']))
                 {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
                 }
                
                ?>
                <br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Reserve Time</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //get the orders from database
                        $sql="SELECT * FROM tbl_order";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);

                        $sn=1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $food=$row['food'];
                                $price=$row['price'];
                                $Quantity=$row['qty'];
                                $Total=$row['total'];
                                $reserve_time=$row['reserve_time'];
                                $Status=$row['status'];
                                $Customer_Name=$row['customer_name'];
                                $Customer_Contact=$row['customer_contact'];
                                $Customer_Email=$row['customer_email'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $food;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $Quantity;?></td>
                                        <td><?php echo $Total;?></td>
                                        <td><?php echo $reserve_time;?></td>
                                        <td>
                                            <?php 
                                            if($Status=="Ordered")
                                            {
                                                echo "<label>$Status</label>";
                                            }
                                            elseif($Status=="On Delivery")
                                            {
                                                echo "<label style='color:orange;'>$Status</label>";
                                            }
                                            elseif($Status=="Delivered")
                                            {
                                                echo "<label style='color:green;'>$Status</label>";
                                            }
                                            elseif($Status=="Cancelled")
                                            {
                                                echo "<label style='color:red;'>$Status</label>";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $Customer_Name;?></td>
                                        <td><?php echo $Customer_Contact;?></td>
                                        <td><?php echo $Customer_Email;?></td>
                                       
                                        <td>
                                            <a href="<?php  echo SITEURL;?>admin/update-order.php?Id=<?php echo $id;?>" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>
                                        
                                        
                                    

                                <?php
                            }
                        }
                        else {
                            echo "<tr><td colspan='12' class='error'>Orders not Available.</td></tr>";
                        }
                    
                    
                    ?>
    
            
            
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>