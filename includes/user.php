<?php
	require_once 'database.php';

	class User {

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
				WHERE id = {$id};
SQL;

			$result = self::findBySql($sql);
			return $db->fetchArray($result);
		}

		static public function findBySql($sql) {
			$db = MySqlDatabase::getDbInstance();
			return $db->query($sql);
		}
	}



?>