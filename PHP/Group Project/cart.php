<?php
  require('header.html');
?>

  <!--
    This page will depend on a cookie for username
    maybe something like
    setcookie(username, /* whatever their login name is */, time()+7200); // set cookie after user logs in
    then use
    $_COOKIE['username'];
  -->

  <!--
    SELECT textbook, quantity, price, quantity*price AS subtotal
    FROM cart
    WHERE username = /* username */
  -->

  <!--
  SELECT SUM(subtotal)
  FROM (SELECT textbook, quantity, price, quantity*price AS subtotal
        FROM cart
        WHERE username = /* username */)
  -->

<?php
  $conn = mysql_connect('localhost', 'proj4', 'knockknock2');
  // @param hostname  For php.radford.edu, use 'localhost'
  // @param username  your RU userid
  // @param password  the *database* password.

  mysql_select_db('proj4');

  $query = "SELECT textbook, quantity, price, quantity*price AS subtotal
            FROM cart
            WHERE username = " . $_COOKIE['username'];

  $allRows = mysql_query($query);

  <table width='600'>
    <tr>
      <td colspan='4'>
        Item review
      </td>
    </tr>
    <tr>
      <td>
        item
      </td>
      <td>
        quantity
      </td>
      <td>
        price
      </td>
      <td>
        sub total
      </td>
    </tr>

<?php
  while ($oneRow = mysql_fetch_array($allRows))
  {
    echo "    <tr>\n";
    echo "      <td>\n";
    echo "        " . $oneRow['textbook'] . "\n";
    echo "      </td>\n";
    echo "      <td>\n";
    echo "        " . $oneRow['quantity'] . "\n";
    echo "      </td>\n";
    echo "      <td>\n";
    echo "        " . $oneRow['price'] . "\n";
    echo "      </td>\n";
    echo "      <td>\n";
    echo "        " . $oneRow['subtotal'] . "\n";
    echo "      </td>\n";
    echo "    </tr>\n";
  }

  $query = "SELECT SUM(subtotal) AS total
            FROM (SELECT textbook, quantity, price, quantity*price AS subtotal
                  FROM cart
                  WHERE username = $_COOKIE['username'])"
	
  $allRows = mysql_query($query);

  while($oneRow = mysql_fetch_array($allRows))
  {
    echo "    <tr>\n";
    echo "      <td colspan='3'>\n";
    echo "        Total\n";
    echo "      </td>\n";
    echo "      <td>\n";
    echo "        " . $oneRow['total'] . "\n";
    echo "      </td>\n";
    echo "    </tr>\n";
  }

  mysql_close();
?>

  </table>

  <a href='buy.php'> <button type="button" align='center'> Proceed to checkout </button> </a>

<?php
  require('footer.html');
?>