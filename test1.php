<?php

	if (isset($a)) {
		var_dump("It is null");
	} else {
		var_dump("It is not null");
	}

	$handle = fopen('logs/log/sog/abc', 'a+');

	$a = 'true';
	if($a == 'true') {
		echo "a is true";
	}

?>