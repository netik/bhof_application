<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();

	//this newuser page does NOT call session_incl because it should NOT check for login state. Thus, session_start is hardcoded in the next line.
session_start();

	//error-checking
if ($_POST[Save]){
	$insert_user=1;
	//next four lines check for matching passwords. If mismatch, sets insert variable to 0. 'strtolower' makes it disregard case
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
	//checks to see if email is already in the db
	$clean_user_email=cleanforsql(strtolower($_POST[form_user_email]));	
	$sql="SELECT user_email FROM user_account WHERE user_email='$clean_user_email'";
	$r = mysql_query($sql, $db);
	//the variable m contains everything for that record. Is used to access and view.
	//everything inside the brackets matches my table names 1 to 1
	$m = mysql_fetch_array($r); 
	if ($m)  //means "if it finds a record that matches email"
		{
		$insert_user=0;
		$error_email_msg="Your email address is already in the system.";	 
		}
	}
	
if ($insert_user){    //opens "insert user" if statement
	//create clean versions of form variables for sql insertion
	$clean_user_email=cleanforsql(strtolower($_POST[form_user_email]));
	$clean_user_pwd=getpasswordhash(cleanforsql($_POST[form_user_pwd]));
	//need to declare this for each variable, but the join date and year aren't variables so they don't need it.
	// uncomment to debug  echo "hello".$_POST[form_solo_category];
	/*in below giant SQL statement, all items must have a comma at the end EXCEPT the last one in the list */
	$sql="INSERT INTO user_account (
	user_email,
	user_pwd,
	user_join_date,
	user_last_login,
	user_verified_status,
	application_solo_vs_group_pref
	)
	VALUES (
	'$clean_user_email',
	'$clean_user_pwd',
	NOW(),
	NOW(),
	'0',
	'solo'
	)";

	 if(!$r = mysql_query($sql, $db))
				{die("ERROR: Could not insert new record.");} 

	//******************************
	//*******************************
	//This section copied from the forgot pwd part. Creates the hash and emails the user.
	$sql="SELECT * FROM user_account WHERE user_email='$clean_user_email'";  //first it needs to pull the user_id to create the hash.
	$r = mysql_query($sql, $db);
	//the variable m contains everything for that record. Is used to access and view.
	//everything inside the brackets matches my table names 1 to 1
	$m = mysql_fetch_array($r); 
	// $must_confirm_account_msg="An email has been sent to you with a link to activate your account.";	 
	$userhash = getuserhash($m[user_id],$m[user_pwd]);
	$url = "http://" . $baseurl . "/account/account_confirmed.php?i=" . $m[user_id] . "&h=" . $userhash;
		
	//next lines email the user
	$message = "Thank you for using the BHoF Application system! \n\n";	
	$message = "Please click this link to verify your account: \n\n";
	$message .= $url . "\n\n";
	$message .= "Once you have clicked that link and seen the confirmation page, you can delete this message. Be sure to add bhofapplication.com as a trusted sender! \n\n";
	$message .= "Sincerely, \n\n";
	$message .= "The BHoF Team";
		 
	 mail($_POST['form_user_email'],"Please confirm your BHoF Application account",  
	 $message, "From:BHoF application system <2014@bhofapplication.com>");
		
	echo $message; 
	//die ();
	//Next two lines take them to the "Account created" screen now that login is successful
	
	header ("location: account_created.php");
	die ();
	}   //closes "insert user" if statement

?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?>  <?php echo $pageant_year;?> - Create User Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<h1 align="center"><strong><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> 
  Application</strong></h1>
<h2 align="center"><strong>Create new account</strong></h2>
<blockquote>
  <p><font size="+1">Create your account here! </font></p>
  <p><font size="+1">If you created an account in 2011, 2012, or 2013, you already have an account in the system. Just go back to the <a href="../index.php">login page</a> 
    and log in using that email address and your password.</font></p>
  <p><font size="+1">Upon submitting this form, we will email you a link to verify 
    your account, so be sure to use an email address you can check. </font><font size="+1">The 
      verification email will get sent right away. If you don't immediately see it, 
      check your spam folder-- and add &quot;bhofapplication.com&quot; as a trusted 
      sender. Once you've clicked the verification link in your email, you can get 
      started!</font></p>
</blockquote>
<hr>
<div align="center">
<form action="" method="post" name="form1" class="boxhighlight">
  <blockquote>
    <blockquote>
      <p align="left"><span class="rulepageheaders">Your email address:</span>
        <input name="form_user_email" type="text" id="form_user_email" size=60 value="<?php echo $_POST[form_user_email]; ?>">
        <img src="../assets/help_icon_2013.png" width="18" height="18" title="Please use an email address that you have regular access to, as this will be the address we use to communicate with you. For your security, you'll need to click an activation link in an email that we'll send you once you submit this form."> 
      <span class="user_account_error_msg"><?php echo $error_email_msg; ?></span></p>
      <p align="left"><span class="rulepageheaders">Retype your email address:</span>
        <input name="form_user_email_retype" type="text" id="form_user_email_retype" size=60 value="<?php echo $_POST[form_user_email_retype]; ?>">
        <br>
      </p>
      <p align="left"><span class="rulepageheaders">Choose a password* (up to 16 characters):</span>
        <input name="form_user_pwd" type="password" id="form_user_pwd" size=20 value="<?php echo $_POST[form_user_pwd]; ?>">
      <span class="user_account_error_msg"><?php echo $error_pwd_msg; ?></span></p>
      <p align="left"><span class="rulepageheaders">Retype your password:</span>
        <input name="form_pwd_retype" type="password" id="form_pwd_retype" size=20 value="<?php echo $_POST[form_pwd_retype]; ?>">
      </p>
      <p align="left" class="navlinks"><em>*note: for your protection, passwords are encrypted in our database. 
        We can't see them! This application has a password-reset tool if you need 
      it. </em></p>
      <p align="left"> 
        <input name="Save" type="submit" id="Save" value="Save">
      </p>
    </blockquote>
</blockquote>
</form>
</div>
<hr>
<p align="center"><font size="-1"><a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry </a></font>- <a href="../help/privacy.php">privacy</a></p>
</body>
</html>
