<?php
	require_once __DIR__ . '/../../includes/initialize.php';

	// Handeling Session
	$session = Session::getInstance();
	if ($session->isLoggedIn()) {
		redirect_to('index.php');
	}

	$message = "";

	// Handeling submission
	if (isset($_POST['submit'])) {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {

			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$login_user = User::authenticate($username, $password);
			if ($login_user) {
				$session->logIn($login_user);

				$log = Logger::getInstance();
				$log->logAction("Login", $login_user->username . ' logged in.');

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
<?php loadLayoutTemplate('admin_header'); ?>
	<div id="main">
		<?php echo output_message($message); ?>
		<h3>Staff Login</h3>

		<form action="login.php" method="post">
			<table>
				<tr>
					<td><label for="username">Username :</label></td>
					<td><input type="text" id="username" name="username" value="<?php echo htmlentities($username); ?>"/></td>
				</tr>
				<tr>
					<td><label for="password">Password :</label></td>
					<td><input type="password" id="password" name="password" value="<?php echo htmlentities($password); ?>"/></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Submit"/>
		</form>
	</div>
<?php loadLayoutTemplate('footer'); ?>