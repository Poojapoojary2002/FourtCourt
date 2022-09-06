<?php include('partials/menu.php'); ?>
    <!--MENU SECTION CLOSE-->
     <!-- CONTENT SECTION BEGIN-->
    <div class="Main-Content">
    <div class="wrapper">
        <h1>DASHBORD</h1>
        <br/>
        <?php
 if(isset($_SESSION['login']))
 {
     echo $_SESSION['login'];//displaying session message
     unset($_SESSION['login']);//removing session message
 }
?>
<br/>
       <div class="col-4 text-center">
            <?php
            $sql="SELECT *FROM tbl_category";
            //execute the query
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);

              ?>
            <h1><?php echo $count;?></h1>
            <br></br>
            Categories
</div>
<div class="col-4 text-center">
<?php
            $sql2="SELECT *FROM tbl_food";
            //execute the query
            $res2=mysqli_query($conn,$sql2);
            $count=mysqli_num_rows($res2);
            ?>

            <h1><?php echo $count;?></h1>
            <br></br>
          Food
</div>
<div class="col-4 text-center">
<?php
            $sql3="SELECT *FROM tbl_order";
            //execute the query
            $res3=mysqli_query($conn,$sql3);
            $count=mysqli_num_rows($res3);
?>
            <h1><?php echo $count;?></h1>
            <br></br>
            Total Orders
</div>
<div class="col-4 text-center">
    <?php
    //create sql querry to get total revenue
    //aggregate function in sql
    $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE Status='Delivered'";
    $res4=mysqli_query($conn,$sql4);
           $row4=mysqli_fetch_assoc($res4);
           //get the total revenue
           $total_revenue=$row4['Total'];
    ?>
            <h1>₹<?php echo $total_revenue;?></h1>
            <br></br>
           Revenue Generated
</div>
<div class="clearfix"></div>
</div>
</div>
    <!--CONTENT SECTION CLOSE-->
  <!-- FOOTER SECTION BEGIN-->
   <?php  include('partials/footer.php'); ?>
