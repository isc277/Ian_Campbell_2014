<div style="text-align:center; font-size:35px;"> Your order has been placed! </div>
<br />

<!-- send to database -->
<!-- send to database -->

<?php
  $conn = mysql_connect('localhost', 'proj4', 'knockknock2');
  // @param hostname  For php.radford.edu, use 'localhost'
  // @param username  your RU userid
  // @param password  the *database* password.

  mysql_select_db('proj4');

  $expirationdate = $_POST['month'] . $_POST['year'];


  /* DO NOT ERASE THE BELOW CODE
  backup

  $query = "INSERT INTO ShippingAndPayments (fullname, address, city, state, zipcode, country, nameoncard, creditcard, expirationdate, securitycode)
  VALUES ( '" . $_POST['fullname'] . "', '" . $_POST['address'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $_POST['zipcode'] . "', '" . $_POST['country'] . "', '" . $_POST['nameoncard'] . "', '" . $_POST['creditcard'] . "', '" . $expirationdate . "', '" . $_POST['securitycode'] . "')";
  mysql_query($query);

  backup
  DO NOT ERASE THE ABOVE CODE */




  // new strategy: Get all the shipping & payments info, then add the sale info to each row. Have 1 row for every book bought by a user


  $query2 = "SELECT *
             FROM Sales
             WHERE SaleID IN (SELECT SaleID
                              FROM Cart
                              WHERE Username='" . $_SESSION['userName'] . "')";
  $allRows = mysql_query($query2);
  // echo $query2;
  mysql_query($query2);
  // echo "<br />";
  // echo $allRows;
  while ($oneRow = mysql_fetch_array($allRows))
  {
    $query3 = "INSERT INTO ShippingAndPayments
    VALUES ('" . $_POST['fullname'] . "', '" . $_POST['address'] . "', '" . $_POST['city'] . "', '" . $_POST['state'] . "', '" . $_POST['zipcode'] . "', '" . $_POST['country'] . "', '" . $_POST['nameoncard'] . "', '" . $_POST['creditcard'] . "', '" . $expirationdate . "', '" . $_POST['securitycode'] . "', '" . $oneRow['SaleID'] . "', '" . $oneRow['ISBN'] . "', '" . $oneRow['Condition'] . "', " . $oneRow['Price'] . ", '" . $oneRow['Username'] . "')";
    mysql_query($query3);
    // echo $query3;
    // echo "<br />";
  }





  
  $query = "DELETE
            FROM Sales
            WHERE SaleID IN (SELECT SaleID
                            FROM Cart
                            WHERE username='" . $_SESSION['userName'] . "')";
  mysql_query($query);

  $query = "DELETE
            FROM Cart
            WHERE username='" . $_SESSION['userName'] . "'";
  mysql_query($query);
  
?>

<!-- output to browser -->
<!-- output to browser -->

<table align='center' width='300'>
  <tr>
    <th style="text-align:center;">
      Order details
    </th>
  </tr>
  <tr>
    <th>
      Ordered on
        <font style='color:#FF0000'>
          <?php
            echo date('Y-M-d H:m:s');
          ?>
        </font>
    </td>
  </tr>
</table>

<table width='450' align='center'>
  <tr>
    <td colspan='3'>

      Sent to
      <font style='color:#FF0000'>
<?php
echo "        " . $_POST['fullname'] . " <br />\n";
echo "        " . $_POST['address'] . " <br /> \n";
echo "        " . $_POST['city'] . ", " . $_POST['state'] . " " . $_POST['zipcode'] . " <br /> \n";
echo "        " . $_POST['country'] . " <br /> \n";
?>
      </font>

    </td>
  </tr>
  <tr>
    <td colspan='2'>
      <div style="text-align:center;">
        <hr />
        <i> This is a hypothetical website. Nothing is actually for sale. Don't give any real identity or credit card information </i>
      </div>
    </td>
  </tr>
</table>