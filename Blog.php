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
	<title>Blog</title>
	<style media="screen">
		
		.heading{
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-weight: bold;
    color: #005E90;
}
.heading:hover{
    color: #0090DB;
}
	</style>
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
				<a href="Blog.php" class="nav-link">Home</a>
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
<div class="container">
	<div class="row mt-4">
		<div class="col-sm-8">
			<h1>Blog</h1>
			<?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
			<?php
             global $ConnectingDB;
             if (isset($_GET["SearchButton"])) {
                 $Search = $_GET["Search"];
                 $sql = "SELECT * FROM post WHERE datetime LIKE :search OR title LIKE :search OR post LIKE :search ";
                   $stmt = $ConnectingDB->prepare($sql);
                   $stmt->bindvalue(':search','%'.$Search.'%');
                   $stmt->execute();
                           }
                           // Pagination sql query blog.php?page=1
                           elseif (isset($_GET["page"])) {
                           	$Page = $_GET["page"];
                           	if ($Page==0 || $Page<1) {
                           		// code...
                           			$ShowPostFrom = 0;
                           	}else{
                           		$ShowPostFrom = ($Page*4)-4;
                           	}
                           
                           	
                           	$sql = "SELECT * FROM post ORDER BY id desc LIMIT $ShowPostFrom,4";
                           	$stmt = $ConnectingDB->query($sql);

                           }elseif (isset($_GET["categories"])) {
                           	$Category=$_GET["categories"];
                           	$sql="SELECT * FROM post WHERE categories='$Category' ORDER BY id desc";
                           	$stmt= $ConnectingDB->query($sql);
                           	// code...
                           }

             else{$sql = "SELECT * FROM post ORDER BY id desc LIMIT 0,3";
             $stmt = $ConnectingDB->query($sql);
        }
             while ($Datarows = $stmt->fetch()) {
                    $PostId = $Datarows["id"];
                  	$DateTime = $Datarows["datetime"];
                  	$PostTitle = $Datarows["title"];
                  	$Category = $Datarows["categories"];
                  	$Admin = $Datarows["author"];
                  	$Image = $Datarows["image"];
                  	$PostText = $Datarows["post"];
             


			?>
			<div class="card">
				<img src="Upload/<?php echo htmlentities($Image); ?>" style="max-height: 450px;" class="img-fluid card-img-top" />
				<div class="card-body">
					<h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
					<small class="text-muted">Category:<span class="text-dark
						"><a href="Blog.php?categories=<?php echo htmlentities($Category);?>"><?php echo htmlentities($Category);?></a></span> & Written by <span class="text-dark"><a href="Profile.php?username=<?php echo htmlentities($Admin);?>"><?php echo htmlentities($Admin) ;?></a></span>  On<span class="text-dark"><?php echo htmlentities( $DateTime); ?></span> </small>
					<span style="float: right;" class="badge badge-dark text-light">Comments <?php
					 global $ConnectingDB;
								$sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON' ";
								$stmtApprove = $ConnectingDB->query($sqlApprove);
								$TotalRows =  $stmtApprove->fetch();
								$Total = array_shift($TotalRows);
								echo $Total;

							?></span>
					<hr>
					<p class="card-text"><?php if (strlen ($PostText)>150) {
				 		$PostText = substr($PostText,0,150).'...';} echo  nl2br($PostText) ; ?></p>
					<a href="FullPost.php?id=<?php echo $PostId;?>" style="float:right;">
						<span class="btn btn-info">Read More >></span>


					</a>
					
				</div>
				
			</div>
				<?php } ?>
				<!-- pagination -->
				<nav>
					<ul class="pagination pagination-lg">

						<!-- creating the forward button -->

						<?php if (isset($Page)) { 
							if ($Page>1) {
								// code...
							?>

							<li class="page-item ">
							<a href="Blog.php?page=<?php echo $Page-1; ?>" class="page-link ">&laquo;</a></li>




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
							<a href="Blog.php?page=<?php echo $i; ?>" class="page-link "><?php echo $i; ?></a></li>
						<?php
						}else{ ?>

							<li class="page-item ">
							<a href="Blog.php?page=<?php echo $i; ?>" class="page-link "><?php echo $i; ?></a></li>
							<?php } ?>
						<?php } }  ?>







						
						<!-- creating the forward button -->

						<?php if (isset($Page)&&!empty($Page)) { 
							if ($Page+1<=$PostPagination) {
								// code...
							?>

							<li class="page-item ">
							<a href="Blog.php?page=<?php echo $Page+1; ?>" class="page-link ">&raquo;</a></li>




						<?php } } ?>
					</ul>
					
				</nav>
		</div>

		<?php require_once("Footer.php"); ?>