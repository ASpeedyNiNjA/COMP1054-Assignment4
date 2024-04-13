<?php
include('shared/auth.php');
// 1. Capture Form Inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

try {
	// 2. Validate Inputs
	if (empty($username)) {
		echo 'Username is required<br />';
		$ok = false;
	}

	if (strlen($password) < 8) {
		echo '8-Char Password is required<br />';
		$ok = false;
	}

	if ($password != $confirm) {
		echo 'Passwords must match <br />';
		$ok = false;
	}

	// 3. Hash the Password
	$passwordHash = password_hash($password, PASSWORD_DEFAULT);

	// 4. Connect to DB & Insert New User
	include('shared/db.php');

	// 4a. Duplicate User Check
	$sql = "SELECT * FROM users WHERE username = :username";
	$cmd = $db->prepare($sql);
	$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
	$cmd->execute();
	$users = $cmd->fetchAll();

	if (!empty($users)) {
		// username already exists
		$db = null;
		header('location:register.php?duplicate=true');
		exit();
	}


	$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
	$cmd = $db->prepare($sql);
	$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
	$cmd->bindParam(':password', $passwordHash, PDO::PARAM_STR, 255);
	$cmd->execute();

	// 5. Disconnect
	$db = null;

	// 6. Confirmation
	//echo 'User saved';

	// 7. Redirect to Login
	header('location:login.php');
}
catch (Exception $err) {
	header('location:error.php');
	exit();
}

?>