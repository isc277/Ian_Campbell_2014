<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<?php
session_start();






?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>University Textbook Exchange</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
	</head>
	<body>
		<div class="page">
			<div class="header">
				
				<ul>
					<li><a href="index.php">home</a></li>
					<li><a href="about.php">about</a></li>
					<li><a href="proj4page.php">search for book</a></li>
					<li class = "selected"><a href="userLogin.php">log in</a></li>
					</ul>
			</div>
			<div class="body">
				<div id="featured">
					<h3>User Login</h3>
					<p> University Textbook Exchange will meet your needs for all your literary endeavors. Get started by logging in or signing up!</p>
					<br/>
					<form action = "userValidate.php" method = "post">
					User Name:<input type = "text" name = "userNametxt" class = "textbox" />
					
					<br/>
					Password: &nbsp <input type = "password" name="passwordtxt" class = "textbox"/><a href="forgotPassword.php">Forgot Password? </a>
					<br/>
					
					&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="submit"value= "Log in" />
                    <br/>
                    
                    <br/><br/> &nbsp
					</form>
					<br/>
                    <br/><br/>
				</div>
				
				
			</div>
		
		
			
			<div class="footer">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					
					<li><a href="userlogin.php">Log In</a></li>
				</ul>
				<p>&#169; Copyright &#169; 2011. University Textbook Exchange all rights reserved</p>
				
				<br/>
				
			</div>
		</div>
	</body>
</html>  
