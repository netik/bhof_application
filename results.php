<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
require ("includes/session_incl.php");

function getrecord()
	{ // this function selects the user's ''decision visible'' status, and what that decision is. 
	global $db; 
	global $tabledata;
	global $table_id; 
	global $pageant_year; 
	$sql="SELECT * FROM application_submitted_status WHERE user_id = $_SESSION[user_id] AND submitted_year = '$pageant_year';";
	$r = mysql_query($sql, $db) or die(mysql_error()); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	}
?>

<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="includes/styles.css"> 
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>
</head>

<body>
<div align="right"><?php echo account_nav_links(); ?></div>
<h1 align="center"><strong>Welcome to the <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> 
  application system!</strong></h1>
<h3 align="center">The <strong><?php echo $pageant_year;?></strong> application 
  deadline has passed. Here is your decision for:</h3>
<p align="center">

<?php 
	$sql = "SELECT * FROM solo_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
	$sql = "SELECT * FROM group_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$h = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
	echo $m[solo_performer_name];
	echo $h[group_performer_name];
?>
</p>
  <p></p>
  <!-- next several lines display content depending on user's status and prefs. -->
  <?php 

  getrecord();
  	
	if ($tabledata[submitted_status] == 'not_submitted')  //if they didn't submit an app
		{
		include ("decision/notsubmitted.php");
		die;
		}
	elseif (($tabledata[submitted_status] == 'submitted') && ($tabledata[decision_is_visible] == 0))  //elseif app submitted but decision not visible
		{
		include ("dashboard_tables/application_under_review.php");
		die;
		} 	
	else  //else decision is visible; show content based on decision status.
		{
		include ('decision/'.$tabledata[verdict].'.php');
		}
	
	?>
	</p>
<hr>
<p align="center"><font size="-1"><a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>