<!-- PHP Global Header -->
<?php $title = 'The Deed' ?>
<?php include('shared/header.php');?>

	<h2>The Deed</h2> <!-- My Deed??? -->

	<?php

	try {
		// Connect to database
		include('shared/db.php');

		// Set up query to fetch crown log data
		$sql = "SELECT * FROM crownLog3";
		$cmd = $db->prepare($sql);

		// Run query & store results in var called $deeds
		$cmd->execute();
		$deeds = $cmd->fetchAll();
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}

	// Start the table
	echo '<h2 id="vertical">Crown Log</h2>';
	echo '<table><thead> <th>activityID</th> <th>Date</th> <th>Start</th> <th>End</th> <th>Participants</th> <th>Category</th>';
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (!empty($_SESSION['username'])) {
		echo '<th>Actions</th>';
	}
	echo '<th>Photo</th>
	</thead>';

	// Loop through the dataresult from the query to create a dynamic HTML5 Table
	foreach ($deeds as $deed) {
		echo '<tr>
		<td>' . $deed['activityID'] . '</td>
		<td>' . $deed['crownDate'] . '</td>
		<td>' . $deed['crownStart'] . '</td>
		<td>' . $deed['crownEnd'] . '</td>
		<td>' . $deed['crownParticipants'] . '</td>
		<td>' . $deed['crownCategory'] . '</td>';
		if (!empty($_SESSION['username'])) {
		echo '<td>
			<a href="edit-the-dirt.php?activityID=' . $deed['activityID'] . '">Edit</a>
			<a href="delete-crown.php?activityID=' . $deed['activityID'] . '" onclick="return confirmDelete();">
				Delete
			</a>
		</td>';
		}
		echo '<td>';
		if ($deed['photo'] != null) {
			echo '<img src="images/uploads/' . $deed['photo'] . '" class="thumbnail" />';
		}
		echo '</td>';
		echo '</tr>';
		
	}

	// End table
	echo '</table>';

	// Disconnect
	$db = null;
	?>

<a href="crown.php">Add New Record</a>

<!-- PHP Global Footer -->
<?php include('shared/footer.php');?>