<?php
include('shared/auth.php');

// Read the activityID from the url parameter using $_GET
$crownID = $_GET['activityID'];

if (is_numeric($crownID)) {
	try {

		// Connect To DB
		include('shared/db.php');

		// Prepare SQL DELETE
		$sql = "DELETE FROM crownLog3 WHERE activityID = :activityID";
		$cmd = $db->prepare($sql);
		$cmd->bindParam(':activityID', $crownID, PDO::PARAM_INT);

		// Execute the delete
		$cmd->execute();

		// Disconnect
		$db = null;

		// Show a temporary confirmation message in theory (too quick to see!)
		echo "Private Data Deleted";

		// Redirect back to updated the-deed.php
		header('location:the-deed.php');

	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}

// GitHub not committing test
?>