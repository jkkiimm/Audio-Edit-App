<?php
	include('db.php');
	session_start();
	$link = $_GET['link'];
	$track = $_GET['track'];
	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
	}else{
		header('Location: '. $link);
		die();
	}
	$dir = "songs/" . $email . "/";

	if(!(empty($link) || empty($track))){
		if(is_dir($dir) === false){
		    mkdir($dir);
		}
		if(!(file_exists($dir . $track))){
			file_put_contents($dir . $track, fopen($link, 'r'));
		}else{
			$editPage = "http://wheelsofsteel.net/?track1=http://localhost/Audio-Edit-App/songs/" . $email . "/" . $track;
			echo($editPage);
			exit;
		}
	}
	$editPage = "http://wheelsofsteel.net/?track1=http://localhost/Audio-Edit-App/songs/" . $email . "/" . $track;
	mysqli_query($connection, "INSERT INTO projects(email, file_location, link) VALUES('".$email."','".$track."','".$editPage."')");
	echo($editPage);
?>