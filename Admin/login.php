<?php  include('../config/constant.php'); ?>
<html>
<head>
<title>LOGIN -FOOD COURT</title>
<link rel="stylesheet"href="../css/Admin.css">

</head>
<body class="admin">
    <div class="login">
        <h1 >Login</h1>
<?php
 if(isset($_SESSION['login']))
 {
     echo $_SESSION['login'];//displaying session message
     unset($_SESSION['login']);//removing session message
 }
 if(isset($_SESSION['no-login-msg']))
 {
     echo $_SESSION['no-login-msg'];//displaying session message
     unset($_SESSION['no-login-msg']);//removing session message
 }
?>
<br />
        <br/>
        <br/>
        <!--login stars here-->
        <form action=""method="POST" class="text-center">
         USERNAME:
          <input type="text"   name="UserName"placeholder="Enter username">
         <br />
         <br/>
         PASSWORD:
         <input type="password"name="Password"placeholder="Enter password">
         <br />
         <br />
         <input type="submit" name="submit" value="Login"class="btn-primary">
         <br/>
         <br/>
  </form>
</div>
</body>
</html>
<?php
//check whether submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.get the data from login form
    $UserName=$_POST['UserName'];
   $Password=($_POST['Password']);
   //2.sql to chech whether the user with username and password exist or not
   $sql="SELECT *FROM tbl_admin WHERE UserName='$UserName'AND Password='$Password'";
   //3.execute query
   $res=mysqli_query($conn,$sql);
   //4.count rows whether user exist or not
   $count=mysqli_num_rows($res);
   //check whether we have  admin data or not
   if($count==1)
   {
       //user available and login success
       $_SESSION['login'] = "<div class='sucess'>login  successfully</div>";
       $_SESSION['user']= $UserName;//check whether user is loged in or not and logout will unset it
       //Redirecting page home page
    header("location:".SITEURL.'Admin/');

   }
   else{
       //user not available and login fail
        
         $_SESSION['login'] = "<div class='error text-center'>login Fail</div>";
         //Redirecting page login page
      header("location:".SITEURL.'Admin/login.php');
   }
}
?>