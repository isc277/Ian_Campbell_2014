<?php
session_start();
	/*
	$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
           // @param hostname  For php.radford.edu, use 'localhost'
           // @param username  your RU userid
           // @param password  the *database* password.

	mysql_select_db('proj4');
	
	$query = "SELECT * FROM Textbooks WHERE Subject = 'ITEC'";
	
	$allRows = mysql_query($query);
	
	echo "	<table border = '5'>
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Subject</th>
			<th>Publisher</th>
			<th>Year</th>
		</tr>\n";
	while ($oneRow = mysql_fetch_array($allRows)) { 
		echo "		<tr>\n";
		echo "			<td>", $oneRow['ISBN'], "</td>\n";
		echo "			<td>", $oneRow['Title'], "</td>\n";
		echo "			<td>", $oneRow['Author'], "</td>\n";
		echo "			<td>", $oneRow['Subject'], "</td>\n";
		echo "			<td>", $oneRow['Publisher'], "</td>\n";
		echo "			<td>", $oneRow['Year'], "</td>\n";
		echo "		</tr>\n";
		//echo "Subject:  ", $oneRow['Subject'], "  Description:  ",  $oneRow['Description'], "<br />";
	}
	
	echo "	</table>";
           
	
	mysql_close();
	*/
?>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>University Textbook Exchange</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
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
					<li class = "selected"><a href="proj4page.php">search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >log in</a></li></ul>";
                 }
                 else{
 
   echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
    echo "<li> <a href='sellBook.php'>sell book</a></li>";
    echo "<li> <a href='mySales.php'>my sales</a></li>";
  echo "<li> <a href='logout.php'>log out</a></li></ul>";
  
  		 }
  ?>
  </div>
  </div>
  <div class = "body">
  <h3 class = "important"> <em> Textbook Search</em><h3>
		<form action = 'proj4server.php' method = 'post' name = 'searchform' onsubmit = 'return validate()'>
		<input type ='text' name = 'searchtext' value = 'Enter Items to Search' onclick = 'clearText()' class= "textbox" />
		
		 
			<span class = 'additional-info' id = 'error' style = "visibility:hidden">
				Please enter something to search
			</span>
			<!--
			<select name = 'Category'>
				<option name = 'ISBN'>ISBN</option>
				<option name = 'Title'>Title</option>
				<option name = 'Author'>Author</option>
				<option name = 'Subject'>Subject</option>
				<option name = 'Publisher'>Publisher</option>
				<option name = 'Year'>Year</option>
			</select>
			-->
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
					
				</ul>
				<p>&#169; Copyright &#169; 2011. University Textbook Exchange all rights reserved</p>
				<div class="connect">
					<a href="http://facebook.com/UniversityTextbookExchange" id="facebook">facebook</a>
					<a href="http://twitter.com/UniversityTextbookExchange" id="twitter">twitter</a>
					<a href="http://www.youtube.com/UniversityTextbookExchange" id="vimeo">vimeo</a>
					<?php echo $_SESSION['userName'];?>
				</div>
			</div>
	
</html>
