<?php
	require_once __DIR__ . '/../../includes/mysqldatabase.php';
	require_once __DIR__ . '/../../includes/functions.php';
	require_once __DIR__ . '/../../includes/session.php';
	require_once __DIR__ . '/../../includes/user.php';

	// Handeling Session
	$session = Session::getSessionInstance();
	// if ($session->isLoggedIn()) {
	// 	redirect_to('index.php');
	// }

	$message = "";
	//$username = $password = "";
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
</head>
<body>
	<?php echo $message; ?>
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
</body>
</html>