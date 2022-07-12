<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/903005c18e.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="Css/style.css">
	<title>Dashboard</title>
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
				<a href="Admin.php" class="nav-link">Manage Admins</a>
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
			<h1><i class="fas fa-cog
			" style="color: #27aae1;"></i>Dashboard</h1>
			</div>
			<div class="col-lg-3 mb-2">
				<a href="AddNewPost.php" class="btn btn-primary btn-block">
					<i class="fas fa-edit"></i> Add New Post
				</a>
				
			</div>
			<div class="col-lg-3 mb-2">
				<a href="Categories.php" class="btn btn-info btn-block">
					<i class="fas fa-folder-plus"></i> Add New Category
				</a>
				
			</div>
			<div class="col-lg-3 mb-2">
				<a href="Admin.php" class="btn btn-warning btn-block">
					<i class="fas fa-user-plus"></i> Add New Admin
				</a>
				
			</div>
			<div class="col-lg-3 mb-2">
				<a href="Comments.php" class="btn btn-success btn-block">
					<i class="fas fa-check"></i> Approve Comments
				</a>
				
			</div>
		</div>
		
	</div>
</header>                                      <!-- 
 end of header -->
<section class="container py-2 mb-4">
	<div class="row">
		 <?php
       echo ErrorMessage();
       echo SuccessMessage();

       ?>
		<div class="col-lg-2">
			<div class="card text-center bg-dark text-white mb-3">
				<div class="card-body">
					<h1 class="lead">Posts</h1>
					<h4 class="display-5">
						<i class="fab fa-readme">
							<?php
							global $ConnectingDB;
							$sql ="SELECT COUNT(*) FROM post";
							$stmt=$ConnectingDB->query($sql);
							$TotalRows = $stmt->fetch();
							$TotalPosts = array_shift($TotalRows);
							echo $TotalPosts;




							?>
							


						</i>
					</h4>
					
				</div>
				
			</div>
			<div class="card text-center bg-dark text-white mb-3">
				<div class="card-body">
					<h1 class="lead">Categories</h1>
					<h4 class="display-5">
						<i class="fas fa-folder"><?php
							global $ConnectingDB;
							$sql ="SELECT COUNT(*) FROM categories";
							$stmt=$ConnectingDB->query($sql);
							$TotalRows = $stmt->fetch();
							$TotalPosts = array_shift($TotalRows);
							echo $TotalPosts;




							?></i>
					</h4>
					
				</div>
				
			</div>
			<div class="card text-center bg-dark text-white mb-3">
				<div class="card-body">
					<h1 class="lead">Admins</h1>
					<h4 class="display-5">
						<i class="fas fa-users"><?php
							global $ConnectingDB;
							$sql ="SELECT COUNT(*) FROM admins";
							$stmt=$ConnectingDB->query($sql);
							$TotalRows = $stmt->fetch();
							$TotalPosts = array_shift($TotalRows);
							echo $TotalPosts;




							?></i>
					</h4>
					
				</div>
				
			</div>
			<div class="card text-center bg-dark text-white mb-3">
				<div class="card-body">
					<h1 class="lead">Comments</h1>
					<h4 class="display-5">
						<i class="fas fa-comments"><?php
							global $ConnectingDB;
							$sql ="SELECT COUNT(*) FROM comments";
							$stmt=$ConnectingDB->query($sql);
							$TotalRows = $stmt->fetch();
							$TotalPosts = array_shift($TotalRows);
							echo $TotalPosts;




							?></i>
					</h4>
					
				</div>
				
			</div>

			

			

			
			
		</div>

		<div class="col-md-10">
			<h1>Top Posts</h1>
			<table class="table table-striped table-hover ">
				<thead class="thead-dark">
					<tr>
						<th>No.</th>
						<th>Title</th>
						<th>Date&Time</th>
						<th>Author</th>
						<th>Comments</th>
						<th>Details</th>
					</tr>
				</thead>
				<?php
				$SrNo =0;

				global $ConnectingDB;
				$sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,5";
				$stmt = $ConnectingDB->query($sql);
				while ($Datarows=$stmt->fetch()) {
					$PostId = $Datarows["id"];
					$DateTime = $Datarows["datetime"];
					$Author = $Datarows["author"];
					$PostTitle = $Datarows["title"];
					$SrNo++;


				
				?>
				<tbody>
					<tr>
						<td><?php echo $SrNo; ?></td>
						<td><?php echo $PostTitle; ?></td>
						<td> <?php echo $DateTime; ?></td>
						<td> <?php echo $Author; ?> </td>
						<td>
					
								<?php
								global $ConnectingDB;
								$sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON' ";
								$stmtApprove = $ConnectingDB->query($sqlApprove);
								$TotalRows =  $stmtApprove->fetch();
								$Total = array_shift($TotalRows);
								  if ($Total>0) {
                                             ?>
                                         <span class="badge badge-success">
                                              <?php
                                           echo $Total; ?>
                                           </span>
                                      <?php  }   ?>

								<?php
								global $ConnectingDB;
								$sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF' ";
								$stmtApprove = $ConnectingDB->query($sqlApprove);
								$TotalRows =  $stmtApprove->fetch();
								$Total = array_shift($TotalRows);
								 if ($Total>0) {  ?>
                                       <span class="badge badge-danger">
                                        <?php
                                        echo $Total; ?>
                                              </span>
                                              <?php  }  ?>
                                         </td>
						<td><a target="_blank" href="FullPost.php?id=<?php echo $PostId;  ?>"><span class="btn btn-info">Preview</span></a></td>
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