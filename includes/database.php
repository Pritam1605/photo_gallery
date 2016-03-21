<?php
	require_once 'config.php';
	require_once 'functions.php';

	class MySqlDatabase {

		static private $_instance;
		private $_connection;

		static public function getDbInstance() {
			// Using the Singleton pattern for database connection
			if (!isset(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function __construct() {
			// Won't let create unnecessary objects
			$this->_connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

			if (mysqli_connect_errno()) {
				trigger_error("Connection Error" . mysqli_connect_errno(), E_USER_ERROR);
			}
		}

		public function getDbConnection() {
			return $this->_connection;
		}

		private function __clone() {
			// Keeping the body empty will not allow cloning the class object as we are following the singleton pattern
		}

		public function closeDbConnection() {
			if (isset(self::$_instance)) {
				mysqli_close($this->_connection);
				unset(self::$_instance);
			}
		}
	}

	$test = MySqlDatabase::getDbInstance();
	$db = $test->getConnection();
	pp($db);
?>