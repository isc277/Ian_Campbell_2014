<?php
session_start();

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>University Textbook Exchange</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!--[if IE 7]>
			<link rel="stylesheet" href="css/ie7.css" type="text/css" />
		<![endif]-->
	</head>
	<div class="body">
		<body>
			<div class="page">
				<div class="header">
					<ul>
						<li><a href="index.php">home</a></li>
						<li><a href="about.php">about</a></li>
						<li><a href="proj4page.php">search for book</a></li>
						
<?php 
	if($_SESSION['isValidated'] == false){
		echo "<li><a href= 'userLogin.php' >log in</a></li>";
	} else {
		echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
		echo "<li> <a href='sellBook.php'>sell book</a></li>";
		echo "<li class = 'selected'> <a href='mySales.php'>my sales</a></li> ";
		echo "<li> <a href='logout.php'>log out</a></li></ul>";
		echo "</div></div>";
	}
		
	if ($_SESSION['isValidated']){	
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
           // @param hostname  For php.radford.edu, use 'localhost'
           // @param username  your RU userid
           // @param password  the *database* password.

		mysql_select_db('proj4');
		
		if(isset($_GET['deleteSaleID'])){
			deleteFromSales($_GET['deleteSaleID']);
		}
 
		$query = "SELECT * FROM Sales INNER JOIN Textbooks using(ISBN) WHERE Username = '{$_SESSION['userName']}'";
		$results = mysql_query($query);
	
		mysql_close();
		
		populate($results);
	} else {
		echo "<h2>Please log in to list a book for sale.</h2><br />";
		echo "<input type='button'  class='button' value='Log In' onClick=\"parent.location='userLogin.php'\"/>";
	}
	
	
	function deleteFromSales($saleID){
		
		$deleteQuery = "DELETE FROM Sales
				WHERE SaleID = '$saleID'";
		
		mysql_query($deleteQuery);
		
	}

function populate($results){
	if (mysql_num_rows($results) == 0){
		echo "<h2>Your currently have 0 books for sale.</h2>";
		echo "<input type='button'  class='button' value='List an Item' onClick=\"parent.location='sellBook.php'\"/>";
	} else {
		echo "	<table border = '5'>
		<tr>
			<th>ISBN</th>
			<th>SaleID</th>
			<th>Condition</th>
			<th>Price</th>
			<th>Title</th>
			<th>Author</th>
			<th>Subject</th>
			<th>Publisher</th>
			<th>Year</th>
			<th>Remove Sale</th>
		</tr>\n";
			
		while ($oneRow = mysql_fetch_array($results)) { 
			echo "		<tr>\n";
			echo "			<td>", $oneRow['ISBN'], "</td>\n";
			echo "			<td>", $oneRow['SaleID'], "</td>\n";
			echo "			<td>", $oneRow['Condition'], "</td>\n";
			echo "			<td>", $oneRow['Price'], "</td>\n";
			echo "			<td>", $oneRow['Title'], "</td>\n";
			echo "			<td>", $oneRow['Author'], "</td>\n";
			echo "			<td>", $oneRow['Subject'], "</td>\n";
			echo "			<td>", $oneRow['Publisher'], "</td>\n";
			echo "			<td>", $oneRow['Year'], "</td>\n";
			if($_SESSION['isValidated']){
				echo "			<td><a href = 'mySales.php?deleteSaleID={$oneRow['SaleID']}'>Remove Sale</a></td>";
			}
			echo "		</tr>\n";
			}
		echo "</table>";
	}
			
}
?>
				</div>
			</div>
		</body>
	</div>
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
