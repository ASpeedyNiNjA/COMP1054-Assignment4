<?php
include('shared/auth.php');
$title = 'Saving New Participants';
include('shared/header.php');

// Capture Form Input
$participants = $_POST['participant-category'];
$ok = true;

// Validation
if (empty($participants)) {
	$ok = false;
	echo 'Text is required';
}

if ($ok == true) {
	try {

		//connect to db
		include('shared/db.php');

		//set up SQL INSERT
		$sql = "INSERT INTO participants (name) VALUES (:name)";
		$cmd = $db->prepare($sql);
		$cmd->bindParam(':name',  $participants, PDO::PARAM_STR, 50);
		$cmd->execute();

		$db = null;
		echo 'Participants Category Saved';
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}

include('shared/footer.php');
?>