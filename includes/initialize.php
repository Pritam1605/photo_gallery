<?php

	// Path Constants
	defined('DS') ? NULL : define('DS', DIRECTORY_SEPARATOR);
	defined('SITE_ROOT') ? NULL : define('SITE_ROOT', dirname(__DIR__));
	defined('LIB_PATH') ? NULL : define('LIB_PATH', __DIR__);
	defined('LOG_FILE') ? NULL : define('LOG_FILE', SITE_ROOT . DS . )

	// Loading configs and UTIL functions
	require_once LIB_PATH . DS . 'config.php';
	require_once LIB_PATH . DS . 'functions.php';

	// Loading core objects
	require_once LIB_PATH . DS . 'mysqldatabase.php';
	require_once LIB_PATH . DS . 'session.php';
	require_once LIB_PATH . DS . 'databaseobject.php';
	require_once LIB_PATH . DS . 'logger.php';
	// Loading classes
	require_once LIB_PATH . DS . 'user.php';

?>