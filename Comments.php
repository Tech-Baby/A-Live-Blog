<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];?>
<?php  Confirm_Login(); ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/903005c18e.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Css/style.css">
	<title>Comments</title>
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
				<a href="MyProfile.php" class="nav-link"><i class="fa-solid fa-user text-success"></i> My Profile</a>
			</li>
			<li class="nav-item">
				<a href="Dashboard.php" class="nav-link">Dashboard</a>
			</li>
			<li class="nav-item">
				<a href="Posts.php" class="nav-link">Posts</a>
			</li>
			<li class="nav-item">
				<a href="Categories.php" class="nav-link">Categories</a>
			</li>
			<li class="nav-item">
				<a href="Admins.php" class="nav-link">Manage Admins</a>
			</li>
			<li class="nav-item">
				<a href="Comments.php" class="nav-link">Comments</a>
			</li>
			<li class="nav-item">
				<a href="Blog.php?page=1" class="nav-link">Live Blog</a>
			</li>
			
			

		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item"><a href="Logout.php" class="nav-link text-danger"><i class="fas fa-user-times"></i> Logout</a></li>
			
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
			<div class="col-md-12">
			<h1><i class="fas fa-text-comments" style="color: #27aae1;"></i>Manage Comments</h1>
			</div>
		</div>
		
	</div>
</header>

<section class="container py-2 mb-4">
	<div class="row" style="min-height:30px;">
		<div class="col-lg-12" style="min-height:400px;">
			<?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
			<h2>Un-Approved Comments</h2>

			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date&Time</th>
						<th>Comment</th>
						<th>Approve</th>
						<th>Delete</th>
						<th>Details</th>
					</tr>
				</thead>
			
			
			<?php
			global $ConnectingDB;
			$sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
			while($Datarows=$Execute->fetch()) {
				$CommentId = $Datarows["id"];
				$DateTime = $Datarows["datetime"];
				$CommentorName = $Datarows["name"];
				$CommentContent = $Datarows["comment"];
				$CommentPostId = $Datarows["post_id"];
				$SrNo++;
				if (strlen($CommentorName)>10) {
					$CommentorName = substr($CommentorName,0,10).'...';};

				if (strlen($DateTime)>10) {
					$DateTime = substr($DateTime,0,10).'...';};
					



			?>
			<tbody>
				<tr>
					<td><?php echo htmlentities($SrNo);  ?></td>
					<td><?php echo htmlentities($CommentorName); ?></td>
					<td><?php echo  htmlentities($DateTime); ?></td>
					<td><?php echo htmlentities( $CommentContent); ?></td>
					<td><a class="btn btn-success" href="ApproveComment.php?id=<?php echo $CommentPostId; ?>">Approve</a></td>
					<td><a class="btn btn-danger"href="DeleteComment.php?id=<?php echo $CommentPostId; ?>">Delete</a></td>

					<td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?> " target="_blank">Life Preview</a></td>
				</tr>
				
			</tbody>
			<?php } ?>
			</table>
			<h2>Approved Comments</h2>

			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					
					<tr>
						<th>No.</th>
						<th>Name</th>
						<th>Date&Time</th>
						<th>Comment</th>
						<th>Revert</th>
						<th>Delete</th>
						<th>Details</th>
					</tr>
				</thead>
			
			
			<?php
			global $ConnectingDB;
			$sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
			$Execute = $ConnectingDB->query($sql);
			$SrNo = 0;
			while($Datarows=$Execute->fetch()) {
				$CommentId = $Datarows["id"];
				$DateTime = $Datarows["datetime"];
				$CommentorName = $Datarows["name"];
				$CommentContent = $Datarows["comment"];
				$CommentPostId = $Datarows["post_id"];
				$SrNo++;
				if (strlen($CommentorName)>10) {
					$CommentorName = substr($CommentorName,0,10).'...';};

				if (strlen($DateTime)>10) {
					$DateTime = substr($DateTime,0,10).'...';};
					



			?>
			<tbody>
				<tr>
					<td><?php echo htmlentities($SrNo);  ?></td>
					<td><?php echo htmlentities($CommentorName); ?></td>
					<td><?php echo  htmlentities($DateTime); ?></td>
					<td><?php echo htmlentities( $CommentContent); ?></td>
					<td><a class="btn btn-warning" href="DisApproveComment.php?id=<?php echo $CommentPostId; ?>">Dis-Approve</a></td>
					<td><a class="btn btn-danger"href="DeleteComment.php?id=<?php echo $CommentPostId; ?>">Delete</a></td>

					<td><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId; ?> " target="_blank">Life Preview</a></td>
				</tr>
				
			</tbody>
			<?php } ?>
			</table>
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