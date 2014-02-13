<?php
session_start();




$password = '';















?>
<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>

<?php
session_start();






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
					<li class = "selected"><a href="userLogin.php">log in</a></li>
					</ul>
			</div>
			<div class="body">
				<div id="featured">
					<h3>Password Retrieval</h3>
					<p> Enter your email to get your password emailed to you.</p>
					<br/>
					<form action = "forgotPassword.php" method = "post">
					Email:<input type = "text" name = "emailtxt" class = "textbox" />
                     <br/>
                   	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="submit"value= "Get Password" />
                    <br/>
                    
                    <br/><br/> &nbsp
					</form>
					<br/>
                    <br/><br/>
				</div>
                
                
                
                
                
                
                
<?php

include('footercss.php');


$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
			// @param hostname  For php.radford.edu, use 'localhost'
			// @param Price  your RU userid
			// @param Condition  the *database* Condition.
					
		mysql_select_db('proj4');
		
		
if (isset($_POST['emailtxt'])){		
$email = mysql_real_escape_string($_POST['emailtxt']);
$password;
$query = "SELECT Password FROM Users u INNER JOIN UserInfo i USING(Username) WHERE i.email = '$email'";
		

 $result = mysql_query($query);

if (mysql_num_rows($result) == 0) {
	echo "Email not found.  Please try again";
	
}
else {

$oneRow = mysql_fetch_array($result);

$password = $oneRow['Password'];

 $to = $_POST['emailtxt'];
 $subject = "Password Retrieval";
 $body = "Hello ,\n\n You have requested a password retrieval. Your password is '$password'. You can log in by visiting https://php.radford.edu/~proj4/userLoginPage.php . \n\n Sincerely, \n\n The UTE Team";
 if (mail($to, $subject, $body)) {
   echo("<p>Message successfully sent!</p>");
   echo "<meta http-equiv='refresh' content='0 ; url=forgotPassword2.php'>";
  } else {
   echo("<p>Message delivery failed...</p>");
  }

}
}

?>
				
                    
                    
                    
                    