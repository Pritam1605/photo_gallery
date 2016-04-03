<?php
	require_once 'initialize.php';

	class Logger {

		static private $_instance;
		CONST LOGIN_FILE = 'login.txt';

		private $_handle;

		static public function getInstance() {
			if (!isset(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function __construct() {
			// To make this piece of code run we need to make WWW-Data as the owner of the entire photo_gallery folder
			// Doing so would introduce security issues, thus we need to manually do it using terminal i.e. create log folder and assign it's owner as WWW-Data
			/*if (!file_exists(LOG_PATH)) {
				mkdir(SITE_ROOT . DS . 'logs', 0777, TRUE);
			}*/
			$is_new = file_exists(LOG_PATH . DS . self::LOGIN_FILE) ? FALSE : TRUE;
			$this->_handle = fopen(LOG_PATH . DS . self::LOGIN_FILE, 'a+');
			if ($is_new) {
				// Makes sure that if the file is new, we change the permission and and assign read and execute permission to GROUP and OTHERs
				chmod(LOG_PATH . DS . self::LOGIN_FILE, 0755);
			}
		}

		public function closeLoggerFile() {
			if (!is_null($this->_handle)) {
				fclose($this->_handle);
				unset($this->_handle);
				self::$_instance = NULL;
			}
		}

		public function logAction($action, $message = "") {

			if ($this->_handle) {
				$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
				$content = $timestamp . "| {$action} : {$message}\n";

				if (is_writable(LOG_PATH . DS . self::LOGIN_FILE)) {
					$written_content = fwrite($this->_handle, $content);
				} else {
					die('Log file is not writable');
				}
			}
		}

		public function eraseLogFile() {
			if ($this->_handle) {
				if (ftruncate($this->_handle, 0)) {
					return TRUE;
				}
			}
			return FALSE;
		}

		public function readLog() {
			$log_record = array();
			if ($this->_handle && is_readable(LOG_PATH . DS . self::LOGIN_FILE)) {
				while(!feof($this->_handle)) {
					$record = fgets($this->_handle);
					if (trim($record) !== "") {
						$log_record[] = $record;
					}
				}
			}
			return $log_record;
		}
	}
?>