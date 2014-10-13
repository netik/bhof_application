<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();

	//error-checking
if ($_POST[Send])
	{
	//checks to see if email is already in the db
	$clean_user_email=cleanforsql(strtolower($_POST[form_user_email]));	
	$sql="SELECT * FROM user_account WHERE user_email='$clean_user_email'";
	$r = mysql_query($sql, $db);
	//the variable m contains everything for that record. Is used to access and view.
	//everything inside the brackets matches my table names 1 to 1
	$m = mysql_fetch_array($r); 
	if ($m)  //means "if it finds a record that matches email"
		{
		//    may not need this any more, okay to delete this line if it works in testing    $pwd_to_send=$m[user_pwd];
		$pwd_sent_conf_msg="An email has been sent to you with a link to reset your password.";	 
		$userhash = getuserhash($m[user_id],$m[user_pwd]);
		$url = "http://" . $baseurl . "/account/recover_password.php?i=" . $m[user_id] . "&h=" . $userhash;
		
		//next lines email the user
		$message = "Click this link to change your password: \n\n";
		$message .= $url . "\n\n";
		$message .= "For your security, this link will no longer work after you have updated your password, and you can then delete this message. \n\n";
		$message .= "Sincerely, \n\n";
		$message .= "The BHoF Team";
		 
		 mail($_POST['form_user_email'],"Password reset request",  
		 $message, "From:BHoF account system <2014@bhofapplication.com>");
	
		}
	else 
		{
		$pwd_sent_conf_msg="Your email address is not in the system. Please try another.";
		}
	}

?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Forgot Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<h1 align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?> 
  <?php echo $pageant_year;?> Application</strong></font></h1>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Forgot 
  password </font></strong></h2>
<p>&nbsp;</p>
<p>Forgot your password? Enter your the email address of your account below. We 
  will send you an email titled &quot;Password update request&quot;. This will 
  contain a link to reset your password. (Check your spam folder if you don't 
  see it in your inbox).</p>
<p> If you remember your password in the meantime, you can still sign in on the 
  <a href="../index.php">main login screen</a>.</p>
<form name="form1" method="post" action="">
  <p>Your email address: 
    <input name="form_user_email" type="text" id="form_user_email" size=60 value="<?php echo $_POST[form_user_email]; ?>">
  </p>
  <p>&nbsp;</p>
  <p> <font face="Geneva, Arial, Helvetica, sans-serif"> 
    <input name="Send" type="submit" id="Send" value="Send me a password reset link"><span class="user_account_error_msg"><?php echo $pwd_sent_conf_msg ?></span>
    </font></p>
  </form>
<hr>
<p align="center"><font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry </a></font></p>
</body>
</html>
