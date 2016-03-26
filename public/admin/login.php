<?php
	require_once __DIR__ . '/../../includes/initialize.php';

	// Handeling Session
	$session = Session::getSessionInstance();
	// if ($session->isLoggedIn()) {
	// 	redirect_to('index.php');
	// }

	$message = "";

	// Handeling submission
	if (isset($_POST['submit'])) {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {

			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$login_user = User::authenticate($username, $password);
			if ($login_user) {
				$session->logIn($login_user);
				redirect_to('index.php');
			} else {
				$message = 'Username/Password do not match';
			}
		} else {
			$username = $password = "";
			$message = 'Please enter both username and password';
		}
	} else {
		$username = $password = "";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Admin Login</title>
		<link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
	</head>
	<body>
		<div id="header">
			<h1>Photo Gallery</h1>
		</div>
		<div id="main">
			<?php echo output_message($message); ?>
			<h3>Staff Login</h3>

			<form action="login.php" method="post">
				<label for="username">Username :
					<input type="text" id="username" name="username" value="<?php echo htmlentities($username); ?>"/>
				</label>
				<br/>
				<label for="password">Password :
					<input type="password" id="password" name="password" value="<?php echo htmlentities($password); ?>"/>
				</label>
				<br />
				<input type="submit" name="submit" value="Submit"/>
			</form>
		</div>
		<div id="footer">
			<p> photogallery.com Copyrights <?php echo  date('Y', time()); ?>, Pritam Bohra
		</div>
	</body>
</html>