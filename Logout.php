<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>

<?php
$_SESSION["UserId"]=null;
$_SESSION["UserName"]=null;
$_SESSION["AdminName"]=null;

session_destroy();
 Redirect_to("Login.php");







?>