<?php
	require_once 'initialize.php';

	class User extends DatabaseObject {

		static protected $table_name = 'user';
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;

		static public function authenticate($username = "", $password = "") {
			$db = MySqlDatabase::getDbInstance();
			$table_name = self::$table_name;		// PHP doesn't allow heredoc to use static variable directly
			$username = $db->escapeValue($username);
			$password = $db->escapeValue($password);

			$sql = <<<SQL
				SELECT *
				FROM {$table_name}
				WHERE username = '{$username}' AND password = '{$password}'
				LIMIT 1;
SQL;
			$object_array = self::findBySql($sql);
			return !empty($object_array) ? array_shift($object_array) : FALSE;
		}
	}
?>