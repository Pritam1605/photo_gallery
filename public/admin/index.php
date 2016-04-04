<?php
	require_once __DIR__ . '/../../includes/initialize.php';

	$session = Session::getInstance();
	if (!$session->isLoggedIn()) {
		redirect_to('login.php');
	}
?>
<?php loadLayoutTemplate('admin_header'); ?>
	<div id="main">
		<h2>Main</h2>
		<?php
			if (!empty($message)) {
				echo output_message($message);
			}
		?>
		<ul>
			<li><a href="logfile.php">Logfile</li></a>
			<li><a href="logout.php">LogOut</li></a>
		</ul>
	</div>
<?php loadLayoutTemplate('footer'); ?>