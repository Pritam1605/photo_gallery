<?php
	require_once '../../includes/initialize.php';

	// Handeling Session
	$session = Session::getInstance();
	if (!$session->isLoggedIn()) {
		redirect_to('login.php');
	}

	$message = "";

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
		<?php echo output_message($message); ?>
		<h3>Admin Log</h3>
		<div>
			<table>
				<?php
					$log = Logger::getInstance();
					$log_records = $log->readLog();
				?>
				<?php foreach ($log_records as $log_record) : ?>
				<tr>
					<td><?php echo $log_record; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div>
			<a href="logfile.php?clear=true">Clear Log File</a>
		</div>
	</div>
<?php loadLayoutTemplate('footer'); ?>

