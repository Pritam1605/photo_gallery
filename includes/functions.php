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

?>