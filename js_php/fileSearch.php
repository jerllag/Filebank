<?php
//database settings
$connect = mysqli_connect("localhost", "root", "", "filebank");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$result = mysqli_query($connect, "select * from files where usernum = \"".$_GET['usernum']."\" and filename =\"".$_GET['filename']."\"");
	//$result = mysqli_query($connect, "select * from user_info where usernum = \"".$_GET['usernum']."\"");
	$data = array();

	while ($row = mysqli_fetch_array($result)) {
	  $data[] = $row;
	}

	if(count($data) > 0) {
		print json_encode($data);
	} else {
		http_response_code(404);
	}
}

?>