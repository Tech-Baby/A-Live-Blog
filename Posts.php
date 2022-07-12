<?php require_once("Includes/DB.php");?>
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
	<title>Posts</title>
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
			<h1><i class="fas fa-blog
			" style="color: #27aae1;"></i>Blog Posts</h1>
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
		<div class="col-lg-12">
			 <?php
       echo ErrorMessage();
       echo SuccessMessage();

       ?>

			<table class="table table striped table-hover">
				<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th> Category</th>
					<th>Date&Time</th>
					<th>Author</th>
					<th>Banner</th>
					<th>Comments</th>
					<th>Action</th>
					<th>Live Previews</th>
				</tr>
				</thead>
				 <?php 
                  global $ConnectingDB;
                  $sql = "SELECT * FROM post";
                  $stmt = $ConnectingDB->query($sql);
                  $Sr = 0;
                  if (isset($_GET["page"])) {
                  		$Page = $_GET["page"];
                           	if ($Page==0 || $Page<1) {
                           		// code...
                           			$ShowPostFrom = 0;
                           	}else{
                           		$ShowPostFrom = ($Page*5)-5;
                           	}
                           
                           	
                           	$sql = "SELECT * FROM post ORDER BY id desc LIMIT $ShowPostFrom,5";
                           	$stmt = $ConnectingDB->query($sql);

                           }

             else{$sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,3";
             $stmt = $ConnectingDB->query($sql);
                  }

                  while ($Datarows = $stmt->fetch()) {
                  	$Id = $Datarows["id"];
                  	$DateTime = $Datarows["datetime"];
                  	$PostTitle = $Datarows["title"];
                  	$Category = $Datarows["categories"];
                  	$Admin = $Datarows["author"];
                  	$Image = $Datarows["image"];
                  	$PostText = $Datarows["post"];
                 $Sr++;


				 ?>
				 <tbody>
				 <tr>
				 	<td><?php echo $Sr;?></td>
				 	<td><?php if (strlen($PostTitle)>10) {
				 		$PostTitle = substr($PostTitle,0,10).'...';}
				 		echo $PostTitle; ?>
				 	 </td>
				 	<td><?php if (strlen($Category)>8) {
				 		$Category = substr($Category,0,8).'...';} 
				 		echo $Category; ?>
				 			
				 		</td>
				 	<td><?php if (strlen($DateTime)>11) {
				 		$DateTime = substr($DateTime,0,12).'...';} echo $DateTime; ?></td>
				 	<td><?php if (strlen($Admin)>10) {
				 		$Admin = substr($Admin,0,10).'...';} 
				 		echo $Admin; ?>
				 			
				 		</td>
				 	<td><img src="Upload/<?php echo$Image;?>"width="170px;" height="50px"></td>
				 	<td >
								<?php
								global $ConnectingDB;
								$sqlApprove = "SELECT COUNT(*) FROM comments WHERE id='$Id' AND status='ON' ";
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
								$sqlApprove = "SELECT COUNT(*) FROM comments WHERE id='$Id' AND status='OFF' ";
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
				 	<td><a href="EditPost.php?id=<?php echo $Id; ?>" target="_blank" ><span class="btn btn-warning">Edit</span></a><a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger">Delete</span></a></td>
				 	<td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank" ><span class="btn btn-primary">Life Preview</span></a></td>
				 </tr>
				</tbody>
				<?php } ?>
				
			</table>

			<!-- pagination -->
			<nav class="container">
				<ul class="pagination pagination-lg">
						<!-- creating the backward button -->

						<?php if (isset($Page)) { 
							if ($Page>1) {
							
							?>

							<li class="page-item ">
							<a href="Posts.php?page=<?php echo $Page-1; ?>" class="page-link ">&raquo;</a></li>




						<?php } } ?>

						<?php
						global $ConnectingDB;
						$sql = "SELECT COUNT(*) FROM post";
						$stmt = $ConnectingDB->query($sql);
						$RowPagination = $stmt->fetch();
						$TotalPosts = array_shift($RowPagination);
						// echo $TotalPosts."<br>";
						$PostPagination = $TotalPosts/4;
						$PostPagination = ceil($PostPagination);
						 // echo $PostPagination;
						for ($i=1; $i <$PostPagination  ; $i++) { 
							if (isset($Page)) {
								if ($i==$Page) { ?>
														
						<li class="page-item active">
							<a href="Posts.php?page=<?php echo $i; ?>" class="page-link "><?php echo $i; ?></a></li>
						<?php
						}else{ ?>

							<li class="page-item ">
							<a href="Posts.php?page=<?php echo $i; ?>" class="page-link "><?php echo $i; ?></a></li>
							<?php } ?>
						<?php } }  ?>


							<!-- creating the forward button -->

						<?php if (isset($Page)&&!empty($Page)) { 
							if ($Page+1<=$PostPagination) {
								// code...
							?>

							<li class="page-item ">
							<a href="Posts.php?page=<?php echo $Page+1; ?>" class="page-link ">&raquo;</a></li>




						<?php } } ?>





						

						
					
					
				</ul>
			</nav>
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