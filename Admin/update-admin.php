<?php include('partials/menu.php'); ?>
<div class="main-content">
            <div class="wrapper">
                <h1>UPDATE ADMIN</h1>

                <br /><br />
                <?php
                  //1.gwt the id of selected admin
                  $id=$_GET['id'];

                  //2.create sql query to get the detail//
                  $sql="SELECT * FROM tbl_admin WHERE id=$id";
                  //execute the query
                 $res=mysqli_query($conn,$sql);
                 //check whether the querry is executed or not
                 if($res==true)
{
    //check whether the data is available or not
    $count=mysqli_num_rows($res);
    //check whether we have  admin data or not
    if($count==1)
    {
        //get the detail
        //echo "admin available";
        $row=mysqli_fetch_assoc($res);
        $full_name=$row['FullName'];
        $username=$row['UserName'];

    }
    else{
        //redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');

    }

}


                ?>
    <form action="" method="POST">
                <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"> </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"> </td>
                </tr>

               

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="save"  value="update Admin" class="btn-secondary"></td>
                </tr>
            </table>
    </form>
</div>
</div>
<?php
//check whether the submit button is clicked or not
if(isset($_POST['save']))
{
    //echo "button clicked";
    //get all the values from the form to update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   //create sql query to upadate admin
   $sql="UPDATE tbl_admin SET
   FullName='$full_name',
   UserName='$username'
    WHERE id='$id' 
    ";
    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the query is executed sucessfull or not
    if($res==true)
{
 
    //query executed and admin updated
    $_SESSION['update'] = "<div class='sucess'>Admin updated successfully.</div>";
    //Redirecting page manage admin page
    header("location:".SITEURL.'Admin/manage-admin.php');//. is used to concatinate
}
else{
    //failed to update
    $_SESSION['update'] = "<div class='error'>failed to update.</div>";
    //Redirecting page manage admin
    header("location:".SITEURL.'Admin/manage-admin.php');
}
}

?>

<?php include('partials/footer.php'); ?>