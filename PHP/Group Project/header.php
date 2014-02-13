<html>
  <head>
    <style type="text/css">
      .address {color:red;}
      .cart {position:fixed; top:5px; right:5px; font-family:'Arial Black'; background-color:pink;}
      .center {text-align:center;}
      .footer {text-align:center; position:fixed; bottom:0px; align:center;}
      .headerlinks {text-align:center;}
      .important {border-style:solid; border-color:red; border-width:5px; text-align:center;}
      .line {font-color:black; text-decoration:none; font-family:Tahoma,Verdana,Arial; font-weight:bolder;}
      .logo {align:left; text-align:center;}
      .search {position:fixed; top:5px; left:5px;}
      .thankyou {text-align:center; font-size:35px;}
      a {font-color:black; text-decoration:none; font-family:Tahoma,Verdana,Arial; font-weight:bolder;}
    </style>
    <script type='text/javascript'>
      
    </script>
  </head>
  <body>


    <div style="align:left; text-align:center;">
      <a href='proj4page.php'> <img src='logo.png' /> </a>
      <div class="cart"><a href='buy.php'>cart: <?php
                                                  $conn = mysql_connect('localhost', 'proj4', 'knockknock2');
                                                  // @param hostname  For php.radford.edu, use 'localhost'
                                                  // @param username  your RU userid
                                                  // @param password  the *database* password.

                                                  mysql_select_db('proj4');

                                                  $query = "SELECT SUM(quantity) AS itemcount
                                                            FROM Cart
                                                            WHERE Username = " . $_COOKIE['username'];

                                                  $allRows = mysql_query($query);
                                                  $oneRow = mysql_fetch_array($allRows);
                                                  echo $oneRow['itemcount'];
                                                ?> items</a> </div>
      <!-- <span class='search'> </span> -->
    </div>

    <span style='font-size:0px'>
      <hr />
    </span>

    <div class='headerlinks'>
      <span class='line'> | </span> <a href='ENGL.html'> ENGL </a>
      <span class='line'> | </span> <a href='HIST.html'> HIST </a>
      <span class='line'> | </span> <a href='ITEC.html'> ITEC </a>
      <span class='line'> | </span> <a href='MATH.html'> MATH </a>
      <span class='line'> | </span> <a href='PSYC.html'> PSYC </a>
      <span class='line'> | </span>
    </div>

    <span style='font-size:0px'>
      <hr />
    </span>
	<br />

