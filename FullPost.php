<?php require_once("Includes/db.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Session.php"); ?>
<?php $SearchQueryParameter=$_GET["id"]; ?>
<?php
if(isset($_POST["Submit"])){
  $Name = $_POST["CommentorName"];
  $Email = $_POST["CommentorEmail"];
  $Comment = $_POST["CommentorThoughts"];
  date_default_timezone_set("Africa/Lagos");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);


  if(empty($Name)|| empty($Email) || empty($Comment)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("FullPost.php?id=$SearchQueryParameter");
  }elseif (strlen($Comment)>500) {
    $_SESSION["ErrorMessage"]= "Comment should be less than 500 characters";
    Redirect_to("FullPost.php?id=$SearchQueryParameter");
  }else{
  $sql= "INSERT INTO comments(name,email,datetime,comment,approvedby,status,post_id)";
  $sql .="VALUES(:commentorName,:commentorEmail,:dateTime,:commentorThoughts,'Pending','OFF',:postIdFromURL)";
  $stmt =$ConnectingDB->prepare($sql);
  $stmt->bindvalue(':commentorName',$Name);
  $stmt->bindvalue(':commentorEmail',$Email);
  $stmt->bindvalue(':dateTime',$DateTime);
  $stmt->bindvalue(':commentorThoughts',$Comment);
  $stmt->bindvalue(':postIdFromURL',$SearchQueryParameter);

  $Execute=$stmt->execute();
  // var_dump($Execute);

   if ($Execute) {
      $_SESSION["SuccessMessage"]=  "Comment Added successfully";
    Redirect_to("FullPost.php?id=$SearchQueryParameter");
   }else{
     $_SESSION["ErrorMessage"]= "Something went wrong.Try Again";
    Redirect_to("FullPost.php?id=$SearchQueryParameter");
   }


}
 
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
	<title>FullPost</title>
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
				<a href="Blog.php" class="nav-link">Blog</a>
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
             global $ConnectingDB;
             // query for search button is active
             if (isset($_GET["SearchButton"])) {
                 $Search = $_GET["Search"];
                 $sql = "SELECT * FROM post WHERE datetime LIKE :search OR title LIKE :search OR post LIKE :search ";
                   $stmt = $ConnectingDB->prepare($sql);
                   $stmt->bindvalue(':search','%'.$Search.'%');
                   $stmt->execute();
                           }
             
             else{ 
                  $PostIdFromURL= $_GET["id"];
                  if (!isset($PostIdFromURL)) {
                   $_SESSION["ErrorMessage"]="Bad Request !";
                     Redirect_to("Blog.php");
                  }
             	$sql = "SELECT * FROM post WHERE id='$PostIdFromURL'";
             $stmt = $ConnectingDB->query($sql);
             $Result = $stmt->rowcount();
             if ($Result!=1) {
             	// code...
             	  $_SESSION["ErrorMessage"]="Bad Request !";
                     Redirect_to("Blog.php?page=1");

             }
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
			<?php
       echo ErrorMessage();
       echo SuccessMessage();
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
					<p class="card-text"><?php echo nl2br($PostText); ?></p>
				
				</div>
				
			</div>
				<?php } ?>

				<!-- Comment session start here -->
				<!-- Existing Commment Here -->
				<span class="FieldInfo">Comments</span>
				<br><br>
				<?php
                 global $ConnectingDB;
                 $sql="SELECT * FROM comments WHERE post_id='$SearchQueryParameter' AND status='ON'";
                 $stmt= $ConnectingDB->query($sql);
                  while ($DataRows = $stmt->fetch()) {
                  	// code...
                  	$CommentDate = $DataRows['datetime'];
                  	$CommentorName = $DataRows['name'];
                  	$CommentThought = $DataRows['comment'];
                 

				?>
				<div>
					<div style="background-color: #F6F7F9;" class="media ">
						<img class="d-block img-fluid align-self-start" src="Images/comment.png">
						<div class="media-body ml-2">
							<h6 class="lead"><?php echo$CommentorName ?></h6>
							<p class="small"><?php echo$CommentDate ?></p>
							<p><?php echo$CommentThought ?></p>
							
						</div>
					</div>
				</div>
				<hr>
				<?php  } ?>

 
				<!-- end of existing comment -->
				<div class="">
					<form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter?>" method="post">
						<div class="card mb-3">
							<div class="card-header">
								<h5 class="FieldInfo">Share Your Thought About This Post</h5>
							</div>
							<div class="card-body">
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-user"></i></span>
											
										</div>
										<input class="form-control" type="text" name="CommentorName" placeholder="Name" value="">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-envelope"></i></span>
											
										</div>
										<input class="form-control" type="email" name="CommentorEmail" placeholder="Email" value="">
								</div>
								</div>
								<div class="form-group">
									<textarea name="CommentorThoughts" class="form-control" rows="6" cols="80"></textarea>
									
								</div>
								<div class="">
									<button type="submit" name="Submit" class="btn btn-primary">Submit</button>
									
								</div>
								
							</div>
						</div>
						
					</form>
				</div>
		</div>

		<?php require_once("Footer.php"); ?>