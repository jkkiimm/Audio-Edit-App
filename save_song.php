<?php
	/*
	 * save_song.php connects to the database and saves the song on the server.
	 */
	include('db.php');
	session_start();
	// Grab the session variables.
	$link = $_GET['link'];
	$track = $_GET['track'];
	// if user is signed into with a session email, then set the email variable. 
	// if not, download the song that was converted.
	if(isset($_SESSION['email'])){
		$email = $_SESSION['email'];
	}else{
		header('Location: '. $link);
		die();
	}

	// the songs are stored in the songs folder with the email as the directory for songs based on specific users.
	$dir = "songs/" . $email . "/";

	// make the directories if they do not exist and redirect to audio manipulation page.
	if(!(empty($link) || empty($track))){
		if(is_dir($dir) === false){
		    mkdir($dir);
		}
		if(!(file_exists($dir . $track))){
			file_put_contents($dir . $track, fopen($link, 'r'));
		}else{
			$editPage = "http://www.carloslovera.com/main/?track1=http://localhost/Audio-Edit-App/songs/" . $email . "/" . $track;
			echo($editPage);
			exit;
		}
	}

	// after downloading the song, then save the file_location into the database.
	$editPage = "http://www.carloslovera.com/main/?track1=http://localhost/Audio-Edit-App/songs/" . $email . "/" . $track;
	mysqli_query($connection, "INSERT INTO projects(email, file_location, link) VALUES('".$email."','".$track."','".$editPage."')");
	echo($editPage);
?>