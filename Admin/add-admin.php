<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br />
        <?php
                    if(isset($_SESSION['add']))//checking whether the ssion is set or not
                    {
                        echo $_SESSION['add'];//displaying session message
                        unset($_SESSION['add']);//removing session message
                    }

                ?>
      

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"> </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your username"> </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your Password"> </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="save"  value="Add Admin" class="btn-secondary"></td>
                </tr>
            </table>
    </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php
if(isset($_POST['save']))
{
	$Full_Name = $_POST['full_name'];
	$UserName = $_POST['username'];
	$Password =md5 ($_POST['password']);
	

	$sql = "INSERT INTO tbl_admin SET FullName='$Full_Name',UserName='$UserName',Password='$Password'";
    //executing query and saving data intom database
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    //chech whether the (query is executed)data is inserted or not and display appropriate message

    if($res==TRUE)
    {
        //data inserted
        //echo "data inserted";
        //create a session variable to diaplay message
        $_SESSION['add'] = "Admin added successfully";
        //Redirecting page manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //failed to insert data
        //echo "data not inserted";
        $_SESSION['add'] = "Failed to add admin";
        //Redirecting page add admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>