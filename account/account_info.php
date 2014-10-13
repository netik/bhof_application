<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
include ("../includes/session_incl.php");

	//error-checking
if ($_POST[Save])
	{
	$insert_user=1;
	$clean_form_old_pwd=getpasswordhash(cleanforsql($_POST[form_old_pwd]));
	
	// Do the new email address match?
	if (strtolower($_POST[form_user_email]) !=strtolower($_POST[form_user_email_retype]))
		{
		$insert_user=0;
		$error_email_msg="Your email addresses did not match. Please try again.";
		}
	//next four lines check for pwd match, and then if there's a mismatch it clears out the field.
	if ($_POST[form_user_pwd] !=$_POST[form_pwd_retype])
		{
		$insert_user=0;
		$error_pwd_msg="Your passwords did not match. Please try again.";
		$_POST[form_user_pwd]="";
		$_POST[form_pwd_retype]="";
		}
	
	if ( ($_POST[form_user_email]== "" ) && ($_POST[form_user_pwd] == "") )
		{ // User entered neither. We don't render an error, we just refresh the page.
		$insert_user=0; 
		}
	
	//now checks to see if Old Password matches
	$sql="SELECT * FROM user_account WHERE user_id=$_SESSION[user_id]";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); 
	if (!$m)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		echo "ASSERT: coulnd not find a record for user $_SESSION[user_id]"; 
		die();
		}
	// Check the db's password against their "old" password they entered
	if ($m[user_pwd] != getpasswordhash(cleanforsql($_POST[form_old_pwd])) ) 
		{
		$insert_user=0;
		$error_old_pwd_msg="Incorrect password. Please try again.";
		}

	
	//--VV-- Check for email already existing in the database
	if ($_POST[form_user_email])
		{
		$sql="SELECT * FROM user_account WHERE user_email= '" . cleanforsql($_POST[form_user_email]). "'";
		$r = mysql_query($sql, $db);
		$m = mysql_fetch_array($r); 
		if($m)
			{
			$insert_user=0;
			$error_email_msg="Your new email address is already in the system. Please try another.";
			}	
		}
	//--AA--
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	// BY THE TIME WE ARE HERE, we have verified everything and have fetched their full record from the db.
		
	if ($insert_user)
		{
		$clean_user_email = cleanforsql(strtolower($_POST[form_user_email]));
		$clean_user_pwd = getpasswordhash(cleanforsql($_POST[form_user_pwd]));
		
		if (($clean_user_email !="") && ($clean_user_pwd != "") )  //updates both, if both are filled in
			{
			// echo "updating both!";  UNCOMMENT TO DEBUG
			$sql="UPDATE user_account SET
			user_email = '$clean_user_email',
			user_pwd = '$clean_user_pwd'
			WHERE user_id = $_SESSION[user_id]";
			}
		elseif ($clean_user_pwd)  //updates pwd only, if pwd field is filled in
			{
			// echo "updating password only!"; UNCOMMENT TO DEBUG
			$sql="UPDATE user_account SET
			user_pwd = '$clean_user_pwd'
			WHERE user_id = $_SESSION[user_id]";
			}
		elseif ($clean_user_email)//updates email if it is the only one filled in
			{
			// echo "updating email only!"; UNCOMMENT TO DEBUG
			$sql="UPDATE user_account SET 
			user_email = '$clean_user_email'
			WHERE user_id = $_SESSION[user_id]";
			}
		else
			{
			echo "ASSERT: Had no valid email or password, but still executed the Insert_user code."; 
			die();
			}

		if(!$r = mysql_query($sql, $db))
			{die("ERROR: Could not insert new record.");} 
		// This message below is displayed on the page upon a successful update.
		$message = "Your account information for the BH system has been updated. Go to the <a href=\"..\main.php\"> main dashboard</a>.";
		$_SESSION['user_email'] = $_POST[form_user_email];
		}

   }
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Edit Account Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT> 	
</head>

<body>
<div align="right" class="navlinks"><?php echo account_nav_links(); ?></div>
<h1 align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?> 
  <?php echo $pageant_year;?> Application</strong></font></h1>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Edit 
  account information</font></strong></h2>
<?php if ($message) echo "<p class=\"user_account_error_msg\" align=\"center\">$message</p>"; ?>
<blockquote>
  <blockquote>
    <blockquote>
      <p><strong><font size="+1">Change your email address or password here.</font></strong></p>
    </blockquote>
  </blockquote>
</blockquote>
<div align="center">
  <form action="" method="post" name="form1" class="boxhighlight">
  <table width="839" border="0" align="center" cellpadding="5" cellspacing="3" bordercolor="" style="background-color:">
    <tr> 
      <td colspan="4"><strong>If you wish to change the EMAIL ADDRESS for your 
        account, enter (and retype) it here. If you are only changing the password, 
        leave these blank.</strong></td>
    </tr>
    <tr> 
      <td width="299" class="rulepageheaders"><strong>Enter the new email address: </strong></td>
      <td width="612" colspan="3"><input name="form_user_email" type="text" id="form_user_email" size=60 value="<?php echo $_POST[form_user_email]; ?>"> 
        <span class="user_account_error_msg"><?php echo $error_email_msg; ?></span></td>
    </tr>
    <tr> 
      <td class="rulepageheaders"><strong>Retype the new email address: </strong></td>
      <td colspan="3"><input name="form_user_email_retype" type="text" id="form_user_email_retype2" size=60 value="<?php echo $_POST[form_user_email_retype]; ?>"> 
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4"><strong>If you wish to change the PASSWORD for your account, 
        enter (and retype) it here. If you are only changing the email address, 
        leave these blank.</strong></td>
    </tr>
    <tr> 
      <td class="rulepageheaders"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Choose 
        a new password (up to 16 characters): </font></strong></td>
      <td colspan="3"><font face="Geneva, Arial, Helvetica, sans-serif"> 
        <input name="form_user_pwd" type="password" id="form_user_pwd2" size=20 value="<?php echo $_POST[form_user_pwd]; ?>">
        <span class="user_account_error_msg"><?php echo $error_pwd_msg; ?></span></font></td>
    </tr>
    <tr> 
      <td class="rulepageheaders"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Retype your new password: 
        </font></strong></td>
      <td colspan="3"><font face="Geneva, Arial, Helvetica, sans-serif"> 
        <input name="form_pwd_retype" type="password" id="form_pwd_retype2" size=20 value="<?php echo $_POST[form_pwd_retype]; ?>">
        </font></td>
    </tr>
  </table>
  <p align="left"><font face="Geneva, Arial, Helvetica, sans-serif"><strong><font size="3">For 
    security, your current password is required to change the email address and/or 
    password:</font></strong> 
    <input name="form_old_pwd" type="password" id="form_old_pwd3" size=20 value="">
    <span class="user_account_error_msg"><?php echo $error_old_pwd_msg; ?></span></font><font face="Geneva, Arial, Helvetica, sans-serif">
    <input name="Save" type="submit" id="Save" value="Save">
    </font></p>
</form>
</div>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
