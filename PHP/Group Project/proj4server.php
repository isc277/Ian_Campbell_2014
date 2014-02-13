<html>
<?php session_start()
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
					<li class = "selected"><a href="proj4page.php">search for book</a></li>
					
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >Log in</a></li></ul>";
                 }
                 else{
  

   echo "<li> <a href='sellBook.php'>sell book</a></li>";
  
 echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
   echo "<li> <a href='logout.php'>log out?</a></li></ul>";
  echo "<br/>";
  		 }
  ?>
  






<?php
	
	if (isset($_POST['searchtext'])){
		query($_POST['searchtext']);
	} else {
		query($_GET['searchterm'], $_GET['order']);
	}
	
	
	
	function query($searchterm, $order){
	
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
           // @param hostname  For php.radford.edu, use 'localhost'
           // @param username  your RU userid
           // @param password  the *database* password.

		mysql_select_db('proj4');
		
		$words = explode(" ", $searchterm);
		
		$count = count($words);
		
		if (isset($words[1])){
			$words[$count] = $searchterm;
			$count++;
		}
	
		$query = "SELECT * 
			FROM Sales s 
			INNER JOIN Textbooks t
			USING (ISBN)
			WHERE ";
		
		
		for($i = 0; $i < $count; $i++){
			$query .= "t.ISBN LIKE '%{$words[$i]}%' OR
				t.Title LIKE '%{$words[$i]}%' OR 
				t.Author LIKE '%{$words[$i]}%' OR 
				t.Subject LIKE '%{$words[$i]}%' OR 
				t.Publisher LIKE '%{$words[$i]}%' OR
				t.Year LIKE '%{$words[$i]}%' OR 
				s.SaleID LIKE '%{$words[$i]}%' OR 
				s.Condition LIKE '%{$words[$i]}%' OR 
				s.Price LIKE '%{$words[$i]}%'";
			if ($i != ($count - 1)){
				$query .= " OR ";
			}
		}
		
		if (isset($order)){
			if ($order == "Title" || $order == "Author" ||
				$order == "Subject" || $order == "Publisher" ||
				$order == "Year"){
				$query .= " ORDER BY t.$order";
			} else {
				$query .= " ORDER BY s.$order";
			}
		} else {
			$query .= " ORDER BY t.Title";
		}
		
		$allRows = mysql_query($query);
		
		mysql_close();
		
		
		if (isset($order)){
			populate($allRows, $searchterm, $order);
		} else {
			populate($allRows, $searchterm, "Title");
		}
		
	}
	
	function populate($results, $searchterm, $order){
		if (mysql_num_rows($results) == 0){
			echo "<h2>Your Search Returned 0 Items</h2>";
			echo "<input type='button'  class='button' value='Search Again!' onClick=\"parent.location='proj4page.php'\"/>";
		} else {
		
			tableHeader($order, $searchterm);
			/*
			echo "	<table border = '5'>
			<tr>
				<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th>SaleID</th>
				<th>Condition</th>
				<th>Price</th>
				<th>Title</th>
				<th>Author</th>
				<th>Subject</th>
				<th>Publisher</th>
				<th>Year</th>
				<th>Purchase</th>
			</tr>\n";
			*/
			
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
				if($_SESSION['isValidated']){			echo "			<td><a href = 'shoppingCart.php?addSaleID={$oneRow['SaleID']}'>Add To Cart</a></td>";}
				echo "		</tr>\n";
			}
			echo "</table>";
		}
			
	}
	
	function tableHeader($order, $searchterm){
		echo "	<table border = 5>
		<tr>\n";
		if ($order == "ISBN"){
		
			echo "<th>ISBN</th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</a></th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
	if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
		}}
		
		elseif ($order == "SaleID"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th>SaleID</th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</a></th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
				if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}	
		
		 elseif ($order == "Condition"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th>Condition</th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</a></th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
		if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	            }
		}  	         
		
		 elseif ($order == "Price"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th>Price</th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>
				<th>Purchase</th>";
		
		} elseif ($order == "Title"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</a></th>
				<th>Title</th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
		if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}
		
		 elseif ($order == "Author"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th>Author</th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
			if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}
		
		 elseif ($order == "Subject"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th>Subject</th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
				if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}
		
		 elseif ($order == "Publisher"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th>Publisher</th>
				<th><a href = 'proj4server.php?order=Year&searchterm=$searchterm'>Year</a></th>";
				if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}
		
		 elseif ($order == "Year"){
		
			echo "<th><a href = 'proj4server.php?order=ISBN&searchterm=$searchterm'>ISBN</a></th>
				<th><a href = 'proj4server.php?order=SaleID&searchterm=$searchterm'>SaleID</a></th>
				<th><a href = 'proj4server.php?order=Condition&searchterm=$searchterm'>Condition</a></th>
				<th><a href = 'proj4server.php?order=Price&searchterm=$searchterm'>Price</th>
				<th><a href = 'proj4server.php?order=Title&searchterm=$searchterm'>Title</a></th>
				<th><a href = 'proj4server.php?order=Author&searchterm=$searchterm'>Author</a></th>
				<th><a href = 'proj4server.php?order=Subject&searchterm=$searchterm'>Subject</a></th>
				<th><a href = 'proj4server.php?order=Publisher&searchterm=$searchterm'>Publisher</a></th>
				<th>Year</th> ";
				if($_SESSION['isValidated']){			echo "<th>Purchase</th>";
	}
		}
		
		}
	
	 
	
	/*
	$query = "SELECT * 
		FROM Sales s 
		INNER JOIN Textbooks t
		USING (ISBN)
		WHERE t.ISBN LIKE '%{$_POST['searchtext']}%' OR
		t.title LIKE '%{$_POST['searchtext']}%' OR 
		t.Author LIKE '%{$_POST['searchtext']}%' OR 
		t.Subject LIKE '%{$_POST['searchtext']}%' OR 
		t.Publisher LIKE '%{$_POST['searchtext']}%' OR
		t.Year LIKE '%{$_POST['searchtext']}%' OR 
		s.SaleID LIKE '%{$_POST['searchtext']}%' OR 
		s.condition LIKE '%{$_POST['searchtext']}%' OR 
		s.Price LIKE '%{$_POST['searchtext']}%'";
	
	$allRows = mysql_query($query);
	
	
	if (mysql_num_rows($allRows) == 0){
			echo "<h2>Your Search Returned 0 Items</h2>";
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
				<th>Purchase</th>
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
			echo "			<td><a href = 'shoppingCart.php?addSaleID={$oneRow['SaleID']}'>Add To Cart</a></td>";
			echo "		</tr>\n";
			//echo "Subject:  ", $oneRow['Subject'], "  Description:  ",  $oneRow['Description'], "<br />";
		}
		echo "	</table>";
	}
    */ 
	
?>


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


</html>