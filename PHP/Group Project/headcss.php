

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
  </div>
            
            