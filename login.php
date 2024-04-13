<!-- PHP Global Header -->
<?php $title = 'Login' ?>
<?php include('shared/header.php');?>

	<h2>Login</h2>

	<?php
		// I would like to add additional messaging to seperate Invalid Login from Invalid Password
    	if (!empty($_GET['invalid'])) {
      	echo '<h4>INVALID LOGIN</h4>';
   	}
  ?>

	<h4>There's no turning back</h4>

	<form method="post" action="validate.php">

<fieldset>
  <label for="username">Username:</label>
  <input name="username" id="username" required type="email" placeholder="email@email.com" />
</fieldset>

<fieldset>
  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required />
</fieldset>

<button class="offset-button">Login</button>

</form>

<!-- PHP Global Footer -->
<?php include('shared/footer.php');?>