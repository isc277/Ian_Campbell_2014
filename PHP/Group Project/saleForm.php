<?php

session_start();

	$errMsgs = array();
	
	if (array_key_exists('i-came-from-form', $_POST)){
	
		$_POST = tidyArray($_POST);
	
		if (empty($_POST['Price'])) {
			$errMsgs['Price'] = 'Price is required.';
		} else {
			$error = validPrice($_POST['Price']);
			if(isset($error)){
				$errMsgs['Price'] = $error;
			}
		}
		
	}
	
	$formIsValid = array_key_exists('i-came-from-form', $_POST)  && !$errMsgs;
	
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
	<body>
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
		echo "<li class='selected'> <a href='sellBook.php'>sell book</a></li>";
		echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
		echo "<li> <a href='logout.php'>log out?</a></li></ul>";
		echo "<br/>";
	}
?>
			</div>
		</div>

		<title><?php echo $formisValid ? "Text Book Selected!" : "Sell This Textbook"; ?></title>
		<style type = 'text/css'>
			.right {text-align: right}
			.center {text-align:center;}
			.info {font-style: italic; font-size: smaller}
		</style>
		<script type = 'text/javascript'>
			function clearForm(){
				document.forms["registrationForm"]["Price"].value = "";
				document.registrationForm.condition[0].checked = true;
			}
		</script>
	</head>
	
	</body>
	
<?php
		if ($formIsValid) {
		
			if (!preg_match('/\./', $_POST['Price'])){
				$_POST['Price'] .= ".00";
			}
			
			$saleID = randomAlphaNum();
			$valid = false;
			
			$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
					// @param hostname  For php.radford.edu, use 'localhost'
					// @param Price  your RU userid
					// @param Condition  the *database* Condition.
					
			mysql_select_db('proj4');
			
			while($valid != true){
				
				$query = "SELECT * FROM Sales WHERE SaleID = '$saleID'";
				
				$allRows = mysql_query($query);
				
				if (mysql_num_rows($allRows) == 0){
					$valid = true;
				} else {
					$saleID = randomAlphaNum();
				}
			}
			
			
			$price = mysql_real_escape_string($_POST['Price']);
			$condition = mysql_real_escape_string($_POST['condition']);
		
			
			$insertQuery = "INSERT INTO Sales
				VALUES ('$saleID', '{$_POST['ISBN']}', '$condition', 
				'$price', '{$_SESSION['userName']}')";
				
			//echo $insertQuery;	
			
			mysql_query($insertQuery);
			
			mysql_close();
			
		
			echo "<h1>Success!</h1>\n";
			echo "<p>Your book is now up for sale!</p>";
			echo "</body>";
			echo "</html>";			
			echo "<meta http-equiv='refresh' content='3 ; url=mySales.php'>";
	

		} elseif ($errMsgs) {
			echo "<h1>Information Not Filled Out Correctly</h1>\n";
			echo "<div>
						<h1>Sell This Textbook</h1>
						<h2>Please Enter Required Information:</h2>
						<form action = 'saleForm.php' method = 'post' name = 'registrationForm' onsubmit = ''>
				
							<table>
								<tr>
									<td class = 'right'>*Price: ($)<br /></td>
									<td><input type = 'text' size = '20' name = 'Price' value = '{$_POST[Price]}' />
										<span style = 'color: red'>{$errMsgs[Price]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>**Condition:</td>";
									
			if ($_POST['condition'] == 'NEW'){
				echo					"<td>
										<input type='radio' name='condition' value='NEW' id = 'newRadio' checked = 'true' />NEW<br />
										<input type='radio' name='condition' value='USED' /> USED
									</td>
								</tr>";
	
			} else {
				echo					"<td>
										<input type='radio' name='condition' value='NEW' id = 'newRadio'/>NEW<br />
										<input type='radio' name='condition' value='USED' checked = 'true' /> USED
									</td>
								</tr>";
				
			}
			echo "</table>
							<input type = 'submit' value = 'Submit' />
							<input type = 'button' onclick = 'clearForm()' value = 'Clear Form' />
							<input type='hidden' name='i-came-from-form' value='true' />
							<input type = 'hidden' name = 'ISBN' value = '{$_POST['ISBN']}' />
							<br />
							<span class = 'info'>*Please use standard format for currency (XXX.XX or XXX)</span>
						</form>
					</div>
				</body>";
		}
		else {
			createSite();
		}

		function createSite(){
			echo "	<div>
						<h1>Sell This Textbook</h1>
						<h2>Enter the following information regarding the book for sale: </h2>
						
						
						<form action = 'saleForm.php' method = 'post' name = 'registrationForm' onsubmit = ''>
				
							<table>
								<tr>
									<td class = 'right'>*Price: ($)</td>
									<td><input type = 'text' size = '20' name = 'Price' /></td>
								</tr>
								<tr>
									<td class = 'right'>Condition:</td>
									<td>
										<input type='radio' name='condition' value='NEW' id = 'newRadio' checked = 'true'/>NEW<br />
										<input type='radio' name='condition' value='USED' /> USED
									</td>
								</tr>
								
							</table>
							<input type = 'submit' value = 'Submit' class = 'button' />
							<input type = 'reset' value = 'Clear Form' class = 'button' />
							<input type= 'hidden' name= 'i-came-from-form' value= 'true' />
							<input type = 'hidden' name = 'ISBN' value = '{$_GET['textISBN']}' />
							<br />
							<span class = 'info'>*Please use standard format for currency (XXX.XX or XXX)</span>
						</form>
					</div>
				</body>";
			
		}
		
	/**
	* This function will take in a string, trim whitespace from the beginning and end
	* and collapse multiple spaces to one space.
	*/
	function tidySpaces($string) {
		if (is_array($string)){
			foreach($string as $item){
				tidySpaces($item);
			}
		} else {
			$string = trim($string);
			$string = preg_replace('/\s+/', ' ', $string);
		}
		return $string;
	}
	
	/**
	* This function will take in an array and perform the tidySpaces() function
	* on each member of the array.
	*/
	function tidyArray($stringArray) {
		foreach($stringArray as $string) {
			$string = tidySpaces($string);
		}
		return $stringArray;
	}
	
	function validPrice($Price){
		if (strlen($Price) > 6 || strlen($Price) < 1){
			return "Invalid Price: can only contain numbers, and must be in format XXX.XX or XXX";
		} elseif (!preg_match('/^\d+(\.\d{2})?$/', $Price)){
			return "Invalid Price: can only contain numbers, and must be in format XXX.XX or XXX";
		}
	}
	
	function randomAlphaNum(){ 
	
		$retVal = "";
		$values = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 
			'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S',
			'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
			
		for ($i = 0; $i < 20; $i++){
			$num = rand(0, 36);
			$retVal .= $values[$num];
		}

		return $retVal; 

	}	

	
?>

<div class="footer">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search</a></li>
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