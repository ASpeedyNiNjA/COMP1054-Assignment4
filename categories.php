<?php 
include('shared/auth.php');
$title = 'Add Category';
include('shared/header.php'); ?>

<h2>Add a New Category</h2>
<form method="post" action="insert-categories.php">
    <fieldset>
        <label for="name">Add Category: </label>
        <input name="add-category" id="name" required />
    <button>Submit</button>
</form>
</body>
</html>