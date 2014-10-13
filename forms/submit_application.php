<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
require ("../includes/session_incl.php");
submitted_redirect();

function getrecord()
	{ // this function will select a record if it exists, and if it does not exist, it will create a new one. 
	global $db; 
	global $tabledata;
	global $table_id; 
	global $pageant_year; 
	$sql="SELECT * FROM application_submitted_status WHERE user_id = $_SESSION[user_id] AND submitted_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[submitted_id];
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO application_submitted_status (user_id, submitted_status, submitted_year, decision_is_visible) VALUES ($_SESSION[user_id], 'not_submitted', '$pageant_year', '0')"; 
		// echo $sql;   for testing - uncomment to debug
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		}
	}

getrecord();
//next seven lines are a local function that appears on this page only.
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

// ***************************************************
// ***************************************************
// Logic to set the variable name for the form button. 
$sql = "SELECT application_solo_vs_group_pref AS type FROM user_account WHERE user_id = $_SESSION[user_id]";  //'type' eliminates need to name var everywhere on pg
$r = mysql_query($sql, $db);
$app_preference = mysql_fetch_array($r);
//    print_r($app_preference); echo "howdy";   uncomment to debug
$buttonshow=1;
if (!($completed[main_contact_person_info]))
	{$buttonshow=0;}  //  for everyone: if Main Contact Person Info not complete
if (!($completed[payment]))
	{$buttonshow=0;}  //for everyone: if Payment not complete
if (!($completed[legal_agreement]))
	{$buttonshow=0;}  //for everyone: if Legal Agreement not complete
// if (!($completed[photos]))    //This line and the next have been commented out for 2012 because photos are no longer required.
//	{$buttonshow=0;}  //for everyone: if Photos not complete

if ($app_preference[type] !="group")   // meaning, they are either solo or both, so this checks to see if any of the solo forms are incomplete
	{
	if (!($completed[solo_act_info]) )
		{$buttonshow=0;}
	if (!($completed[solo_act_essays]) )
		{$buttonshow=0;}
	if (!($completed[solo_act_tech]) )
		{$buttonshow=0;}
	}
if ($app_preference[type] !="solo")  // meaning, they are either group or both, so this checks to see if any of the group forms are incomplete 
	{
	if (!($completed[group_act_info]))
		{$buttonshow=0;}
	if (!($completed[group_act_essays]))
		{$buttonshow=0;}
	if (!($completed[group_act_tech])) 
		{$buttonshow=0;}
	}
if ($buttonshow==1)
	{$buttoncode='<input name="submit" type="submit" id="submit" onClick="submit" value="Submit my application!">';
	}
else  //buttonshow = 0
	{
	$buttoncode="<font size=\"+1\" color=\"red\"><strong>(You still have incomplete parts! The button will appear here once all the required parts are complete.)</strong></font>";
	}
// **************************************************
// **************************************************

if ($_POST[submit])
	{
	$message = "Your application for the BHoF system has been submitted.";
	 mail($_POST['form_user_email'],"Your BHoF application has been submitted",   
     $message, "From:BHOF account system <2014@bhofapplication.com>");
	 //need to insert sql that updates the database
	$sql="UPDATE application_submitted_status SET 
	submitted_status = 'submitted',
	submitted_timestamp = NOW()
	WHERE user_id = $_SESSION[user_id] AND submitted_year='$pageant_year'"; 
	$r = mysql_query($sql, $db); // Perform the SQL command
	$_SESSION['submitted_status'] = 'submitted';  //pronounces them "submitted", other pages check for this and display content accordingly	
	//Next two lines take them to the new status screen now that login is successful
	header ("location: /application_submitted.php");
	die ();
	}

?>

<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application System - Application submitted</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link
function decision(message, url){
if(confirm(message)) location.href = url;
}

</SCRIPT>
</head>

<body>
<div align="right" class="navlinks"> <?php echo account_nav_links(); ?></div>
  <h1 align="center"><?php echo $bh_name_abbrev;?><strong> &nbsp;<?php echo $pageant_year;?> 
    Application</strong></h1>
  
<h2 align="center"><strong>Submit application</strong></h2>
<h3><strong>Are you ready to submit your application? Follow these three steps:</strong></h3>
<ol>
  <li> 
    <h3>You are about to submit an application for: 
	<?php 
		if ($app_preference[type]=="solo") echo "<span class=\"user_account_error_msg\">SOLO category</span>";
		if ($app_preference[type]=="group") echo "<span class=\"user_account_error_msg\">GROUP category</span>";
	?>
	
	<br>
      Double-check that all the required forms show as &quot;complete&quot; below. 
      If you need to update any, return to the <a href="../main.php">main dashboard</a> 
      and use the links there.<br>
      <br>
      For all applicants:<br>
      <br>
      <table border="1" bordercolor="" style="background-color:" width="523" cellpadding="3" cellspacing="3">
        <tr align="center" bgcolor="#FFCCFF"> 
          <td width="151"><font color="781428"><strong>Main person's contact info</strong></font></td>
          <td width="150"><font color="781428"><strong>Payment via PayPal</strong></font></td>
          <td width="184"><font color="781428"><strong>Legal agreement</strong></font><font color="781428">&nbsp;</font></td>
        </tr>
        <tr bgcolor="#FFFFFF"> 
          <td align="center"><?php echo showcompleted($completed[main_contact_person_info]);?></td>
          <td align="center"><?php echo showcompleted($completed[payment]);?></td>
          <td align="center"><?php echo showcompleted($completed[legal_agreement]);?></td>
        </tr>
      </table>
      <br>
      If you are submitting a solo act:</h3>
    <table border="1" bordercolor="" style="background-color:" width="689" cellpadding="3" cellspacing="3">
      <tr align="center" bgcolor="#FFCCFF"> 
        <td width="219"><font color="781428"><strong>Solo - basic info</strong></font></td>
        <td width="211"><font color="781428"><strong>Solo - short answers</strong></font></td>
        <td width="221"><font color="781428"><strong>Solo - tech/staging info</strong></font></td>
      </tr>
      <tr align="center" bgcolor="#FFFFFF"> 
        <td><?php echo showcompleted($completed[solo_act_info]);?></td>
        <td><?php echo showcompleted($completed[solo_act_essays]);?></td>
        <td><?php echo showcompleted($completed[solo_act_tech]);?></td>
      </tr>
    </table>
    <h3> <br>
      If you are submitting a group act:</h3>
    <table border="1" bordercolor="" style="background-color:" width="689" cellpadding="3" cellspacing="3">
      <tr align="center" bgcolor="#FFCCFF"> 
        <td width="219"><font color="781428"><strong>Group - basic info</strong></font></td>
        <td width="211"><font color="781428"><strong>Group - short answers</strong></font></td>
        <td width="221"><font color="781428"><strong>Group - tech/staging info</strong></font></td>
      </tr>
      <tr align="center" bgcolor="#FFFFFF"> 
        <td><?php echo showcompleted($completed[group_act_info]);?></td>
        <td><?php echo showcompleted($completed[group_act_essays]);?></td>
        <td><?php echo showcompleted($completed[group_act_tech]);?></td>
      </tr>
    </table>
    <h3>&nbsp; </h3>
  </li>
  <li> 
    <h3><strong>(Optional) click <a href="../print.php" target="_blank">here</a> 
      for a printable copy of your application for your records. Once your application 
      is submitted, you will still be able to log in to print a copy, so you don't 
      have to do this right now.</strong></h3>
  </li>
  <li> 
    <h3><strong>Click the button below. Click it only once, and DO NOT CLICK IT 
      until you are ready to submit your application! Clicking the button will 
      officially submit your application and you can no longer make changes to 
      it. Your application status will update on the main dashboard.</strong></h3>
  </li>
</ol>
<form method="POST" action="" id="submitform" name="submitform">
  <?php echo $buttoncode; ?> 
  <input name="hiddenField" type="hidden" value="submit">
</form>
<p>&nbsp;</p>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>