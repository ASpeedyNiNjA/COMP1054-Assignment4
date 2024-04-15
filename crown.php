<!-- PHP Global Header -->
<?php include('shared/auth.php'); ?>
<?php $title = 'Crown'; ?>
<?php include('shared/header.php');?>

	<!-- Crown Log Module -->
	<h2>Fucking Forms</h2> <!-- This has a double meaning -->
	<form method="post" action="dirty-upload.php" enctype="multipart/form-data">
		<fieldset>
			<legend>The Crown </legend>

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
						try {

							// connect
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
						}
						catch (Exception $err) {
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
							try {

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
							}
							catch (Exception $err) {
								header('location:error.php');
								exit();
							}

							?>
						</select>
					</li>

				<li>
            	<label for="photo">Photo:</label>
            	<input type="file" id="photo" name="photo" accept="image/*">
				</li>
					
					<li>
						<!-- Button Widget -->
						<button type="submit">Submit</button>
					</li>

		</fieldset>
	</form>

<!-- PHP Global Footer -->
<?php include('shared/footer.php');?>