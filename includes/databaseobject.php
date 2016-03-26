<?php
	require_once 'initialize.php';

	class DatabaseObject {

		static public function findAll() {
			$table_name = static::$table_name;		// PHP doesn't allow heredoc to use static variable directly
			$sql = <<<SQL
				SELECT *
				FROM {$table_name}
				ORDER BY id ASC;
SQL;
			return static::findBySql($sql);
		}

		static public function findById($id) {
			$table_name = static::$table_name;		// PHP doesn't allow heredoc to use static variable directly
			$sql = <<<SQL
				SELECT *
				FROM {$table_name}
				WHERE id = {$id}
				LIMIT 1;
SQL;
			$object_array = static::findBySql($sql);
			return !empty($object_array) ? array_shift($object_array) : FALSE;
		}

		static public function findBySql($sql) {
			// gets the database connection
			$db = MySqlDatabase::getDbInstance();
			$result_set = $db->query($sql);

			// returns the result set as an array of objects
			$object_array = array();
			while($row = $db->fetchArray($result_set)) {
				$object_array[] = static::_instantiate($row);
			}

			return $object_array;
		}

		static private function _instantiate($record) {
			$obj = new static();

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