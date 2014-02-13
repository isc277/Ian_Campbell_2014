<html>
<h3> You have been successfully logged out...</h3>


<?php

session_start();
$_SESSION['isValidated'] = false;
session_destroy();



echo "<meta http-equiv='refresh' content='2 ; url=index.php'>";






?>

</html>
