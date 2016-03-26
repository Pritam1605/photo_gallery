<?php

	function pp($str) {
		echo "<pre>";
		print_r($str);
		echo "</pre>";
	}

	function strip_zeros_from_date($date = "") {
		// removes marked zeros from the string
		$no_zeros = str_replace('*0', '', $date);

		// removes * (if any) from the date
		$clean_string = str_replace('*', '', $no_zeros);

		return $clean_string;
	}

	function redirect_to($location = NULL) {
		if (!is_null($location)) {
			header("Location: {$location}");
			exit;
		}
	}

	function output_message($message = "") {
		if (!empty($message)) {
			return "<p class=\"message\">{$message}</p>";
		} else {
			return "";
		}
	}

	spl_autoload_register(function($class_name) {
		$class_name = strtolower($class_name);
		$path = LIB_PATH . DS . $class_name . '.php';

		if (file_exists($path)) {
			require_once $path;
		} else {
			die("The file {$path} not found");
		}
	});

	function loadLayoutTemplate($template = "") {
		include SITE_ROOT . DS . 'public' . DS . 'layout_template' . DS . $template . '.php';
	}

	/*function __autoload($class_name) {
		$class_name = strtolower($class_name);
		$path = __DIR__ . "/../includes/{$class_name}.php";

		if (file_exists($path)) {
			require_once $path;
		} else {
			die("The file {$path} not found");
		}
	}*/
?>