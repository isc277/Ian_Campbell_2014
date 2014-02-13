<?php
	include_once('headcss.php');

	session_start();

	if ($_SESSION['isAdmin'] == true){
		if (array_key_exists('i-came-from-form', $_POST)){
			if ($_POST['options'] == 'Sale'){
				sale();
			} elseif ($_POST['options'] == 'User'){
				user();
			} elseif ($_POST['options'] == 'Book'){
				book();
			} elseif ($_POST['options'] == 'Purchases'){
				purchase();
			}
			
		} elseif (isset($_GET['deleteUser'])){
			deleteUser($_GET['deleteUser']);
			user();
		
		} elseif (isset($_GET['deleteSale'])){
			deleteSale($_GET['deleteSale']);
			sale();

		} elseif (isset($_GET['deleteBook'])){
			deleteBook($_GET['deleteBook']);
			book();			
			
		} else {
			admin();
			
		}
	} else {
		echo "<h1>FORBIDDEN!</h1>";
		echo "<meta http-equiv='refresh' content='1 ; url=index.php'>";
	}


	
	function admin(){
		echo "
	
	<body>
		<h1>Welcome Administrator</h1>
		<h2>What would you like to do?</h2>
		<form action = 'admin.php' method = 'post' name = 'adminForm'>
			<input type = 'radio' name = 'options' value = 'User' checked = 'true'/>Delete User
			<br />
			<input type = 'radio' name = 'options' value = 'Sale' />Delete Sale
			<br />
			<input type = 'radio' name = 'options' value = 'Book' />Delete Book
			<br />
			<input type = 'radio' name = 'options' value = 'Purchases' />View Purchases
			<br />
			<input type = 'submit' value = 'Go' class = 'button'/>
			<input type='hidden' name='i-came-from-form' value='true' />
		</form>";
	
	}
	
	function user(){
		echo "<html>
	<head>
		<title>Administrator</title>
	</head>
	<body>
		<h1>Users</h2>";
		
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "SELECT Username, Privileges FROM Users";
		
		$allRows = mysql_query($query);
		
		mysql_close();
		
		if (mysql_num_rows($allRows) == 0){
			echo "<p>There are no users in the database</p>";
		} else {
			echo "	<table border = '5'>
				<tr>
					<th>Username</th>
					<th>Privileges</th>
					<th>Delete User</th>
				</tr>\n";
			while ($oneRow = mysql_fetch_array($allRows)) { 
				echo "		<tr>\n";
				echo "			<td>", $oneRow['Username'], "</td>\n";
				echo "			<td>", $oneRow['Privileges'], "</td>\n";
				echo "			<td><a href = 'admin.php?deleteUser={$oneRow['Username']}'>Delete</a></td>";
				echo "		</tr>\n";
			}
			echo "	</table>";
		}

	}
	
	function deleteUser($username){
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "DELETE FROM Users WHERE Username = '$username'";
		$query2 = "DELET FROM UserInfo WHERE Username = '$username'";
		
		mysql_query($query);
		mysql_query($query2);
		
		mysql_close();
	}
	
	function sale(){
				echo "<html>
	<head>
		<title>Administrator</title>
	</head>
	<body>
		<h1>Sales</h2>";
		
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "SELECT * FROM Sales";
		
		$allRows = mysql_query($query);
		
		mysql_close();
		
		if (mysql_num_rows($allRows) == 0){
			echo "<p>There are no sales in the database</p>";
		} else {
			echo "	<table border = '5'>
				<tr>
					<th>SaleID</th>
					<th>ISBN</th>
					<th>Condition</th>
					<th>Price</th>
					<th>Username</th>
					<th>Delete Sale</th>
				</tr>\n";
			while ($oneRow = mysql_fetch_array($allRows)) { 
				echo "		<tr>\n";
				echo "			<td>", $oneRow['SaleID'], "</td>\n";
				echo "			<td>", $oneRow['ISBN'], "</td>\n";
				echo "			<td>", $oneRow['Condition'], "</td>\n";
				echo "			<td>", $oneRow['Price'], "</td>\n";
				echo "			<td>", $oneRow['Username'], "</td>\n";
				echo "			<td><a href = 'admin.php?deleteSale={$oneRow['SaleID']}'>Delete</a></td>";
				echo "		</tr>\n";
			}
			echo "	</table>";
		}

	}
	
	function deleteSale($saleID){
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "DELETE FROM Sales WHERE SaleID = '$saleID'";
		
		mysql_query($query);
		
		mysql_close();
	}
	
	function book(){
						echo "<html>
	<head>
		<title>Administrator</title>
	</head>
	<body>
		<h1>Books</h2>";
		
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "SELECT * FROM Textbooks";
		
		$allRows = mysql_query($query);
		
		mysql_close();
		
		if (mysql_num_rows($allRows) == 0){
			echo "<p>There are no textbooks in the database</p>";
		} else {
			echo "	<table border = '5'>
				<tr>
					<th>ISBN</th>
					<th>Title</th>
					<th>Author</th>
					<th>Subject</th>
					<th>Publisher</th>
					<th>Year</th>
					<th>Delete Sale</th>
				</tr>\n";
			while ($oneRow = mysql_fetch_array($allRows)) { 
				echo "		<tr>\n";
				echo "			<td>", $oneRow['ISBN'], "</td>\n";
				echo "			<td>", $oneRow['Title'], "</td>\n";
				echo "			<td>", $oneRow['Author'], "</td>\n";
				echo "			<td>", $oneRow['Subject'], "</td>\n";
				echo "			<td>", $oneRow['Publisher'], "</td>\n";
				echo "			<td>", $oneRow['Year'], "</td>\n";
				echo "			<td><a href = 'admin.php?deleteBook={$oneRow['ISBN']}'>Delete</a></td>";
				echo "		</tr>\n";
			}
			echo "	</table>";
		}

	}
	
	function deleteBook($ISBN){
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$querySales = "SELECT * FROM Sales WHERE ISBN = '$ISBN'";
		$deleteQuery = "DELETE FROM Textbooks WHERE ISBN = '$ISBN'";
		
		$allRows = mysql_query($querySales);
		
		if (mysql_num_rows($allRows) == 0){
			mysql_query($deleteQuery);
		} else {
			echo "Cannot delete textbook because at least one user has a sale for that textbook";
		}

		mysql_close();
		
	}
	
		function purchase(){
						echo "<html>
	<head>
		<title>Administrator</title>
	</head>
	<body>
		<h1>Purchases</h2>";
		
		$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		$query = "SELECT * FROM ShippingAndPayments";
		
		$allRows = mysql_query($query);
		
		mysql_close();
		
		if (mysql_num_rows($allRows) == 0){
			echo "<p>There are no purchases in the database</p>";
		} else {
			echo "	<table border = '5'>
				<tr>
					<th>Name</th>
					<th>Address</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Country</th>
					<th>SaleID</th>
					<th>ISBN</th>
					<th>Condition</th>
					<th>Price</th>
					<th>Username</th>
				</tr>\n";
			while ($oneRow = mysql_fetch_array($allRows)) { 
				echo "		<tr>\n";
				echo "			<td>", $oneRow['fullname'], "</td>\n";
				echo "			<td>", $oneRow['address'], "</td>\n";
				echo "			<td>", $oneRow['city'], "</td>\n";
				echo "			<td>", $oneRow['state'], "</td>\n";
				echo "			<td>", $oneRow['zipcode'], "</td>\n";
				echo "			<td>", $oneRow['country'], "</td>\n";
				echo "			<td>", $oneRow['SaleID'], "</td>\n";
				echo "			<td>", $oneRow['ISBN'], "</td>\n";
				echo "			<td>", $oneRow['Condition'], "</td>\n";
				echo "			<td>", $oneRow['Price'], "</td>\n";
				echo "			<td>", $oneRow['Username'], "</td>\n";
				echo "		</tr>\n";
			}
			echo "	</table>";
		}
		
     
	 
	}
	
	include('footercss.php');
?>

