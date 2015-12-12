<?php
	/*
	 * logout_action.php checks the session attributes and deletes the session cookie and variables.
	 * Afterwards, logout_action.php redirects user to home page.
	 */
	session_start();
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}
	session_destroy();
	header('Location: index.html');
	die();
	exit;
?>