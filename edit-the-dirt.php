<?php
include('shared/auth.php');
$title = 'Edit The Dirt';
include('shared/header.php');

// Get the crownID from the Uniform Resource Locator parameter using $_GET
$crownID = $_GET['activityID'];

// Initialize Variables
$date = null;
$start = null;
$end = null;
$participants = null;
$category = null;

// If crownID is numeric, fetch show data from DB
if (is_numeric($crownID)) {
	
	// Connect
	try {
		include('shared/db.php');

		// Run query & populate show properties for display
		$sql = "SELECT * FROM crownLog3 WHERE activityID = :activityID";
		$cmd = $db->prepare($sql);
		$cmd->bindParam(':activityID', $crownID, PDO::PARAM_INT);
		$cmd->execute();
		$crown = $cmd->fetch();

		$date = $crown['crownDate'];
		$start = $crown['crownStart'];
		$end = $crown['crownEnd'];
		$participants = $crown['crownParticipants'];
		$category = $crown['crownCategory'];
		$photo = $crown['photo'];
	}
	catch (Exception $err) {
		header('location:error.php');
		exit();
	}
}

?>
<!-- I don't think this makes sense for this module, but for the purposes of this assignment... -->
	
	<h2>Edit The Dirt</h2>
	<form method="post" action="update-crown.php" enctype="multipart/form-data">
	<fieldset>
			<legend>The Dirt</legend>

				<!-- Main Form -->
				<ul>
					<li>
						<!-- Date Widget -->
							<label for="date">Date:</label>
							<input type="date" id="date" name="crown-date" >
					</li>
					<li>
						<!-- Start Widget -->
						<label for="start">Start:</label>
						<input type="time" id="start" name="crown-start" >
					</li>
					<li>
						<!-- End Widget -->
						<label for="end">End:</label>
						<input type="time" id="end" name="crown-end" >
					</li>
					<li>
						<!-- Participant Widget -->
						<label for="participants">Participants:</label>
						<select id="participants" name="crown-participants" >
						<?php

							// connect
							try {
							include('shared/db.php');

							// set up & run query, store data results
							$sql = "SELECT * FROM participants";
							$cmd = $db->prepare($sql);
							$cmd->execute();
							$participants = $cmd->fetchAll();

							// loop through list of date data entries, add
							foreach ($participants as $participant) {
								echo '<option>' . $participant['name'] . '</option>';
							}

							// disconnect
							$db = null;
						} catch (Exception $err) {
							header('location:error.php');
							exit();
						}

						?>
						</select>
					</li>
					<!-- Category Widget -->
					<li>
						<label for="category">Category:</label>
						<select id="category" name="crown-category">
							<?php

								// connect
								include('shared/db.php');

								// set up & run query, store data results
								$sql = "SELECT * FROM categories";
								$cmd = $db->prepare($sql);
								$cmd->execute();
								$categories = $cmd->fetchAll();

								// loop through list of date data entries, add
								foreach ($categories as $category) {
									echo '<option>' . $category['name'] . '</option>';
								}

								// disconnect
								$db = null;

							?>
						</select>
					</li>
					<li>
						<label for="photo">Photo:</label>
						<input type="file" id="photo" name="photo" accept="image/*" />
						<input type="hidden" id="currentPhoto" name="currentPhoto" value="<?php echo $photo; ?>">
						<?php
                		if ($photo != null) {
                    		echo '<img src="images/uploads/' . $photo . '" alt="Show Photo" />';
                		}
            		?>
					</li>
					<input type="hidden" name="activityID" id="activityID" value="<?php echo $crownID; ?>" />

					<li>
						<!-- Button Widget -->
						<button type="submit">Crown</button>
					</li>

		</fieldset>
	</form>


<?php include('shared/footer.php'); ?>