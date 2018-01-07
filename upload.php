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

	function readZip($f){
		$zip = new ZipArchive(); 
		$res = $zip->open($f);
		if ($res !== true){
			throw new Exception('failed, code:' . $res);
		}
		for ($i=0;$i<$zip->numFiles; $i++){
			$stat=$zip->statIndex($i);
			echo $stat['name'];
			$stream = $zip->getStream($stat['name']);
			$line=0;
			$content=array();
			while(!feof($stream)){
				$content[$line%100] = fgets($stream);
				$line++;
				if($line%100==0){
					$content=array_filter($content);
					echo "Now is $line line.";
					yield $content;
					unset($content);
				}
			}
		} 
	}

	class Mysql{
		private 
	}

?>

<?php

	// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
	// of $_FILES.
	header("Content-Type: text/html; charset=utf-8");
	echo "<pre>";
	// 1. check if there is an error reported while uploading
	// check if upload to the tmp dir
	// check the validation of the upload file
	try{
		checkuploadstatus($_FILES['file']['error']);
		checkuploadfilestatus($_FILES['file']['tmp_name']);	
		isvalid_uploadfile($_FILES['file']['name']);
		$zipcontent = readZip($_FILES['file']['tmp_name']);
	}catch(Exception $e){
		echo $e->getMessage();
		echo "</pre>";
		exit();
	}
	print_r($_FILES);
	
	foreach ($zipcontent as $content){
		print_r($content);
	}
	
/*
	// 3. check if the file upload is valid.
	$file_type = end(explode("/",$_FILES['file']['type']));
	$allow_types=explode("|","zip|vnd.rar");
	if (!in_array($file_type,$allow_types)){
		exit("File is not valid, it must be a zip or rar.");
	}
		// 4. unpack the file
		$tmp_filename=md5($_FILES['file']['name']);
	if($file_type=="zip"){
		$zip = new ZipArchive(); 
		$res = $zip->open($_FILES['file']['tmp_name']); 
		if ($res === true) { 
			for ($i=0;$i<$zip->numFiles; $i++){
				$stat=$zip->statIndex($i);
				print_r((basename($stat['name']) . PHP_EOL));
			}
		} else { 
		    echo 'failed, code:' . $res;
		} 
	} else{
		echo "Begin unrar file...";
		$rar_file=rar_open($_FILES['file']['tmp_name']) or die("Failed to open this rar archive");
			$entries_list = rar_list($rar_file); 
			print_r($entries_list);
		}*/

		// 5. read the statinfo of the file
		// $fp = fopen($_FILES['file']['tmp_name'], "r");
		// $fstat = fstat($fp); 
		// fclose($fp); 
		// print_r(array_slice($fstat, 13));

		// 6. move to specify place if need
		// $uploaddir="./upload/";
		// $uploadfile = $uploaddir . md5($_FILES['file']['name']);

		// if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		// 	echo "File is valid, and was successfully moved.\n";
		// } else {
		// 	echo "<P>MOVE UPLOADED FILE FAILED!!</P>";
		// 	print_r(error_get_last());
		// }

		// echo 'Here is some more debugging info:';
		// print_r($_FILES);
		echo "</pre>";
?>
