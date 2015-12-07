<?php
	include('db.php');
	session_start();

	if(isset($_SESSION['email'])){
		print($_SESSION['email']);
		header('Location: hub.php');
		die();
	}

	if(isset($_POST['action'])){
		// echo "Hello";
		if($_POST['action'] == "login"){
			$email = mysqli_real_escape_string($connection, $_POST["email"]);
			$password = mysqli_real_escape_string($connection, $_POST["password"]);
			$query = mysqli_query($connection, "SELECT name from users WHERE email='".$email."' and password='".md5($password)."'");
			$results = mysqli_fetch_array($query);

			if(count($results) >= 1){
				$message = $results['name']." logged in successfully!";
				$_SESSION['message'] = $message;
				$_SESSION['email'] = $email;
				setcookie($email, $email, time() + (86400 * 30), "/");
				header('Location: hub.php');
				die();
 			}else{
				$message = "Invalid email or password!";
			}
		}elseif($_POST['action'] == "signup"){
			$name = mysqli_real_escape_string($connection,$_POST['name']);
	        $email = mysqli_real_escape_string($connection,$_POST['email']);
	        $password = mysqli_real_escape_string($connection,$_POST['password']);
	        $repeatPassword = mysqli_real_escape_string($connection,$_POST['repeat-password']);
	        $query = "SELECT email FROM users where email='".$email."'";
	        $result = mysqli_query($connection, $query);
	        $numResults = mysqli_num_rows($result);
	        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	            $message = "Invalid email address please type a valid email!!";
	        }elseif (strcmp($password, $repeatPassword) !== 0){
	        	$message = "Passwords do not match!";
	        }elseif ($numResults >= 1){
	            $message = $email." Email already exists!";
	        }else{
	            mysqli_query($connection, "INSERT INTO users(name, email, password) VALUES('".$name."','".$email."','".md5($password)."')");
	            $message = "Sign up was successful!";
	            $_SESSION['message'] = $message;
	            $_SESSION['email'] = $email;
	            setcookie($email, $email, time() + (86400 * 30), "/");
	            header('Location: hub.php');
	            die();
	        }
		}

    	echo("<br><p class='text-center red'>".$message."</p>");
	}
?>
<html>
	<head>
		<title>Account Page</title>
		<link rel="shortcut icon" href="img/favicon.png">
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="css/stylesheet.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="fonts/css/font-awesome.min.css" />
	</head>

	<body class="account-page-bg">
		<div class="account-container">
			<div class="row">
				<div class="col-md-4">
					<h4 class="text-center login-text">LOGIN</h4>
					<form action="" method="post">
						<div class="form-group">
							<label for="login-email">Email address</label>
							<input type="email" class="form-control" name="email" id="login-email" placeholder="Email">
						</div>
						<div class="form-group">
					    	<label for="login-password">Password</label>
					    	<input type="password" class="form-control" name="password" id="login-password" placeholder="Password">
						</div>
						<input name="action" type="hidden" value="login" />
					  	<input type="submit" class="btn home-button" value="Login"></input>
					</form>
				</div>
				<div class="col-md-4"> <!-- col-md-5 -->
					<h4 class="text-center signup-text">SIGN UP</h4>
					<form action="" method="post">
						<div class="form-group">
							<label for="signup-name">Name</label>
							<input class="form-control" name="name" id="signup-name" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="signup-email">Email address</label>
							<input type="email" class="form-control" name="email" id="signup-email" placeholder="Email">
						</div>
						<div class="form-group">
					    	<label for="signup-password">Password</label>
					    	<input type="password" class="form-control" name="password" id="signup-password" placeholder="Password">
						</div>
						<div class="form-group">
					    	<label for="repeat-password">Re-enter password</label>
					    	<input type="password" class="form-control" name="repeat-password" id="repeat-password" placeholder="Re-enter password">
						</div>
						<input name="action" type="hidden" value="signup" />
					  	<input type="submit" class="btn home-button" value="Sign up"></input>
					</form>
				</div>
			</div>
		</div>
		<div class="bottom-centered">
			<div class="login-signup-container">
				<div><a href="index.html" class="home-about-text">AUDIOMAX</a></div>
			</div>
		</div> 
	</body>
</html>