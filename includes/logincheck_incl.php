<?php
//next four lines check to see if user is logged in. If not, takes them to login page.
if (@SESSION['loggedin'] !="1")
{
	header:("Location: ../index.php");
	exit();
}
?>