<!-- PHP Global Header -->
<?php include('shared/auth.php'); ?>
<?php $title = 'Login' ?>
<?php include('shared/header.php');?>

	<!-- PHP Form Variable Initialization -->
	<h2>A Dirty Upload</h2>

	<?php
		$date = ($_POST['crown-date']);
		$start = ($_POST['crown-start']);
		$end = ($_POST['crown-end']);
		$participants = ($_POST['crown-participants']);
		$category = ($_POST['crown-category']);
		$ok = true;

		// Process photo if any
		if ($_FILES['photo']['size'] > 0) {
		$photoName = $_FILES['photo']['name'];
		$finalName = session_id() . '-' . $photoName;
		echo $photoName;

		echo '<br>';
		
		// Temporary Location of File In Server
		$tmp_name = $_FILES['photo']['tmp_name'];
		echo $tmp_name;

		echo '<br>';
		
		// Safer version of processing file type
		$type = mime_content_type($tmp_name);
		echo $type;

		//Save file to images/uploads with if/else logic to specify photos only
		if ($type != 'image/jpeg' && $type != 'image/png' ) {
			echo 'Photo just have a .jpg or .png extension';
			exit();
		} else {
		move_uploaded_file($tmp_name, 'images/uploads/' . $finalName);
		}
	}
	?>

	<!-- PHP Input Validation + -->
	<?php
	
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

		// Connect to Database
	if ($ok == true) { 
		try {
		include('shared/db.php'); 

		// Set-up SQL INSERT Command
		$sql = "INSERT INTO crownLog3 (crownDate, crownStart, crownEnd, crownParticipants, crownCategory, photo) VALUES (:date, :start, :end, :participants, :category, :photo)";

		// Start process of prepare the SQL commands for the Database
		$cmd = $db->prepare($sql);

		// Continue process by binding parameters for prepared MySQL Form Insert
		$cmd->bindParam(':date', $date, PDO::PARAM_STR, 10);
		$cmd->bindParam(':start', $start, PDO::PARAM_STR, 5);
		$cmd->bindParam(':end', $end, PDO::PARAM_STR, 5);
		$cmd->bindParam(':participants', $participants, PDO::PARAM_STR, 25);
		$cmd->bindParam(':category', $category, PDO::PARAM_STR, 25);
		$cmd->bindParam(':photo', $finalName, PDO::PARAM_STR, 100);

		// Execute the $sql command into the $db database with parameters properly binded for security purposes
		$cmd->execute();

		// Disconnect from Database 
		$db = null;
		echo 'Something rude happened here.';
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}
	
	?>

<!-- PHP Global Footer -->
<br> <!-- This line break needs to be here for the time being. Otherwise footer is on the same line as disconnect message. Until CSS... -->
<?php include('shared/footer.php');?>