<?php
session_start();
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>University Textbook Exchange</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		
		<script type = 'text/javascript'>
			function clearText(){
				document.searchform.searchtext.value = "";
			}
			
			function validate(){
				var x = document.forms["searchform"]["searchtext"].value;
				var y = document.getElementById('error');
				if ((x == "") || (x == "Enter Items to Search")){
					y.style.visibility = "visible";
					return false;	
				}
			}
		</script>
		<style>
			.additional-info {font-style: italic; color: red}
		</style>
	</head>
	<div class="page">
			<div class="header">
				
				<ul>
					<li><a href="index.php">home</a></li>
					<li><a href="about.php">about</a></li>
					<li><a href="proj4page.php">search for book</a></li>
<?php 
	if($_SESSION['isValidated'] == false){
		echo "<li><a href= 'userLogin.php' >Log in</a></li></ul>";
	} else{
		echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
		echo "<li class = 'selected'> <a href='sellBook.php'>sell book</a></li>";
		echo "<li> <a href='mySales.php'>my sales</a></li> ";
		echo "<li> <a href='logout.php'>log out</a></li></ul>";
	}
?>
  </div>
  </div>
  <div class = "body">
		

  <h3 class = "important"> Sell A Textbook: Search<h3>
		<form action = 'sellBookResults.php' method = 'post' name = 'searchform' onsubmit = 'return validate()'>
			<input type ='text' name = 'searchtext' value = 'Search for book to sell' onclick = 'clearText()' class= "textbox" /> 
			<span class = 'additional-info' id = 'error' style = "visibility:hidden">
				Please enter something to search
			</span>
			<br />
			<input type = 'submit' value = 'Search' class = "button" />
			<input type = 'reset' value = 'Clear Form' class = "button" />
		</form>
	</body>
	
	<div class="footer">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search</a></li>
					>
				</ul>
				<p>&#169; Copyright &#169; 2012. University Textbook Exchange all rights reserved</p>
				<div class="connect">
					<a href="http://facebook.com/UniversityTextbookExchange" id="facebook">facebook</a>
					<a href="http://twitter.com/UniversityTextbookExchange" id="twitter">twitter</a>
					<a href="http://www.youtube.com/UniversityTextbookExchange" id="vimeo">vimeo</a>
					<?php echo  $_SESSION['userName'];?>
				</div>
			</div>
	
</html>
