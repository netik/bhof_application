<?php
include_once ("includes/db_incl.php"); //change other pages to include_once too
$db=dbconnect ();
session_start(); 

	//error-checking
if ($_POST[login]){
	//checks to see if email is already in the db
	$clean_user_email=cleanforsql(strtolower($_POST[form_user_email]));	
	$sql="SELECT * FROM user_account WHERE user_email='$clean_user_email'";
	$r = mysql_query($sql, $db);
	//the variable m contains everything for that record. Is used to access and view.
	//everything inside the brackets matches my table names 1 to 1
	//r executes db commands, m gets results out of r
	$m = mysql_fetch_array($r); 
	if ($m)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$login_user=1; 
		if ($m[user_pwd] != getpasswordhash(cleanforsql($_POST[form_user_pwd]))) 
			{
			$login_user=0;
			$error_pwd_msg="Incorrect password. Please try again.";
			}
			
			
		if ($m[user_verified_status] == 0) 
			{
			$login_user=0;
			$error_user_status_msg="Account not verified yet. Before you can log in, you must verify it using the link in the email that was sent to you.";
			}	 
		
		
		if ($login_user ==1)
		 	{   //else email is in the db, password is correct, AND the account is verified. Next lines log them in, set session vars, and redirect to Main
			$_SESSION[loggedin] = 1; 
			//Subsequent internal pages will check to see if this variable = 1. If not, it will redirect them to the login page.
			//Next two lines set the USER ID and user_email session variables
			// $row = mysql_fetch_array($r);
			$_SESSION['user_id'] = $m['user_id'];
			$_SESSION['user_email'] = $m['user_email'];
			
			$sql="UPDATE user_account SET 
			user_last_login = NOW()
			WHERE user_id = $_SESSION[user_id]";
			
			$r = mysql_query($sql, $db); // Perform the SQL command
			$sql="SELECT * FROM application_submitted_status WHERE user_id = $_SESSION[user_id] AND submitted_year = $pageant_year AND submitted_status='submitted'";
			$r = mysql_query($sql, $db); // Perform the SQL command
			if ($m = mysql_fetch_array($r))
				{$_SESSION['submitted_status'] = 'submitted';  //pronounces them "submitted", other pages check for this and display content accordingly
				}			
			
			//Next two lines take them to the main screen now that login is successful
			header ("location: main.php");
				die ();	
			}
		}
	else {  //else no matching email was found in the db
			$login_user=0;
			$error_email_msg="Your email address is not on record. Please try another or create a new account.";
		}
	}

?>

<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="includes/styles.css"> 
</head>

<body>
<?php $current_ts = time(); //This php call checks to see if app is not open yet, i.e., before the system_launchdate defined in db_incl. If it before then, then it redirects to comingsoon.php. (Add underscore-- coming_soon.php-- if you want the version that includes links to the rules, privacy, etc.) If it's past the launch date, the page continues along on its merry way and finishes executing. 
	if($current_ts < $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ 	
         include ("includes/coming_soon.php"); 
		}
	else 
		{
		include ("includes/login_snippet.php");
		} ?>

<p></p><p></p>
<hr>
<p align="center"><font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="help/instructions.php">Instructions 
  for completing the application</a> - <a href="help/judging_criteria.php">Judging 
  criteria</a> - <a href="help/rules.php">Rules for entry</a></font><br>
  <span class="navlinks"><a href="http://www.burlesquehall.com" target="_blank"><?php echo $bh_name_abbrev;?> website</a> - <a href="http://www.bhofweekend.com" target="_blank"><?php echo $bh_name_abbrev;?> Weekend website</a> - <a href="http://www.burlesquehall.com/support/become-a-member/" target="_blank">become a member</a></span></p>
</body>
</html>
 
