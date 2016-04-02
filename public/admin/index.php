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
	</div>
<?php loadLayoutTemplate('footer'); ?>