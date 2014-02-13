<?php
  /*
    Idea is to send inputted strings here
    Then send them back to the buy page if at least 1 fails
    Or procceed to successful buy
  */
  /*
    Or maybe there's a way to get this in the buy page itself?
  */

  $fullnamesuccess = preg_match('/^[A-Za-Z]+ [A-Za-z]+$/', $_POST['fullname']); 
  $addresssucess = preg_match('/^[0-9][0-9][0-9][0-9] [A-Za-z]+ [A-Za-z]+$/', $_POST['address']); 
  $city = preg_match('/^[A-Za-z]+$/', $_POST['city']); 
  $state = preg_match('/^[A-Za-z][A-Za-z]$/', $_POST['state']); 
  $zipcode = preg_match('/^[09-][0-9][0-9][0-9][0-9]$/', $_POST['zipcode']); 
  $country = preg_match('/^[A-Za-z]+$/', $_POST['country']); 
  $creditcard = preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $_POST['creditcard']); 
  $expirationdate = preg_match('/^[0-9][0-9] [0-9][0-9]$/', $_POST['expirationdate']); 
  $securitycode = preg_match('/^[0-9][0-9][0-9]$/', $_POST['securitycode']); 
  $promotionalcode = preg_match('/^[A-Za-z0-9]+$/', $_POST['promotionalcode']); 









?>