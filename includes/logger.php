<?php
	require_once 'initialize.php';

	class Logger {

		static private $_instance;
		CONST LOG_FILE = 'log.txt';
		CONST FILE_PATH = SITE_ROOT . DS . 'logs' . DS . self::LOG_FILE;
		private $_handle;

		static public function getInstance() {
			if (!is_null(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function __construct() {
			if (!file_exists(self::FILE_PATH)) {
				$this->_handle = fopen(self::FILE_PATH, 'a+');
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
				$session = Session::getInstance();
				$username = User::findById($session->user_id)->username;
				$content = $timestamp . "| {$action} : {$message} \n";
				if (is_writable(self::FILE_PATH)) {
					$written_content = fwrite($this->_handle, $content);
				}
			}
		}


	}

?>