<?php 
	$server = 'localhost';
	$username = 'mgs_user';
	$password = 'pa55word';
	$dbname = 'learn_vocabulary';

	$conn = mysqli_connect($server, $username, $password, $dbname);

	if (!$conn) {
		die("Kết nối không thành công: " . mysqli_connect_error());
	}
?>