<?php
	$conn = mysqli_connect ('localhost', 'root', '', 'xebuyt') or die ('Không thể kết nối tới database');
	mysqli_set_charset($conn, 'UTF8');
	mysqli_query($conn, "set name 'UTF8'");
?>