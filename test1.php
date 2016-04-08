<?php

	//phpinfo();
	// if (isset($a)) {
	// 	var_dump("It is set");
	// } else {
	// 	var_dump("It is not set");
	// }

	// $handle = fopen('logs/log/sog/abc', 'a+');

	// $a = 'true';
	// if($a == 'true') {
	// 	echo "a is true";
	// }

	//file_uploads
	//upload_tmp_dir
	//post_max_size
	//upload_max_filesize
	//max_execution_time
	//max_input_time
	//memory_limit

	$file_upload_errors = array(
		UPLOAD_ERR_OK => 'File Uploaded Successfully',
		UPLOAD_ERR_INI_SIZE => 'Larger than upload_max_filesize',
		UPLOAD_ERR_FORM_SIZE => 'Larger than MAX_FILE_SIZE',
		UPLOAD_ERR_PARTIAL => 'Partial upload',
		UPLOAD_ERR_NO_FILE => 'No file uploaded',
		UPLOAD_ERR_NO_TMP_DIR => 'No temporary directory found',
		UPLOAD_ERR_CANT_WRITE => 'Can not write to the disk',
		UPLOAD_ERR_EXTENSION => 'File upload stopped by extension',
	);

	if (isset($_POST['submit'])) {
		$tmp_name = $_FILES['file_upload']['tmp_name'];
		$file_name = basename($_FILES['file_upload']['name']);
		$upload_path = 'uploads';

		if (move_uploaded_file($tmp_name, $upload_path . '/' . $file_name)) {
			$message = 'File successfully uploaded';
		} else {
			$error = $_FILES['file_upload']['error'];
			$message = $file_upload_errors[$error];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Upload</title>
	</head>
	<body>
		<?php
			if (!empty($message)) {
				echo $message;
			}
		?>
		<form action="test1.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
			<input type="file" name="file_upload" />
			<input type="submit" name="submit" value="Upload" />
		</form>
	</body>
</html>