<?php
	require_once __DIR__ . '/../includes/database.php';

	$db = MySqlDatabase::getDbInstance();

	$sql = <<<SQL
		Insert INTO user VALUES(10, 'pritam1605', 'pritam', 'pritam', 'bohra');
SQL;

	$sql = <<<SQL
		SELECT * FROM user;
SQL;
	$result = $db->query($sql);
	pp($db->fetch_array($result)[1]);
?>