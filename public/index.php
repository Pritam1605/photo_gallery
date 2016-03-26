<?php
	require_once __DIR__ . '/../includes/functions.php';
	// require_once __DIR__ . '/../includes/database.php';
	// require_once __DIR__ . '/../includes/user.php';

	$db = MySqlDatabase::getDbInstance();
	$db->closeDbConnection();
// 	$sql = <<<SQL
// 		Insert INTO user(username, password, first_name, last_name) VALUES
// 			('pritam1605', 'pritam', 'pritam', 'bohra'),
// 			('pritamkumar', 'pritamkumar', 'pritamkumar', 'bohra'),
// 			('davidhussey', 'david', 'hussey', 'dave'),
// 			('mahimsd', 'msd', 'Mahendra', 'Dhoni'),
// 			('Sachin', 'srt', 'Sachin', 'tendulkar');
// SQL;
// 	$result = $db->query($sql);
// 	$sql = <<<SQL
// 		SELECT * FROM user;
// SQL;
// 	$result = $db->query($sql);
// 	pp($db->fetchArray($result));

	// $user = new User();
	// $result = User::findAll();
	// pp($result);
	// while ($row = $db->fetchArray($result)) {
	// 	echo $row['username'], '<br />';
	// }

	// $users = User::FindAll();
	// foreach ($users as $user) {
		//pp($user->username);
	//}

	//$user = User::findById(1);
	//pp($user);
	session_start();
	$_SESSION['user_id'] = 10;
	$obj = Session::getSessionInstance();
	pp($obj);
	pp($_SESSION);
	$obj1 = Session::getSessionInstance();
	pp($obj1);
	$obj1->logOut();
	// pp($obj);
	// pp($obj1);
	$_SESSION['user_id'] = 100;


	pp($_SESSION);

	$obj1 = Session::getSessionInstance();
	pp($obj1);
	$obj1->logOut();
	pp($obj1);

?>