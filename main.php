<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
require ("includes/session_incl.php");

//On this page, function getrecord first needs to check for/create a row in the "app status" table. 
//It needs to do this here because it displays content on this page based on user prefs.


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
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <?php $current_ts = time(); //checks to see if app deadline has passed. If it is, then it redirects to results.php. If deadline is not passed, the page continues along on its merry way and finishes executing.
	if($current_ts > $system_deadline)  //system_deadline is a global variable defined in db_incl.php 
		{ ?>	
         <meta HTTP-EQUIV="REFRESH" content="0; url=results.php"> 
		 <?php 
		}
		?>
<!-- this next line redirects to new page once the submission deadline has passed. Also where they view their decision. Comment next line out to make this 'main' page live again, e.g., next year. Uncomment the next line when you need to make the results page visible.-->
<!-- <meta HTTP-EQUIV="REFRESH" content="0; url=results.php"> -->
<link rel="stylesheet" type="text/css" href="includes/styles.css"> 
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link. Commented out for 2012.
<!-- function decision(message, url){
<!-- if(confirm(message)) location.href = url;
<!-- }
// --->
</SCRIPT>
</head>

<body>
<div align="right" class="navlinks"><?php echo account_nav_links(); ?></div>
<h1 align="center" class="rulepageheaders"><strong>Welcome to the <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> 
  application system dashboard!</strong></h1>
<h3 align="center"><span class="rulepageheaders">This year's application deadline is <?php echo $deadline_with_time;?>. Your application status is:</span>
<?php if ($_SESSION[submitted_status])
  		echo "<span class=\"user_account_error_msg\">submitted and under review</span>";
		else echo "<span class=\"user_account_error_msg\">not submitted yet</span>"; 
		?>
  <p></p>
  <!-- next several lines display content depending on user's status and prefs. -->
  <?php 
  print_r($tabledata);
  echo $tabledata[application_solo_vs_group_pref];
  
 	$submitted_status=$_SESSION[submitted_status];  
	if ($submitted_status == 'submitted')
		{
		include ("dashboard_tables/application_under_review.php");
		}
	else  // Else we''re not submitted yet.
		{
		include ("dashboard_tables/setprefs.php");
		//  include ("dashboard_tables/everyone_table.php");  commented out nov8 bc I think display is coveredin next few lines
				if ($tabledata[application_solo_vs_group_pref] == 'solo')
					{
					include ("dashboard_tables/solo_table.php");
					}
	  			elseif ($tabledata[application_solo_vs_group_pref] == 'group')
					{
					include ("dashboard_tables/group_table.php");
					}
		}
		
		
		
	?></p>
  </h3>
<hr>
<p align="center"><font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="../help/instructions.php">Instructions for completing the application</a> 
  - <a href="../help/judging_criteria.php">Judging criteria</a> - <a href="../help/rules.php">Rules 
  for entry</a></font> - <font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>