


<?php
session_start();


?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
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
					<li ><a href="index.php">home</a></li>
					<li class = "selected"><a href="about.php">about</a></li>
					<li><a href="proj4page.php">search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >log in</a></li></ul>";
                 }
                 else{
  
  echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
   echo "<li> <a href='sellBook.php'>sell book</a></li>";
   echo "<li> <a href='mySales.php'>my sales</a></li> ";
  echo "<li> <a href='logout.php'>log out</a></li></ul>";
  
  		 }
  ?>
  
					
			</div>
			<div class="body">
				
				<h3>We make textbook trading easy!</h3>
				<p>We make it easy to find afforable textbooks for your scholastic needs. You may find new and used books of all categories for sale. If you want, you can get started and <a href="proj4page.php">search for book now!</a>. </p>
				
				<h3>Sell your old books!</h3>
				<p>Looking to get rid of old textbooks? Go to our marketplace and <a href="sellBook.php">make a listing.</a> You can get back some of your hard earned money!</p>
				
				<h3>Textbook Exchange</h3>
				<p> We hope that our website meets your needs and helps you save money!</p>
					
				<h3>User Benefits</h3>
				<p>You can <a href="UserRegister.php">register today</a> to be a part of our growing community and reap the benefits of affordable literature!</p>
				</div>
			<div class="footer">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search</a></li>
					>
				</ul>
				<p>&#169; Copyright &#169; 2011. University Textbook Exchange all rights reserved</p>
				<div class="connect">
					<a href="http://facebook.com/UniversityTextbookExchange" id="facebook">facebook</a>
					<a href="http://twitter.com/UniversityTextbookExchange" id="twitter">twitter</a>
					<a href="http://www.youtube.com/UniversityTextbookExchange" id="vimeo">vimeo</a>
					 <?php echo $_SESSION['userName']; ?>
					 
				</div>
			</div>
		</div>
	</body>
</html>  
