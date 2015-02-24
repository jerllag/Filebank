<?php
//database settings
$connect = mysqli_connect("localhost", "root", "", "filebank");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$result = mysqli_query($connect, "select * from files where usernum = \"".$_GET['usernum']."\" and location =\"".$_GET['location']."\"");
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
	$imgData = null;
	if(isset($_FILES['file'])) {
		$fileName = $_FILES['file']['name'];
        $fileSize =$_FILES['file']['size'];
        $fileTmp =$_FILES['file']['tmp_name'];
        $fileType=$_FILES['file']['type'];   
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$targetFile = $_POST['usernum']."/".$_POST['location']."/".$fileName;
		//$result = mysqli_query($connect, "INSERT into files(usernum, filename, type, dateModif, location, isFolder, files) values ('".$_POST['usernum']."', '".$fileName."', '".$fileType."', '"."2015-02-14"."', '".$_POST['location']."', '".$_POST['isFolder']."', '".$fileTmp."')");
		//mkdir("bcd");
		if(move_uploaded_file($fileTmp, "secret/".$_POST['usernum']."/".$_POST['location']."/".$fileName)) {
			$result = mysqli_query($connect, "INSERT into files(usernum, filename, type, dateModif, location, isFolder) values ('".$_POST['usernum']."', '".$fileName."', '".$fileType."', '".date("Y/m/d")."', '".$_POST['location']."', '".$_POST['isFolder']."')");
		}
			//$imgData = addslashes(file_get_contents($_FILES['file']['tmp_name']));
			//$result = mysqli_query($connect, "INSERT into files(usernum, filename, type, dateModif, location, isFolder) values (2, 'New Folder123', 'folder', '2015-02-12', 'home', 1)");
	} else {
	//$result = mysqli_query($connect, "select * from user_info where email = \"".$info['email']."\" and password = \"".$info['pass']."\"");
	$result = mysqli_query($connect, "INSERT into files(usernum, filename, type, dateModif, location, isFolder) values ('".$info['usernum']."', '".$info['filename']."', '".$info['type']."', '".date("Y/m/d")."', '".$info['location']."', '".$info['isFolder']."')");
	if (!file_exists('secret/'.$info['usernum'].'/'.$info['location'].'/'.$info['filename'])) {
		mkdir('secret/'.$info['usernum'].'/'.$info['location'].'/'.$info['filename']);
		//mkdir('secret/7/home');
	}
	/*if (!file_exists('secret/7/home')) {
		mkdir('secret/7/home');
	}*/
	//$result = mysqli_query($connect, "INSERT into files(usernum, filename, type, dateModif, location, isFolder) values (2, 'New Folder', 'folder', '2015-02-12', 'home', 1)");
	//$result = mysqli_query($connect, "select * from user_info where email = \"jeromellaguno@yahoo.com\" and password = \"asd\"");
	}
}
//$result = mysqli_query($connect, "select * from user_info where email = \"jeromellaguno@yahoo.com\" and password = \"asd\"");
//echo "select * from user_info where email = \"".$_GET['email']."\" and password = \"".$_GET['pass']."\"";
?>