<html>

<?php

	//include_once('header.php');
	session_start();
	$username = $_SESSION['userName'];
	
	
	if (isset($_GET['addSaleID'])){
		addToCart($_GET['addSaleID']);
	} elseif(isset($_GET['deleteSaleID'])){
		deleteFromCart($_GET['deleteSaleID']);
	}
	
	
	
	
	function addToCart($saleID){
	
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			   // @param hostname  For php.radford.edu, use 'localhost'
			   // @param username  your RU userid
			   // @param password  the *database* password.

		mysql_select_db('proj4');
		
		$insertQuery = "INSERT INTO
				Cart (SaleID, Username)
				VALUES('$saleID','{$_SESSION['userName']}')";
		
		mysql_query($insertQuery);
		
		mysql_close();
		
	}
	
	function deleteFromCart($saleID){
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			   // @param hostname  For php.radford.edu, use 'localhost'
			   // @param username  your RU userid
			   // @param password  the *database* password.

		mysql_select_db('proj4');
		
		$deleteQuery = "DELETE FROM Cart
				WHERE SaleID = '$saleID'";
		
		mysql_query($deleteQuery);
		
		mysql_close();
	}
	
	
	function populate($username){
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			   // @param hostname  For php.radford.edu, use 'localhost'
			   // @param username  your RU userid
			   // @param password  the *database* password.

		mysql_select_db('proj4');
		
		$selectQuery = "SELECT s.ISBN, s.SaleID, s.Condition, s.Price, 
			t.Title, t.Author, t.Subject, t.Publisher, t.Year
			FROM (Cart c 
			INNER JOIN Sales s
			USING(SaleID)) 
			INNER JOIN Textbooks t
			USING (ISBN)
			WHERE c.Username = '{$_SESSION['userName']}'";
		
		$allRows = mysql_query($selectQuery);
		
		if (mysql_num_rows($allRows) == 0){
			echo "<h2>Shopping Cart Empty</h2>";
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
					<th>Delete</th>
				</tr>\n";
			while ($oneRow = mysql_fetch_array($allRows)) { 
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
				echo "			<td><a href = 'shoppingCart.php?deleteSaleID={$oneRow['SaleID']}'>Delete</a></td>";
				echo "		</tr>\n";
			}
			echo "	</table>";
		}
		
		mysql_close();
	}
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
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >log in</a></li></ul>";
                 }
                 else{

  echo "<li class = 'selected'> <a href='shoppingCart.php'>view cart</a> </li>";
   echo "<li> <a href='sellBook.php'>sell book</a></li>";
     echo "<li> <a href='mySales.php'>my sales</a></li> ";
  echo "<li> <a href='logout.php'>log out</a></li></ul>";
  
  		 }
  ?>
  
<div class="body">
<h1> Shopping cart for <?php echo $_SESSION['userName'];?> </h1>

</div>

 <?php

	populate($username);

?>


</body>
<hr/>
<div style = "text-align:right">
<form action = "checkout.php" value = "post"/>
<input type="submit"value= "Check Out" class = "button" />

</form>
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
					<?php echo"logged in as " . $_SESSION['userName'];?>
				</div>
			</div>
</html>