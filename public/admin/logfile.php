<?php
	require_once '../../includes/initialize.php';

	// Handeling Session
	$session = Session::getInstance();
	if (!$session->isLoggedIn()) {
		redirect_to('login.php');
	}

	if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
		$username = User::findById($session->user_id)->username;

		$log = Logger::getInstance();
		if ($log->eraseLogFile()) {
			$message = 'Log file cleared successfully';
			$log->logAction('Log Erase', "{$username} erased log file.");
			redirect_to('logfile.php');
		} else {
			$message = 'Could not clear log file';
		}
	}
?>
<?php loadLayoutTemplate('admin_header'); ?>
	<div id="main">
		<?php
			if (!empty($message)) {
				echo output_message($message);
			}
		?>
		<h3>Log File </h3>
		<div>
			<ul>
				<?php
					$log = Logger::getInstance();
					$log_records = $log->readLog();
				?>
				<?php foreach ($log_records as $log_record) : ?>
				<li><?php echo $log_record; ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<strong><a href="index.php">&laquoBack</a></strong>
			<strong><a href="logfile.php?clear=true">Clear Log File</a></strong>
		</div>
	</div>
<?php loadLayoutTemplate('footer'); ?>

