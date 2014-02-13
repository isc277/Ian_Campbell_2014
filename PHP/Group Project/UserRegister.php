<?php
session_start();

	$errMsgs = array();
	
	if (array_key_exists('i-came-from-form', $_POST)){
	
		$_POST = tidyArray($_POST);
	
		if (empty($_POST['username'])) {
			$errMsgs['username'] = 'Username is required.';
		} else {
			$error = validUsername($_POST['username']);
			if(isset($error)){
				$errMsgs['username'] = $error;
			}
		}
		
		if (empty($_POST['password1'])) {
			$errMsgs['password1'] = 'Please enter a password.';
		}
		
		if ($_POST['password1'] !== $_POST['password2']) {
			$errMsgs['password2'] = 'Passwords do not match.';
		} else {
			$error = validPass($_POST['password1']);
			if(isset($error)){
				$errMsgs['password1'] = $error;
			}
		}
	
		if (empty($_POST['fName'])) {
			$errMsgs['fName'] = 'First name is required.';
		}
		
		if (empty($_POST['lName'])) {
			$errMsgs['lName'] = 'Last name is required.';
		}
		
		if (empty($_POST['email'])) {
			$errMsgs['email'] = 'Please enter an email.';
		} else {
			$error = validEmail($_POST['email']);
			if(isset($error)){
				$errMsgs['email'] = $error;
			}
		}
		
		if (empty($_POST['address1']) && empty($_POST['address2'])) {
			$errMsgs['address'] = 'Please enter an Address.';
		}
		
		if (empty($_POST['city'])) {
			$errMsgs['city'] = 'Please enter a city.';
		} 
		
		if (empty($_POST['state'])) {
			$errMsgs['state'] = 'Please enter a state.';
		} else {
			$error = validState($_POST['state']);
			if(isset($error)){
				$errMsgs['state'] = $error;
			}
		}
		
		if (empty($_POST['zip'])) {
			$errMsgs['zip'] = 'Please enter a zip code.';
		} else {
			$error = validZip($_POST['zip']);
			if(isset($error)){
				$errMsgs['zip'] = $error;
			}
		}
	}
	
	$formIsValid = array_key_exists('i-came-from-form', $_POST)  && !$errMsgs;
	
?>

<html>
	<head>
	
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>University Textbook Exchange</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		
	
	
	
	
	
	
		<title><?php echo $formisValid ? "Registered!" : "New User Registration"; ?></title>
		<style type = 'text/css'>
			.right {text-align: right}
			.center {text-align:center;}
			.info {font-style: italic; font-size: smaller}
		</style>
		<script type = 'text/javascript'>
			function clearForm(){
				document.forms["registrationForm"]["username"].value = "";
				document.forms["registrationForm"]["password1"].value = "";
				document.forms["registrationForm"]["password2"].value = "";
				document.forms["registrationForm"]["fName"].value = "";
				document.forms["registrationForm"]["lName"].value = "";
				document.forms["registrationForm"]["email"].value = "";
				document.forms["registrationForm"]["address1"].value = "";
				document.forms["registrationForm"]["address2"].value = "";
				document.forms["registrationForm"]["city"].value = "";
				document.forms["registrationForm"]["state"].value = "";
				document.forms["registrationForm"]["zip"].value = "";
			}
		</script>
		
		
		<div class="page">
			<div class="header">
				
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >Log in</a></li></ul>";
                 }
                 else{
 
   echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
   echo "<li class = 'selected'> <a href='sellBook.php'>sell book</a></li>";
     echo "<li> <a href='mySales.php'>my sales</a></li> ";
  echo "<li> <a href='logout.php'>Log Out?</a></li></ul>";
  		 }
  ?>
  </div>
	</head>
	
	<body>
	
<?php
		if ($formIsValid) {
			
			$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			   // @param hostname  For php.radford.edu, use 'localhost'
			   // @param username  your RU userid
			   // @param password  the *database* password.
			   
			mysql_select_db('proj4');
		
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password1']);
			$fname = mysql_real_escape_string($_POST['fName']);
			$lname = mysql_real_escape_string($_POST['lName']);
			$email = mysql_real_escape_string($_POST['email']);
			$address1 = mysql_real_escape_string($_POST['address1']);
			$address2 = mysql_real_escape_string($_POST['address2']);
			$city = mysql_real_escape_string($_POST['city']);
			$state = mysql_real_escape_string($_POST['state']);
			$zip = mysql_real_escape_string($_POST['zip']);
			
			$insertUsersQuery = "INSERT INTO
				Users (Username, Password, Privileges)
				VALUES ('$username', '$password', '0')";
				
			$insertUserInfoQuery = "INSERT INTO
				UserInfo (Username, First, Last, email, Address1, Address2, City, State, Zip)
				VALUES('$username', '$fname', '$lname', '$email', '$address1', '$address2', 
				'$state', '$city', '$zip')";
				
			//echo $insertUsersQuery, $insertUserInfoQuery;
			
			$valid1 = mysql_query($insertUsersQuery);
			
			$valid2 = mysql_query($insertUserInfoQuery);
			
			if ($valid1 && $valid2){
				
				
				$to = $_POST['email'];
 $subject = "Registration Successful!";
 $body = "Hello " . $_SESSION['userName'] . ",\n\n Thank you for signing up for University Textbook Exchange. You can get started by visiting https://php.radford.edu/~proj4/userLoginPage.php . \n\n Sincerely, \n\n The UTE Team";
 if (mail($to, $subject, $body)) {
   echo("<p>Message successfully sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
  }
				
			}
			
			mysql_close();
		
			echo "<h1>Registered</h1>\n";
			echo "<p>You are now registered!</p>";
			echo "</body>";
			echo "</html>";
			
			echo "<meta http-equiv='refresh' content='5 ; url=userLoginPage.php'>";
			
		// NOTE:
		// Another common technique, even *before* printing out *any* html/head/title,
		// is to call   header('Location: form-success.php'), and then exit();.
		//    -- this causes the client to forward to a different page instead.
		// That way, this file can focus on the form and validation,
		// and handling-a-correct-form can be entirely shifted to a different file.
		//
		// It also keeps the remainder of this file from being indented inside a php `else`.
		//
		// 'require' can also achieve these goals.

		} elseif ($errMsgs) {
			echo "<h1 class = 'center'>Registration failed</h1>\n";
			/*echo "<p class='error'>\n";
			foreach ($errMsgs AS $field => $problem) {
				echo "Problem with $field: $problem<br />\n";
			}
			echo "Please re-enter the information.";
			echo "</p>\n";
			*/
			echo "<div class='center'>
						<h1>New User Registration</h1>
						<h2>Please Enter Required Information:</h2>
						<form action = 'UserRegister.php' method = 'post' name = 'registrationForm' onsubmit = ''>
				
							<table>
								<tr>
									<td class = 'right'>*Username:<br /></td>
									<td><input type = 'text' size = '20' name = 'username' value = '{$_POST[username]}' />
										<span style = 'color: red'>{$errMsgs[username]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>**Password:</td>
									<td><input type = 'password' size = '20' name = 'password1' />
										<span style = 'color: red'>{$errMsgs[password1]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Confirm Password:</td>
									<td><input type = 'password' size = '20' name = 'password2' />
										<span style = 'color: red'>{$errMsgs[password2]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>First Name:</td>
									<td><input type = 'text' size = '20' name = 'fName'  value = '{$_POST[fName]}'/>
										<span style = 'color: red'>{$errMsgs[fName]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Email:</td>
									<td><input type = 'text' size = '20' name = 'email' value = '{$_POST[email]}' />
										<span style = 'color: red'>{$errMsgs[email]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Last Name:</td>
									<td><input type = 'text' size = '20' name = 'lName' value = '{$_POST[lName]}' />
										<span style = 'color: red'>{$errMsgs[lName]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Address Line 1:</td>
									<td><input type = 'text' size = '50' name = 'address1' value = '{$_POST[address1]}' />
										<span style = 'color: red'>{$errMsgs[address]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Address Line 2:</td>
									<td><input type = 'text' size = '50' name = 'address2' value = '{$_POST[address2]}' /></td>
								</tr>
								<tr>
									<td class = 'right'>City:</td>
									<td><input type = 'text' size = '20' name = 'city' value = '{$_POST[city]}' />
										<span style = 'color: red'>{$errMsgs[city]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>State:</td>
									<td><input type = 'text' size = '2' name = 'state' value = '{$_POST[state]}' />
										<span style = 'color: red'>{$errMsgs[state]}</span>
									</td>
								</tr>
								<tr>
									<td class = 'right'>Zip:</td>
									<td><input type = 'text' size = '5' name = 'zip' value = '{$_POST[zip]}' />
										<span style = 'color: red'>{$errMsgs[zip]}</span>
									</td>
								</tr>
							</table>
							<input type = 'submit' value = 'Register' class = 'button' />
							<input type = 'button' onclick = 'clearForm()' value = 'Clear Form' class = 'button'/>
							<input type='hidden' name='i-came-from-form' value='true' />
						</form>
						<span class = 'info'>
							*At least 4 characters and no more than 15 characters; Can only contain letters, 
							numbers and underscores (_).<br />
							**At least 6 character and no more than 15 characters.
						</span>
					</div>
				</body>
			</html>";
		}
		else {
			createSite();
		}

		function createSite(){
			echo "	<div class='center'>
						<h1>New User Registration</h1>
						<h2>Please Enter Required Information:</h2>
						<form action = 'UserRegister.php' method = 'post' name = 'registrationForm' onsubmit = ''>
				
							<table>
								<tr>
									<td class = 'right'>*Username:</td>
									<td><input type = 'text' size = '20' name = 'username' /></td>
								</tr>
								<tr>
									<td class = 'right'>**Password:</td>
									<td><input type = 'password' size = '20' name = 'password1' /></td>
								</tr>
								<tr>
									<td class = 'right'>Confirm Password:</td>
									<td><input type = 'password' size = '20' name = 'password2' /></td>
								</tr>
								<tr>
									<td class = 'right'>First Name:</td>
									<td><input type = 'text' size = '20' name = 'fName' /></td>
								</tr>
								<tr>
									<td class = 'right'>Last Name:</td>
									<td><input type = 'text' size = '20' name = 'lName' /></td>
								</tr>
								<tr>
									<td class = 'right'>Email:</td>
									<td><input type = 'text' size = '20' name = 'email' /></td>
								</tr>
								<tr>
									<td class = 'right'>Address Line 1:</td>
									<td><input type = 'text' size = '50' name = 'address1' /></td>
								</tr>
								<tr>
									<td class = 'right'>Address Line 2:</td>
									<td><input type = 'text' size = '50' name = 'address2' /></td>
								</tr>
								<tr>
									<td class = 'right'>City:</td>
									<td><input type = 'text' size = '20' name = 'city' /></td>
								</tr>
								<tr>
									<td class = 'right'>State:</td>
									<td><input type = 'text' size = '2' name = 'state' /></td>
								</tr>
								<tr>
									<td class = 'right'>Zip:</td>
									<td><input type = 'text' size = '5' name = 'zip' /></td>
								</tr>
							</table>
							<input type = 'submit' value = 'Register' />
							<input type = 'reset' value = 'Clear Form' />
							<input type='hidden' name='i-came-from-form' value='true' />
						</form>
						<span class = 'info'>
							*At least 4 characters and no more than 15 characters; Can only contain letters, 
							numbers and underscores (_).<br />
							**At least 6 character and no more than 15 characters.
						</span>
					</div>
					
				<div class='footer'>
				<ul>
					<li><a href='index.php'>Home</a></li>
					<li><a href='about.php'>About</a></li>
					<li><a href='proj4page.php'>Search</a></li>
					>
				</ul>
				<p>&#169; Copyright &#169; 2011. University Textbook Exchange all rights reserved</p>
				<div class='connect'>
					<a href='http://facebook.com/UniversityTextbookExchange' id='facebook'>facebook</a>
					<a href='http://twitter.com/UniversityTextbookExchange' id='twitter'>twitter</a>
					<a href='http://www.youtube.com/UniversityTextbookExchange' id='vimeo'>vimeo</a>
					
				</div>
			</div>
				</body>
			</html>";
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
	
	function validUsername($username){
		if (strlen($username) < 4 || strlen($username) > 15){
			return "Invalid Username: must be between 4 and 15 characters";
		} elseif (!preg_match('/^[A-Za-z0-9_]+$/', $username)){
			return "Invalid Username: can only contain letters, numbers and underscores(_)";
		} else {
			$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			   // @param hostname  For php.radford.edu, use 'localhost'
			   // @param username  your RU userid
			   // @param password  the *database* password.
			   
			mysql_select_db('proj4');
			
			$username = mysql_real_escape_string($username);
			
			$query = "SELECT * FROM Users 
				WHERE Username = '$username'";
			
			$allRows = mysql_query($query);
			
			mysql_close();
			
			if (mysql_num_rows($allRows) != 0){
				return "Username already taken.  Please try another";
			}
		}
	}
	
	function validPass($password){
		if (strlen($password) < 4 || strlen($password) > 15){
			return "Invalid Password: must be between 4 and 15 characters";
		} 
	}
	
	function validEmail($email){
		if (!preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@(([0-9a-zA-Z])+([-\w]*[0-9a-zA-Z])*\.)+[a-zA-Z]{2,9})$/', $email)){
			return "Invalid Email: must be in normal email format (xxxx@something.com)";
		}
	}
	
	function validState($state){
		if(strlen($state) > 2 || !preg_match('/^[A-Z]{2}$/', $state)){
			return "Invalid State: must be in postal format (VA, AL, etc)";
		}
	}
	
	function validZip($zip){
		if(!preg_match('/^\d{5}(-)?(\d{4})?$/', $zip)){
			return "Invalid Zip Code: must be in standard format (XXXXX or XXXXX-XXXX)";
		}
	}
	
?>