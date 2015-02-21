<?php
//database settings
$connect = mysqli_connect("localhost", "root", "", "filebank");

if($_SERVER['REQUEST_METHOD'] == "GET"){
	$result = mysqli_query($connect, "select * from user_info where email = \"".$_GET['email']."\" and password = \"".$_GET['pass']."\"");
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
}else if($_SERVER['REQUEST_METHOD'] == "POST") {
	$info = json_decode(file_get_contents("php://input"), true);
	//$result = mysqli_query($connect, "select * from user_info where email = \"".$info['email']."\" and password = \"".$info['pass']."\"");
	$result = mysqli_query($connect, "INSERT into user_info(name, email, password) values ('".$info['name']."', '".$info['email']."', '".$info['pass']."')");
	//$result = mysqli_query($connect, "select * from user_info where email = \"jeromellaguno@yahoo.com\" and password = \"asd\"");
}
//$result = mysqli_query($connect, "select * from user_info where email = \"jeromellaguno@yahoo.com\" and password = \"asd\"");
//echo "select * from user_info where email = \"".$_GET['email']."\" and password = \"".$_GET['pass']."\"";
?>