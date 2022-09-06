<?php include('config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login and Register page</title>
    <!--<link rel="stylesheet" href="style7.css">-->
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>
<style>
*
{

    margin: 0;

    padding: 0;

    box-sizing: border-box;

}

.full-page

{

    height: 100vh;

    width: 100%;

    background: coral;
	position: absolute;

}

.sub-page

{

    width: 1266px;

    height: 559px;

    position: absolute;

    background: url(food.jpg);

    background-size: cover;

    background-position: center;

    left: 50px;

    top: 50px;

}

.navigation-bar

{

    display: flex;

    align-items: center;

    padding: 20px;

    padding-left: 80px;

    padding-right: 30px;

    padding-top: 50px;

}

.logo

{

    position: fixed;

    margin-top: 10px;

}

.logo a

{

    text-decoration: none;

    color: white;

    font-size: 30px;

}

nav

{

    flex: 1;

    position: fixed;

    right: 0;

}

nav ul 

{

    display: inline-block;

    list-style: none;

}

nav ul li

{

    display: inline-block;

    margin-right: 90px;

    margin-top: 17px;

}

nav ul li a

{

    text-decoration: none;

    font-size: 20px;

    color: white;

    font-family: sans-serif;

}

nav ul li a:hover

{

    color: saddlebrown;

}

.row

{

    display: flex;

    align-items: center;

    flex-wrap: wrap;

    justify-content: space-around;

}

.col-1

{

    flex-basis: 50%;

    min-width: 300px;

}

.form-box

{

    width: 300px;

	height: 400px;

	position: relative;

    top: 50px;

    left: 120px;

	background: rgba(0,0,0,0.6);

}

.main-heading

{

    color: orangered;

    padding-bottom: 20px;

}

.form

{

	position: relative;

	margin: 0 auto 100px;

	padding: 45px;

    text-align: center;

}

.form input

{

	font-family: sans-serif;

	outline: none;

    border: none;

    border-bottom: 1px solid black;

	width: 100%;

	margin: 0 0 15px;

	padding: 15px;

	font-size: 14px;

}

.form button

{

	font-family: sans-serif;

	width: 100%;

    color: white;

	font-size: 14px;

	cursor: pointer;

	padding: 15px;

    border: none;

    background: coral;

}

.form .message

{

    font-size: 12px;

	margin: 15px 0 0;

    color: white;

}

.form .message a

{

	color: orangered;

	text-decoration: none;

}

.form .register-form{

	display: none;

}

.defination

{

    text-align: left;

    font-size: 30px;

    color: white;

    font-family: 'Kaushan Script', cursive;

    padding-left: 60px;

}




</style>

<body>
   
        
    <div class="full-page">
        <div class="sub-page">
            <div class="navigation-bar">
                <div class="logo">
                    <!--<a href='photography.html'>Seek Coding</a>-->
                </div>
                
            </div>
            <div class="row">
                <div class="col-1">
                    <div class="form-box">
                        <div class="form">
                            <form class="login-form">
                                <center><h1 class="main-heading">Login Form</h1></center>
				                <input type="text" name="UserName" placeholder="user name" />
				                <input type="password" name="Password" placeholder="password"/>
				                <button>LOGIN</button>
                                <!--<input type="submit" name="submit"  value="LOGIN">-->
				                <p  class="message">Not Registered? <a href="#">Register</a></p>
				            </form>
                            <form class="register-form">
                                <center><h1 class="main-heading">Register Form</h1></center>
				                <input type="text" name="UserName"  placeholder="user name"/>
				                <input type="text" name="Email_id"  placeholder="email-id"/>
				                <input type="password" name="Password"  placeholder="password"/>
				                <<button> REGISTER</button>
				                <p class="message">Already Registered?<a href="#">Login</a>
				                </p>
				            </form>
			             </div>
	                </div>
                </div>
                <div class="col-1">
                    <!--<p class='defination'>Login and Registration Form Using<br> HTML,CSS And Javascript For More<br>Videos Please Subscribe<br>-----Seek Coding</p>-->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js">
    </script>
    <script>
        $('.message a').click(function(){$('form').animate({height: "toggle",opacity: "toggle"},"slow");});
    </script>
    </form>
</form>
</body>
</html>

