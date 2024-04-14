<!DOCTYPE html>
<html lang="en-CA">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Chris Trombly ~ 100051457">
	<meta name="description" content="Assignment 2 ~ COMP1006">
	<meta name="robots" content="noindex, nofollow">
	<title> <?= $title; ?></title>
	<link rel="icon" href="images/skull-straw.png" type="image/x-icon" />
	<link rel="stylesheet" href="./styles/style.css">
	<script src="./js/scripts.js" defer></script>
</head>
<body>
	<header>
		<img src="images/heart.png" alt="A poorly drawn pixel heart" />
		<h1>Ministry Of Love</h1>
		<img src="images/user-image.png" alt="A 100x100 circle user profile image placeholder" /> 
	</header>
	<nav>
			<a href="index.php">Home</a>
			<?php
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				if (!empty($_SESSION['username'])) {
					echo '<a href="crown.php">Crown</a>';
				}
			?>
			<a href="the-deed.php">The Deed</a>
			<?php
				if (!empty($_SESSION['username'])) {
					echo '
					<a href="participants.php">Participants</a>
					<a href="categories.php">Categories</a>
					<a href="logout.php">Logout</a>
					<a href="#">' . $_SESSION['username'] .  '</a>';

				} else {
					echo '
				<a href="register.php">Register</a>
				<a href="login.php">Login</a>';
				}
			?>
	</nav>

