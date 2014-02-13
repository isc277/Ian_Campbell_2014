    <form action="checkout.php" method="POST">

    </th>
  </tr>
  <tr>
    <td align='right'>
      Full name
    </td>
    <td>
      <input type='text' name='fullname' size='30' maxlength='30' value="<?php
                                                                           if (isset($_POST['fullname']))
                                                                           {
                                                                             echo $_POST['fullname'];
                                                                           }
                                                                         ?>" />
<?php
session_start();
  if (array_key_exists('i-came-from-form', $_POST))
  {
    if ($errMsgs['fullname'])
    {
      echo "<b style='color:#FF0000'> Please enter your full name (firstname lastname) </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Address
    </td>
    <td>
      <input type='text' name='address' size='30' maxlength='30' value="<?php
                                                                          if (isset($_POST['address']))
                                                                          {
                                                                            echo $_POST['address'];
                                                                          }
                                                                        ?>" />

<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['address'])
    {
      echo "<b style='color:#FF0000'> Please enter your address (number name street) </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      City
    </td>
    <td>
      <input type='text' name='city' size='30' maxlength='30' value='<?php
                                                                       if (isset($_POST['city']))
                                                                       {
                                                                         echo $_POST['city'];
                                                                       }
                                                                       echo "' />\n";
                                                                       if (array_key_exists('i-came-from-form', $_POST) )
                                                                       {
                                                                         if ($errMsgs['city'])
                                                                         {
                                                                           echo "<b style='color:#FF0000'> Please enter your city </b>";
                                                                         }
                                                                       }
                                                                     ?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      State
    </td>
    <td>
      <input type='text' name='state' size='2' maxlength='2' value="<?php
                                                                      if (isset($_POST['state']))
                                                                      {
                                                                        echo $_POST['state'];
                                                                      }
                                                                    ?>" />
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if (!($_POST['state']))
    {
      echo "<b style='color:#FF0000'> Please enter your state (2 letters) </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Zip code
    </td>
    <td>
      <input type='text' name='zipcode' size='5' maxlength='5' value="<?php
                                                                        if (isset($_POST['zipcode']))
                                                                        {
                                                                          echo $_POST['zipcode'];
                                                                        }
                                                                      ?>" />
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['zipcode'])
    {
      echo "<b style='color:#FF0000'> Please enter your zipcode (5 digits) </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Country
    </td>
    <td>
      <input type='text' name='country' size='30' maxlength='30' value="<?php
                                                                          if (isset($_POST['country']))
                                                                          {
                                                                            echo $_POST['country'];
                                                                          }
                                                                        ?>" />
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['country'])
    {
      echo "<b style='color:#FF0000'> Please enter your country </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td>
      <br />
    </td>
    <td>
      <br />
    </td>
  </tr>
  <tr>
    <td align='right'>
      Name on card
    </td>
    <td>
      <input type='text' name='nameoncard' size='30' maxlength='30' value="<?php
                                                                          if (isset($_POST['nameoncard']))
                                                                          {
                                                                            echo $_POST['nameoncard'];
                                                                          }
                                                                        ?>" />

<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['nameoncard'])
    {
      echo "<b style='color:#FF0000'> Please enter your name on credit card </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Credit card
    </td>
    <td>
      <input type='text' name='creditcard' size='16' maxlength='16' value="<?php
                                                                            if (isset($_POST['creditcard']))
                                                                            {
                                                                              echo $_POST['creditcard'];
                                                                            }
                                                                          ?>" />
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['creditcard'])
    {
      echo "<b style='color:#FF0000'> Please enter your credit card (16 digits)</b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Expiration date
    </td>
    <td>
      <select name='month'>
                    <option value=''> MM </option>
                    <option value='01' <?php
                                         if ($_POST['month'] == 01)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 01 </option>
                    <option value='02' <?php
                                         if ($_POST['month'] == 02)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 02 </option>
                    <option value='03' <?php
                                         if ($_POST['month'] == 03)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 03 </option>
                    <option value='04' <?php
                                         if ($_POST['month'] == 04)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 04 </option>
                    <option value='05' <?php
                                         if ($_POST['month'] == 05)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 05 </option>
                    <option value='06' <?php
                                         if ($_POST['month'] == 06)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 06 </option>
                    <option value='07' <?php
                                         if ($_POST['month'] == 07)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 07 </option>
                    <option value='08' <?php
                                         if ($_POST['month'] == 08)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 08 </option>
                    <option value='09' <?php
                                         if ($_POST['month'] == 09)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 09 </option>
                    <option value='10' <?php
                                         if ($_POST['month'] == 10)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 10 </option>
                    <option value='11' <?php
                                         if ($_POST['month'] == 11)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 11 </option>
                    <option value='12' <?php
                                         if ($_POST['month'] == 12)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 12 </option>
                  </select>
                  <select name='year'>
                    <option value=''> YY </option>
                    <option value='12' <?php
                                         if ($_POST['year'] == 12)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 12 </option>
                    <option value='13' <?php
                                         if ($_POST['year'] == 13)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 13 </option>
                    <option value='14' <?php
                                         if ($_POST['year'] == 14)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 14 </option>
                    <option value='15' <?php
                                         if ($_POST['year'] == 15)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 15 </option>
                    <option value='16' <?php
                                         if ($_POST['year'] == 16)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 16 </option>
                    <option value='17' <?php
                                         if ($_POST['year'] == 17)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 17 </option>
                    <option value='18' <?php
                                         if ($_POST['year'] == 18)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 18 </option>
                    <option value='19' <?php
                                         if ($_POST['year'] == 19)
                                         {
                                           echo "selected='selected'";
                                         }
                                         ?> > 19 </option>
                  </select>
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['expirationdate'])
    {
      echo "<b style='color:#FF0000'> Please enter your expiration date </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td align='right'>
      Security code
    </td>
    <td>
      <input type='text' name='securitycode' size='3' maxlength='3' value="<?php
                                                                            if (isset($_POST['securitycode']))
                                                                            {
                                                                              echo $_POST['securitycode'];
                                                                            }
                                                                          ?>" />
<?php
  if (array_key_exists('i-came-from-form', $_POST) )
  {
    if ($errMsgs['securitycode'])
    {
      echo "<b style='color:#FF0000'> Please enter your security code (Check the back of your card for a 3 digit number) </b>";
    }
  }
?>
    </td>
  </tr>
  <tr>
    <td colspan='3'>
      <p style="text-align:center;">
        <input type="submit" name="submit" value="Place Order" class = 'button' />
        <input type="hidden" name="i-came-from-form" value="true" />
      </p>
      </form>
    </td>
  </tr>
  <tr>
    <td colspan='3'>
<?php
  require('footer.html');
?>
    </td>
  </tr>
</table>
<div class="footer">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="proj4page.php">Search</a></li>
					>
				</ul>
				<p>&#169; Copyright &#169; 2011. University Textbook Exchange all rights reserved</p>
				<div class="connect">
					<a href="http://facebook.com/UniversityTextbookExchange" id="facebook">facebook</a>
					<a href="http://twitter.com/UniversityTextbookExchange" id="twitter">twitter</a>
					<a href="http://www.youtube.com/UsurperKingZant" id="vimeo">vimeo</a>
					 <?php echo $_SESSION['userName']; ?>
					 
				</div>
			</div>
			
			</html>



