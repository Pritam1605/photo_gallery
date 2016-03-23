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

		public function closeDbConnection() {
			if (isset(self::$_instance)) {
				mysqli_close($this->_connection);
				unset(self::$_instance);
			}
		}

		private function __clone() {
			// Keeping the body empty will not allow cloning the class object as we are following the singleton pattern
		}

		public function query($sql) {
			$result = mysqli_query($this->_connection, $sql);
			$this->_confirmQuery($result);

			return $result;
		}

		private function _confirmQuery($result) {
			if (!$result) {
				trigger_error("Error: " . mysqli_error($this->_connection), E_USER_ERROR);
			}
		}

		public function fetchArray($result_set) {
			return mysqli_fetch_array($result_set);
		}

		public function escapeValue($str) {
			return mysqli_real_escape_string($this->_connection, $str);
		}

		// returns the number of rows fetched by the query
		public function numRows($result_set) {
			return mysqli_num_rows($result_set);
		}

		// returns the number of rows affected by the DML statement
		public function numAffectedRows() {
			return mysqli_affected_rows($this->_connection);
		}

		// returns the last insert id over the connection
		public function getInsertId() {
			return mysqli_insert_id($this->_connection);
		}
	}
?>