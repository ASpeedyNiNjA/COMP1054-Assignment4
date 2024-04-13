<?php
session_start();
session_destroy();
header('location:the-deed.php');
?>