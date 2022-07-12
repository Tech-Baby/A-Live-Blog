<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php require_once("Includes/Functions.php"); ?>

<?php
$SearchQueryParameter=$_GET["username"];
global $ConnectingDB;
$sql = "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt = $ConnectingDB->prepare($sql);
$stmt->bindvalue(':userName',$SearchQueryParameter);
$stmt->execute();
$Result = $stmt->rowcount();
if ($Result==1) {
	while ($DataRows = $stmt->fetch()) {
		$ExistingName = $DataRows["aname"];
		$ExistingHeadline = $DataRows["aheadline"];
		$ExistingBio = $DataRows["abio"];
		$ExistingImage = $DataRows["aimage"];

	}
}else{
	  $_SESSION["ErrorMessage"]= "Bad Request";
    Redirect_to("Blog.php?page=1");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/903005c18e.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Css/style.css">
	<title></title>
</head>
<body>
	<!-- NAVBAR START -->
<div style="height: 10px; background: #27aae1;"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container" >
		<a href="#" class="navbar-brand"> PLANET.COM</a>
		<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarcollapseCMS">
		<ul class="navbar-nav mr-auto">
			
			<li class="nav-item">
				<a href="Blog.php?page=1" class="nav-link">Home</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">About Us</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Blog</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Contact Us</a>
			</li>
			<li class="nav-item">
				<a href="#" class="nav-link">Features</a>
			</li>
			
			

		</ul>
		<ul class="navbar-nav ml-auto">
			<form class="form-inline d-none d-sm-block" action="Blog.php">
				<div class="form-group">
					<input class="form-control mr-2" type="text" name="Search" placeholder="Search Here" value="">
					<button class="btn btn-primary" name="SearchButton">Go</button>
				
				</div>
			</form>
			
		</ul> 
		</div>
	</div>
	
</nav>
<div style="height: 10px; background: #27aae1;"></div>


     <!-- NAVBAR ENDS-->
<!-- HEADER -->
<header class="bg-dark text-white py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-6  mr-2">
			<h1><i class="fas fa-user text-success" style="color: #27aae1;"></i><?php echo $ExistingName; ?></h1>
			<h3><?php echo $ExistingHeadline; ?></h3>
			</div>
		</div>
		
	</div>
</header>

<section class="container py-2">
	<div class="row">
		<div class="col-md-3">
			<img src="Images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
			
		</div>
		<div class="col-md-9" style="min-height:550px;">
			<div class="card">
				<div class="card-body">
					<?php echo $ExistingBio; ?>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</section>
<!-- FOOTER
 -->
<footer class="bg-dark text-white">
	<div class="container">
		<div class="row">
			<div class="col">
			<p class="lead text-center">Theme By| Falowo Olamide |<span id="year"></span> &copy;------All right reserved</p>
		</div>
	</div>
	</div>



</footer>
<div style="height: 10px; background: #27aae1;"></div>














<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script >
	$('#year').text(new Date().getFullYear());
</script>
</body>
</html>