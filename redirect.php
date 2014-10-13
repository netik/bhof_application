<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
require ("includes/session_incl.php");

//lines 7-14 are a local function that appears on this page only.
function showcompleted ($formname)
	{
	if ($formname)
		{
		return "<font color=\"006600\">complete</font>"; 
		}
	return "<font color=\"ff00000\">incomplete</font>"; 
	}

// *********This section pulls "completed" from the completed table to show the "completed" vs. not status in the big table
// *********It treats it as an array, then pulls individual values from the array in the big table.
$sql = "SELECT * FROM completed WHERE user_id = $_SESSION[user_id] AND completed_year = $pageant_year";
$r = mysql_query($sql, $db); // Perform the SQL command

while ($m = mysql_fetch_array($r))
	{
	$completed[ $m[completed_form_name] ] = "Completed!";  
	}



?>

<html>
<head>
<title>You do not have access</title>
<meta http-equiv="refresh" content="6; url=../index.php">
<link rel="stylesheet" type="text/css" href="/includes/styles.css">
</head>

<body>
<div align="right"><?php echo account_nav_links(); ?></div>
<h1 align="center"><strong><?php echo $bh_name_abbrev;?> &nbsp;<?php echo $pageant_year;?> 
  Application</strong></h1>
<h2 align="center"><strong>Nice try! You don't have access to this directory.</strong></h2>
<p align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">If 
  you are not redirected to the home page in a few seconds, click <a href="/index.php">here</a></font> 
  </strong></p>
</body>
</html>
