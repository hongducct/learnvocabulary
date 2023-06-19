<?php 
session_start();

function add_user($username, $password, $email) {
	global $conn;

	$sql = "INSERT INTO user(username, password, email) 
		VALUES ('$username', '$password', '$email')";

	mysqli_query($conn, $sql);
}

function check_login($username, $password) {
	global $conn;

	$sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) === 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row['username'] === $username && $row['password'] === $password) {
			$_SESSION['username'] = $row['username'];
			$_SESSION['id'] = $row['id'];

			header("Location: ../vocab/index.php");
			exit();
		}else {
			header("Location: ../index.php?error=Incorrect Username or Password");
			exit();
		}
	}else {
		header("Location: ../index.php?error=Incorrect Username or Password");
		exit();
	}
}

function check_signup($username, $password, $email) {
	global $conn;

	$sql = "SELECT * FROM user WHERE username='$username'  OR email='$email'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result)>0) {
		header('Location: ../sign-up.php?error=Tên người dùng hoặc email đã được sử dụng. Vui lòng chọn một tên khác hoặc email khác');
		exit();
	}else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		header('Location: ../sign-up.php?error=Valid email is required');
		exit();
	}else if (strlen($_POST["password"] < 8)) {
		header('Location: ../sign-up.php?error=Password must be at least 8 characters');
		exit();
	}else if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
		header('Location: ../sign-up.php?error=Password must contain at least one lowercase letter');
		exit();
	}else if ( ! preg_match("/[0-9]/i", $_POST["password"])) {
		header('Location: ../sign-up.php?error=Password must contain at least one number');
		exit();
	}else if ($_POST["password"] != $_POST["password_confirmation"]) {
		header('Location: ../sign-up.php?error=Passwords must match');
		exit();
	}else {
		add_user($username, $password, $email);
		header("Location: ../index.php");
		exit();
	}
}

function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

 ?>