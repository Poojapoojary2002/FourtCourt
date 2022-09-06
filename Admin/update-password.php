<?php include('partials/menu.php'); ?>
<div class="main-content">
            <div class="wrapper">
                <h1>Change Password</h1>

                <br /><br />

                <?php
                if(isset($_GET['id']))
                {

                      $id=$_GET['id'];
                }


                ?>
<form action="" method="POST">
                <table class="tbl-30">
                <tr>
                    <td>Old Password</td>
                    <td>
                        <input type="password" name="Current_Password" placeholder="current password">
                     </td>
                </tr>
                <tr>
                <td>New Password</td>
                    <td><input type="password" name="New_Password" placeholder="new password"> </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="Confirm_Password" placeholder="confirm password"> </td>
                </tr>
                <tr>
                <input type="hidden" name="id" value="<?php echo $id;?>">
                    <td colspan="2"><input type="submit" name="save"  value="Change Password"class="btn-secondary" ></td>
                </tr>



                     </table>




</form>


</div>
</div>
<?php

//check whether submit button is clicked or not

if(isset($_POST['save']))
{
    //echo "clicked";
    //get the data
    $id=$_POST['id'];
    $Current_Password=md5($_POST['Current_Password']);
    $New_Password=md5($_POST['New_Password']);
    $Confirm_Password=md5($_POST['Confirm_Password']);


    //check whether the user with current id and password exist or not
    $sql="SELECT *FROM tbl_admin WHERE id=$id AND password='$Current_Password'";
    //execute que $res=mysqli_query($conn,$sql);
    $res=mysqli_query($conn,$sql);
    
    if($res==true)
    {
    //check whether data is available or not
    $count=mysqli_num_rows($res);
    if($count==1)
    {
//user exist and password can be changed
//echo "user found";
//CHECK WHETHER THE NEW PASSWORD ,CONFIRM PASSWORD MATCH OR NOT
if($New_Password==$Confirm_Password)
{
    //update password
    //echo "password match";
    $sql2="UPDATE tbl_admin SET 
    password='$New_Password'
    WHERE id=$id";
    $res2=mysqli_query($conn,$sql2);
    //check whether query executed or not
    if($res2==true)
    {
        //display msg
        //redirect to manage admin with error msg
    $_SESSION['change-pwd']="<div class='success'>passwors changed successfull.</div>";
    //redirect
    header("location:".SITEURL.'admin/manage-admin.php');

    }
    else{

        //dispaly error msg
        $_SESSION['change-pwd']="<div class='error'>failed to change password.</div>";
    //redirect
    header("location:".SITEURL.'admin/manage-admin.php');
    }
}
else{
    //redirect to manage admin with error msg
    $_SESSION['password-not-found']="<div class='error'>passwors not matchs.</div>";
        //redirect
        header("location:".SITEURL.'admin/manage-admin.php');
}
    }
    else{
        //user does not exist set msg and redirect
        $_SESSION['user-not-found']="<div class='error'>user not found.</div>";
        //redirect
        header("location:".SITEURL.'admin/manage-admin.php');
    }
}
   
    //check whether new password and confir passwor match or not
    //change password if all above is true
}


?>
<?php include('partials/footer.php'); ?>