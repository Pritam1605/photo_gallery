<?php

	// Handeling Session
	$session = Session::getInstance();
	if (!$session->isLoggedIn()) {
		redirect_to('login.php');
	}

	if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
		$username = User::findById($session->user_id)->username;

		$log = Logger::getInstance();
		$log->eraseLogFile();
		$log->logAction('Log Erase', "{$usename} erased log file.");
	}



?>