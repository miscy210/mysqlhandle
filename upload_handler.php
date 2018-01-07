<?php 
function checkuploadstatus($a){
	if ($a){ 
		throw new Exception("what");
	}
	return true;
}

function checkuploadfilestatus($f){
	if (is_uploaded_file($f)) {
		return true;
	} else {
		throw new Exception("Possible file upload attack: \n" . error_get_last());
	}
}

function isvalid_uploadfile($f){
	$file_ext = end(explode(".",$f));
	$allow_types=explode("|","zip");
	if (!in_array($file_ext,$allow_types)){
		throw new Exception("File is not valid!");
	}
	return true;
}

	// function readZip(filename){
	// 	$zip = new ZipArchive(); 
	// 	$res = $zip->open($_FILES['file']['tmp_name']);
	// 	if ($res === true){
	// 		return $zip;
	// 	}else{
	// 		throw new Exception('failed, code:' . $res);
	// 	}
	// }

function startHtml(){
	echo "<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<title>显示成文件</title>
	</head>
	<body>
		<pre>
			";
		}

		function endHtml(){
			echo "</pre>";
			echo "
		</body>
		</html>";
	}

?>