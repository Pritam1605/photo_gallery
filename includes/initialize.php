<?php

	// Path Constants
	defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);
	defined('SITE_ROOT') ? NULL : define('SITE_ROOT', DS . 'home' . DS . 'pritam'. DS . 'web_server' . DS . 'pritamphp.com' . DS . 'photo_gallery');
	defined('LIB_PATH') ? NULL : define('LIB_PATH', SITE_ROOT . DS . 'includes');

	// Loading configs and UTIL functions
	require_once LIB_PATH . DS . 'config.php';
	require_once LIB_PATH . DS . 'functions.php';

	// Loading core objects
	require_once LIB_PATH . DS . 'mysqldatabase.php';
	require_once LIB_PATH . DS . 'session.php';
	require_once LIB_PATH . DS . 'databaseobject.php';

	// Loading classes
	require_once LIB_PATH . DS . 'user.php';

?>