<?php
//this starts the session

if ($_SESSION[loggedin] !=1) 
	{
	echo "<h2><font color='red'>You need to log in before you can access that page.</font></h2>";
	include ("login_snippet.php");
	die();
	}
	
?>