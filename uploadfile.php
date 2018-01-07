<?php
	header("Content-Type: text/html; charset=utf-8");
	echo '<input type="hidden" name="max_file_size" value="1000000000">'; # 100M
	echo '<input type="file" name="file" id="file" class="filestyle" />';
?>
