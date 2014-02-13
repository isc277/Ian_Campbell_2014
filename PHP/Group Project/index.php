<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<?php





session_start();



if($_SESSION['isValidated'] != true) {
session_register('sessionUserName');
session_register('isValidated');
session_register('userEmail');
session_register('isAdmin');
$_SESSION['isAdmin'];
}



?><head>
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
					<li class="selected"><a href="index.php">home</a></li>
					<li><a href="about.php">about</a></li>
					<li><a href="proj4page.php">search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >log in</a></li></ul>";
                 }
                 else{
               if( $_SESSION['isAdmin'] ) {
             echo "<li> <a href='admin.php'>admin</a></li>";  	 	 
                 	 	 
                 	 }
  echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
  echo "<li> <a href='sellBook.php'>sell book</a></li>";
    echo "<li> <a href='mySales.php'>my sales</a></li> ";
  echo "<li> <a href='logout.php'>log out</a></li></ul>";
 
  		 }
  		 
  		 
  		 
  		 
  ?>
  
					
			</div>
			<div class="body">
				<div id="featured">
					<h3>University Text Book Exchange</h3>
					<p> Are you tired of paying top dollar for your textbooks? Sick of the low return rate of the official bookstores? This website is your go-to place to buy and sell textbooks and save your hard-earned cash.</p>
					<input type="button" value="Browse now" onClick="parent.location='proj4page.php'"/>
				</div>
				
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
					<?php echo $_SESSION['userName'];?>
				</div>
			</div>
	</body>
</html>  