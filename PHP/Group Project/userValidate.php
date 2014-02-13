<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
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
					<li class="selected"><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >Log in</a></li></ul>";
                 }
                 else{
  echo "<li> " . $_SESSION['userName'] . "</li> </ul>";
  		 }
  ?>
  
					
			</div>
			<div class="body">
				<div id="featured">
					<h3>University Text Book Exchange</h3>


<?php
session_start();
$conn = mysql_connect('localhost', 'proj4', 'knockknock2');
           // @param hostname  For php.radford.edu, use 'localhost'
           // @param username  your RU userid
           // @param password  the *database* password.

		mysql_select_db('proj4');

$username = $_POST['userNametxt'];
$password = $_POST['passwordtxt'];

$query = "SELECT * from Users where Username ='$username' AND Password='$password'";
//$query = mysql_real_escape_string($query);

$result = mysql_query($query) or die ("Error in query: $query " . mysql_error()); 
$row = mysql_fetch_array($result); 
$num_results = mysql_num_rows($result); 

if ($num_results > 0){ 
//user is validated
$_SESSION['isValidated'] = true; //set session variables
$_SESSION['userName'] = $username;

	if($row['Privileges'] == 1) {
	$_SESSION['isAdmin'] = true;
	}



echo "<p>You have successfully logged in as " . $username;
echo " You can now make purchases or list items.</p>";




echo "<meta http-equiv='refresh' content='1 ; url=index.php'>";




}
else
{ 
echo "<p>You are not found in our database. Have you <a href= 'UserRegister.php'> registered? </a>
</p>";	

} 

?>

</div>
</div>

</html>


