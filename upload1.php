<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
header("Content-Type: text/html; charset=utf-8");
$uploaddir="./upload/";
$uploadfile = $uploaddir . md5($_FILES['file']['name']);
echo "$uploadfile";
echo '<pre>';
if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
	echo "<P>MOVE UPLOADED FILE FAILED!!</P>";
    print_r(error_get_last());
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>