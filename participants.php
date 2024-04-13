<?php 
include('shared/auth.php');
$title = 'Add Participants';
include('shared/header.php'); ?>

<h2>Add a New Participant</h2>
<form method="post" action="insert-participants.php">
    <fieldset>
        <label for="name">Add Participants Category: </label>
        <input name="participant-category" id="name" required />
    <button>Submit</button>
</form>
</body>
</html>