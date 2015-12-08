<?php

?>
<html>
	<head>
		<title>Log out</title>
		<link rel="shortcut icon" href="img/favicon.png">
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="css/stylesheet.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css" />

		<script type="text/javascript" src="js/jquery.min.js"></script>
	</head>
	<body class="account-page-bg">
		<div class="container spacing">
			<h4 style="color: white;">Logging out. Redirecting to front page...</h4>
		</div>

		<script>
		$(document).ready(function(){
		    $.ajax({
		        url: 'logout_action.php',
		        success: function(response){
		        	setTimeout(
					function(){
						window.location.replace("index.html");
					}, 2500);
		        }
		    })
		});
		</script>
	</body>
</html>