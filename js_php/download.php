<?php
	if(isset($_GET['file'])) {
		$path_parts = pathinfo($_GET['file']);
		$file_name  = $path_parts['basename'];
		//echo $file_name;
		$file_path  = 'asd/' . $file_name;
		
		header("Content-Type: application/pdf");
		header("Content-Disposition: attachment; filename=\"$file_name\"");
		readfile($file_path);
	}
?>