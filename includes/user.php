<?php
	require_once 'mysqldatabase.php';

	class User {
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;

		static public function findAll() {
			// gets the database connection
			$db = MySqlDatabase::getDbInstance();
			$sql = <<<SQL
				SELECT *
				FROM user
				ORDER BY id ASC;
SQL;
			return self::findBySql($sql);
		}

		static public function findById($id) {
			$db = MySqlDatabase::getDbInstance();
			$sql = <<<SQL
				SELECT *
				FROM user
				WHERE id = {$id}
				LIMIT 1;
SQL;

			$object_array = self::findBySql($sql);
			return !empty($object_array) ? array_shift($object_array) : FALSE;
		}

		static public function findBySql($sql) {
			$db = MySqlDatabase::getDbInstance();
			$result_set = $db->query($sql);

			// returns the result set as an array of objects
			$object_array = array();
			while($row = $db->fetchArray($result_set)) {
				$object_array[] = self::_instantiate($row);
			}

			return $object_array;
		}

		static private function _instantiate($record) {
			$obj = new self();

			if (is_array($record)) {
				foreach ($record as $attribute => $value) {
					if (property_exists($obj, $attribute)) {
						$obj->$attribute = $value;
					}
				}
			}
			return $obj;
		}




	}



?>