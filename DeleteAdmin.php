<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php
if (isset($_GET["id"])) {
  	$SearchQueryParameter = $_GET["id"];
  	global $ConnectingDB;
  	$sql = "DELETE FROM admins WHERE id = '$SearchQueryParameter'";
  	$Execute = $ConnectingDB->query($sql);
  	if ($Execute) {
  		 $_SESSION["SuccessMessage"]=  "Admin Deleted successfully";
    Redirect_to("Admin.php");
  	}else{
  		 $_SESSION["ErrorMessage"]= "Something went wrong.Try Again";
    Redirect_to("Admin.php");
  	}
  }  








?>