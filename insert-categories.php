<?php
include('shared/auth.php');
$title = 'Saving New Category';
include('shared/header.php');

// Capture Form Input
$categories = $_POST['add-category'];
$ok = true;

// Validation
if (empty($categories)) {
	$ok = false;
	echo 'Text is required';
}

if ($ok == true) {
	try {

		//connect to db
		include('shared/db.php');

		//set up SQL INSERT
		$sql = "INSERT INTO categories (name) VALUES (:name)";
		$cmd = $db->prepare($sql);
		$cmd->bindParam(':name',  $categories, PDO::PARAM_STR, 50);
		$cmd->execute();

		$db = null;
		echo 'New Category Saved';
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}

include('shared/footer.php');
?>