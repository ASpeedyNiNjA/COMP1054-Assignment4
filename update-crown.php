<?php 
include('shared/auth.php');
$title = 'The crown has been notified!';
include('shared/header.php');

// Capture form inputs into variables
$crownID = ($_POST['activityID']);
$date = ($_POST['crown-date']);
$start = ($_POST['crown-start']);
$end = ($_POST['crown-end']);
$participants = ($_POST['crown-participants']);
$category = ($_POST['crown-category']);
$ok = true;

// Input validation before save
if (empty($date)) {
	echo 'It\'d be great to know what date mate!'; //I double checked, the HTML date form input type by default won't allow a month number greater than 12. 
	$ok = FALSE;
}
if (empty($start)) {
	echo 'Sorry if this is a little uncomfortable, when did "it" start?';
	$ok = FALSE;
}
if (empty($end)) {
	echo 'Even more uncomfortable, when did you finish?';
	$ok = FALSE;
}
if (empty($participants)) {
	echo 'Were you alone?'; //<-- That sounds creepy...
	$ok = FALSE;
}
if (empty($category)) {
	echo 'It has to be one of the above!';
	$ok = FALSE;
}

// process photo if any
if ($_FILES['photo']['size'] > 0) {
	$photoName = $_FILES['photo']['name'];
	$finalName = session_id() . '-' . $photoName;
	//echo $finalName . '<br />';

	// in php, file size is bytes (1kb = 1024 bytes)
	$size = $_FILES['photo']['size'];
	//echo $size . '<br />';

	// file type
	//$type = $_FILES['photo']['type']; //Never use this - unsafe, only checks extension
	
	// temp location in server cache
	$tmp_name = $_FILES['photo']['tmp_name']; //Saves in a different spot on the server each time
	//echo $tmp_name . '<br />';

	//file type II
	$type = mime_content_type($tmp_name); //Use this, checks actual file type in temporary location on server
	//echo $type . '<br />';

	if ($type != 'image/jpeg' && $type != 'image/png') {
		echo 'Photo must be a .jpg or .png';
		exit();
	} else {
	// save file to img/uploads
	move_uploaded_file($tmp_name, 'images/uploads/' . $finalName);
	}
}
else {
	// no new photo uploaded, keep current photo set in hidden input on form
	// this prevents an existing photo being set to null and removed
	$finalName = $_POST['currentPhoto'];
}

// Connect to Database
if ($ok == true) { 
	try {
		include('shared/db.php'); 

		// SQL UPDATE Command
		$sql = "UPDATE crownLog3 SET crownDate = :date, crownStart = :start, crownEnd = :end, crownParticipants = :participants, crownCategory = :category, photo = :photo WHERE activityID = :activityID" ;

		// Link DB Connection w/SQL command 
		$cmd = $db->prepare($sql);

		// Map each input to a column in the crown table
		$cmd->bindParam(':activityID', $crownID, PDO::PARAM_INT);
		$cmd->bindParam(':date', $date, PDO::PARAM_STR, 10);
		$cmd->bindParam(':start', $start, PDO::PARAM_STR, 5);
		$cmd->bindParam(':end', $end, PDO::PARAM_STR, 5);
		$cmd->bindParam(':participants', $participants, PDO::PARAM_STR, 25);
		$cmd->bindParam(':category', $category, PDO::PARAM_STR, 25);
		$cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

		// Execute the UPDATE
		$cmd->execute();

		// Disconnect
		$db = null;

		// Show msg to User
		echo "Tsk tsk tsk";
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}

include('shared/footer.php');

?>