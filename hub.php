<?php
	include('db.php');
	session_start();
	$message = NULL;
	$email = NULL;
	$projects = array();
	if(isset($_SESSION['email'])){
		$message = $_SESSION['message'];
		$email = $_SESSION['email'];
		$result = mysqli_query($connection, "SELECT file_location, link FROM projects WHERE email='".$email."'");
		if($result === FALSE) { 
			die(mysql_error()); // TODO: better error handling
		}
		while ($row = mysqli_fetch_array($result)) {
		    $projects[$row[0]] = $row[1];
		}
	}else{
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>AudioMax</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="AudioMax for YouTube and Soundcloud">
	<meta name="author" content="AudioMax">
	<link rel="shortcut icon" href="img/favicon.png">

	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style-conversion.css" rel="stylesheet" type="text/css" media="all" />

	<script type="text/javascript" src="js/jquery.min.js"></script>

	<!-- YouTube manipulation section -->
	<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.nanoscroller/0.8.6/css/nanoscroller.min.css">
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.nanoscroller/0.8.6/javascripts/jquery.nanoscroller.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/jquery.youtubepicker.css">
	<script type="text/javascript" src="js/jquery.youtubepicker.js"></script>

	<!-- Bootstrap toggle section -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap-toggle.css">
	<script type="text/javascript" src="js/bootstrap-toggle.js"></script>

    <!--Font-Awesome-->
	<link rel="stylesheet" href="fonts/css/font-awesome.min.css">
</head>

<body>
	<div class="container">
		<br>
		<div class="pull-right">
			<?php if($message != null || $email != null) { ?>
				<a href="logout.php" class="btn btn-default">Log out</a>
			<?php } ?>
		</div>
	</div>
	<div id="search" class="container">
		<div class="text-center">
			<form class="form-inline">
				<div class="form-group">
					<a href="index.html"><img class="logo img-responsive" src="img/logo.png"></a>
					<input id="toggle-event" checked type="checkbox" data-toggle="toggle" data-on="YouTube" data-onstyle="danger" data-off="Soundcloud" data-offstyle="warning">
					<input type="text" name="video" class="yp form-control" placeholder="Search a video">
					<button class="btn btn-default"><i class="search-btn fa fa-search"></i></button>
					<div class="empty"></div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-8">
				<?php if(!(empty($projects))){ ?>
					<h3>Past projects</h3>
				<?php } ?>
				<ul class="list-unstyled">
					<?php if(!(empty($projects))){ 
						foreach($projects as $key => $value){ 
							echo("<li><a class='no-style' href='".$value."'>".$key."</a></li>")?>

					<?php } 
					} ?>
				</ul>
			</div>
		</div>
		<br>
		<div id="system"></div>
	</div>

	<script type="text/javascript" src="api.js"></script>

	<script type="text/javascript">
		$(function(){
			var credentials = { 
				'API_KEY' : api.key
			};
			$('.yp').youtubepicker(credentials);
		});

		$(function(){
			var test = false;
			$('#toggle-event').change(function(){
				test = true;
				console.log(test);
			});
		});
	</script>
</body>
</html>