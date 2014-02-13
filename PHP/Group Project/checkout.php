<?php 
  ini_set('date.timezone','America/New_York');
  session_start();
?>

<?php

// expiration drop down box doesn't stickyform

  $errMsgs = array();

  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if (!(preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $_POST['fullname'])))
    {
      $errMsgs['fullname'] = 'fullname error';
    }
    if (!(preg_match('/^[0-9]+\s[A-Za-z]+\s[A-Za-z]+$/', $_POST['address'])))
    {
      $errMsgs['address'] = 'address error';
    }
    if (!(preg_match('/^[A-Za-z\s]+$/', $_POST['city'])))
    {
      $errMsgs['city'] = 'city error';
    }
    if (!(preg_match('/^[A-Za-z][A-Za-z]$/', $_POST['state'])))
    {
      $errMsgs['state'] = 'state error';
    }
    if (!(preg_match('/^[0-9][0-9][0-9][0-9][0-9]$/', $_POST['zipcode'])))
    {
      $errMsgs['zipcode'] = 'zipcode error';
    }
    if (!(preg_match('/^[A-Za-z\s]+$/', $_POST['country'])))
    {
      $errMsgs['country'] = 'country error';
    }
    if (!(preg_match('/^[A-Za-z]+\s[A-Za-z]+/', $_POST['nameoncard'])))
    {
      $errMsgs['nameoncard'] = 'name on card error';
    }
    if (!(preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $_POST['creditcard'])))
    {
      $errMsgs['creditcard'] = 'creditcard error';
    }
    if ($_POST['month'] == '')
    {
      $errMsgs['expirationdate'] = 'expiration date error';
    }
    if ($_POST['year'] == '')
    {
      $errMsgs['expirationdate'] = 'expiration date error';
    }
    $expirationcompare1 = $_POST['year'] . $_POST['month'];
    $expirationcompare2 = date(y) . date(m);
    // echo date(ym); // check for input date
    if ($expirationcompare2 >= $expirationcompare1)
    {
      $errMsgs['expirationdate'] = 'expiration date error';
    }
    if (!(preg_match('/^[0-9][0-9][0-9]$/', $_POST['securitycode'])))
    {
      $errMsgs['securitycode'] = 'securitycode error';
    }
    /* not required
    if (empty($_POST['promotionalcode']))
    {
      $errMsgs['promotionalcode'] = 'promotionalcode error';
    }
    not required */
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
					<li ><a href="index.php">home</a></li>
					<li class = "selected"><a href="about.php">about</a></li>
					<li><a href="proj4page.php">search for book</a></li>
   <?php if($_SESSION['isValidated'] == false){
  	echo "<li><a href= 'userLogin.php' >log in</a></li></ul>";
                 }
                 else{
  
  echo "<li> <a href='shoppingCart.php'>view cart</a> </li>";
   echo "<li> <a href='sellBook.php'>sell book</a></li>";
   echo "<li> <a href='mySales.php'>my sales</a></li> ";
  echo "<li> <a href='logout.php'>log out?</a></li></ul>";
  
  		 }
  		 
  		 ?>







<table cellspacing='1px' align='center'>






<br/>
    <th colspan='2'>
<?php
  if ($formIsValid)
  {
    include('checkout-success.php');
  }
  else
  {
    include('checkout-input.php');
  }
?>