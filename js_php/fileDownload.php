<?php
//database settings
$connect = mysqli_connect("localhost", "root", "", "filebank");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$path_parts = pathinfo($_GET['filename']);
	$file_name  = $path_parts['basename'];
	//echo $file_name;
	$file_path  = "secret/".$_GET['usernum']."/". $_GET['location'] ."/". $file_name;
		
	header("Content-Type: ".$_GET['filetype']);
	header("Content-Disposition: attachment; filename=\"$file_name\"");
	readfile($file_path);
}

?>