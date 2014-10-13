<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();

// Check to see is user ID is valid
if (!$_GET[i])
	{
	die("No user id. Email link was invalid."); 	
	}

$user_id = cleanforsql($_GET[i]); 

$sql = "SELECT * from user_account WHERE user_id = $user_id"; 
if(!$r = mysql_query($sql, $db)) die("Error updating password.");  //not sure if this is needed but taking it out broke next line bc of missing $r
if(!$m = mysql_fetch_array($r)) die ("Error fetching userdata from user id."); 

$user_hash = getuserhash($user_id, $m[user_pwd]);

if ($_GET[h] != $user_hash) die ("Error: the link was incomplete or missing characters. This may have happened if you copied/pasted the link rather than clicking it."); //userhash did not match user ID.

$sql="UPDATE user_account SET 
	user_verified_status = '1'
	WHERE user_id = $user_id";
	
	$r = mysql_query($sql, $db); // Perform the SQL command	
	


?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Account confirmed</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css"> 	
</head>

<body>
<div align="right"></div>
<h1 align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?> 
  <?php echo $pageant_year;?> Application</strong></font></h1>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Account 
  verified</font></strong></h2>
<?php if ($message) echo "<p class=\"user_account_error_msg\" align=\"center\">$message</p>"; ?>
<p align="center"><strong><font size="+1">Your account has been verified! </font></strong></p>
<p align="center"><strong>Please go to the <a href="../index.php">login page</a> to sign in and get started.</strong></p>
<hr>
</body>
</html>
