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
if(!$r = mysql_query($sql, $db)) die("Error updating password.");
if(!$m = mysql_fetch_array($r)) die ("Error fetching userdata from user id."); 

$user_hash = getuserhash($user_id, $m[user_pwd]);

if ($_GET[h] != $user_hash) die ("Error: userhash did not match userID."); 

if($_POST[Save])
	{ // updating password
	// Check to make sure they are the right user
	$update_password = 1; 

	if($update_password)
		{
		$userid = $_GET[i]; 
		$password = getpasswordhash(cleanforsql($_POST[form_user_pwd]));
		$sql = "UPDATE user_account SET user_pwd = '$password' WHERE user_id = $userid"; 	
		
		if(!$r = mysql_query($sql, $db)) die("Error updating password.");
	// This message below is displayed on the page upon a successful update.
		$message = "Your account information for the BHoF system has been updated. Please go to the <a href=\"/index.php\"> login page</a> to continue.";
		}
	
	
	}


?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Edit Account Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">	
</head>

<body>
<div align="right"></div>
<h1 align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?> 
  <?php echo $pageant_year;?> Application</strong></font></h1>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Password 
  reset </font></strong></h2>
<p><strong><font size="+1">Enter (and retype) your desired password here.</font></strong></p>
<form name="form1" method="post" action="">
  <table width="1021" border="0" align="center" cellpadding="5" cellspacing="3" bordercolor="" class="boxhighlight" style="background-color:">
    <tr> 
      <td width="350" class="rulepageheaders"><div align="right"><font face="Geneva, Arial, Helvetica, sans-serif">C</font><font face="Geneva, Arial, Helvetica, sans-serif">hoose 
          a new password (up to 16 characters): </font></div></td>
      <td width="642"><font face="Geneva, Arial, Helvetica, sans-serif"> 
        <input name="form_user_pwd" type="password" id="form_user_pwd2" size=20 value="<?php echo $_POST[form_user_pwd]; ?>">
        <span class="user_account_error_msg"><?php echo $error_pwd_msg; ?></span></font></td>
    </tr>
    <tr> 
      <td class="rulepageheaders"><div align="right"><font face="Geneva, Arial, Helvetica, sans-serif">Retype 
          your new password</font><font face="Geneva, Arial, Helvetica, sans-serif">: 
          </font></div></td>
      <td><font face="Geneva, Arial, Helvetica, sans-serif"> 
        <input name="form_pwd_retype" type="password" id="form_pwd_retype2" size=20 value="<?php echo $_POST[form_pwd_retype]; ?>">
        </font></td>
    </tr>
    <tr> 
      <td><div align="center"></div></td>
      <td><font face="Geneva, Arial, Helvetica, sans-serif"> 
        <input name="Save" type="submit" id="Save" value="Save">
        </font></td>
		<?php if ($message) echo "<p class=\"user_account_error_msg\" align=\"center\">$message</p>"; ?>
    </tr>
  </table>
  <p><font face="Geneva, Arial, Helvetica, sans-serif"> </font></p>
  </form>
<hr>
<p align="center"><font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry </a></font></p>
</body>
</html>
