<?php
	require_once __DIR__ . '/../../includes/session.php';
	require_once __DIR__ . '/../../includes/functions.php';

	$session = Session::getSessionInstance();
	if (!$session->isLoggedIn()) {
		redirect_to('login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Main Menu</title>
		<link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
	</head>
	<body>
		<div id="header">
			<h1>Photo Gallery</h1>
		</div>
		<div id="main">
			<h2>Main</h2>
		</div>
		<div id="footer">
			<p> photogallery.com Copyrights <?php echo  date('Y', time()); ?>, Pritam Bohra
		</div>
	</body>
</html>