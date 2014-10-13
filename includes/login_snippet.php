<?php
// include_once ("includes/db_incl.php"); //change other pages to include_once too
// $db=dbconnect ();
//  session_start(); 

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
			
			//Next few lines decide where to take them now that login is successful. If deadline is not passed, takes them to Welcome. If deadline has passed, takes them to results.php. The code that checks for this is from http://www.cyberscorpion.com/2011-06/using-php-to-dynamically-hide-content-after-an-expiration-date/. 
						//SET THE TIME ZONE
			date_default_timezone_set('America/Los_Angeles');
			//CREATE TIMESTAMP VARIABLES
			$current_ts = time();
			//$current_ts = mktime(0,10,1,1,27,2014);  //This line is to test sample dates against the deadline. Change this to fake what the "current" date/time is. Just for debugging/testing. Comment out to make it live. 
			$deadline_ts = mktime(0,10,0,1,19,2015);    //Format to shut it off 10 mins after midnight on date is (0,10,0,1,27,2014) or (h, m, s, month, day, year)
			if($current_ts > $deadline_ts) 
				{
				 header ("location: results.php"); //takes them to results.php if after deadline
				} 
			else 
				{
			header ("location: welcome.php");//takes them to the Welcome page if before deadline
				}
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
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Log in</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css"> 


<style type="text/css">
.yellow {
	color: #FF0;
}
</style>
</head>

<body>
<h1 align="center" class="rulepageheaders">Welcome to the <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> 
  application system!</h1>
<h3 align="center"><font color="ffffff" class="highlight">Deadline:</font> applications are due 
  at <?php echo $deadline_with_time;?>. Time until deadline: 
  <script language="JavaScript"> //from http://www.hashemian.com/tools/javascript-countdown.htm
		TargetDate = "01/19/2015 11:59 PM UTC-0800";
		BackColor = "white";
		ForeColor = "red";
		CountActive = true;
		CountStepper = -1;
		LeadingZero = true;
		DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
		FinishMessage = "Deadline has now passed";
		</script>
  <script language="JavaScript" src="includes/countdown.js"></script>
</h3>
<h3 align="center"><font color="ffffff" class="highlight">New for this year:</font> Each performer or group may submit up to two acts. But as before, each act being submitted must have a Main Contact Person with 
  its own account. If you are submitting 
    more than one act (for yourself, your group, or any combination), please create a separate account (using a separate 
  email address) for each one.</h3>
  
<h3 align="center">
  <p align="center">This year, we are again offering an earlybird discount ($10 off) for early payment of the application fee! Once paid, you can still have until <?php echo $deadline_abbrev;?> to  complete and submit the full application.
  <p align="center">See the instructions/rules (linked at the bottom of every 
    page) for more details. 
</h3>
<div align="center">
<table width="937" height="335" border="1" align="center" cellpadding="12" cellspacing="3" bordercolor="" class="boxhighlight" style="background-color:">
    <tr valign="top"> 
      <td width="360" height="327"><p><font size="+1">Log in here! You can use your same login info from past years.</font></p>
        <p>
          <label class="highlight"><em><strong>NOT recommended for mobile phone browsers. Please use a tablet or larger.</strong></em></label></p>
        <form name="form1" method="post" action="">
          <p>Your email address:<br>
            <input name="form_user_email" type="text" id="form_user_email" size=60 value="<?php echo $_POST[form_user_email]; ?>">
            <span class="user_account_error_msg"><?php echo $error_email_msg; ?><?php echo $error_user_status_msg; ?></span></p>
          <p>Your password:<br>
            <input name="form_user_pwd" type="password" id="form_user_pwd" size=20 value="<?php echo $_POST[form_user_pwd]; ?>">
            <span class="user_account_error_msg"><?php echo $error_pwd_msg; ?></span></p>
          <p> <input name="login" type="submit" id="login" value="Log in"></p>
        </form>
        <ul class="navlinks">
          <li><a href="/account/newuser.php">Create new account</a></li>
          <li> <a href="/account/forgot_password.php">Reset forgotten password</a></li>
        </ul></td>
      <td width="517"> <label> </label> <p> 
          <label><font size="+1">Dates to remember:</font></label>
        </p>
        <ul>
          <li><strong>Fall 2014:</strong> <span class="highlight">application rules posted</span></li>
          <li><strong>Fall 2014:</strong> <span class="highlight">2014 application opens</span></li>
          <li><strong>December 15, 2013:</strong> <span class="highlight">deadline for partially refundable fees<img src="../assets/help_icon_2013.png" alt="Deadline on this day is 11:59pm PST. Payment before this is $29 (reduced price) and 50% refundable if you end up not submitting the application. After this deadline, all payments are nonrefundable." width="18" height="18" title="Deadline on this day is 11:59pm PST. Payment before this is $29 (reduced price) and 50% refundable if you end up not submitting the application. After this deadline, all payments are nonrefundable."></span></li>
          <li><strong>January 8, 2014:</strong> <span class="highlight">deadline for reduced price application fee</span><span class="highlight"><img src="../assets/help_icon_2013.png" alt="Deadline on this day is 11:59pm PST. Payment before this is $29 (reduced price). Payment after this is $39 (full price)." width="18" height="18" title="Deadline on this day is 11:59pm PST. Payment before this is $29 (reduced price). Payment after this is $39 (full price)."></span></li>
          <li><strong><?php echo $deadline_without_time;?></strong><strong>:</strong> <span class="highlight">application deadline</span></li>
          <li><strong>March 2015:</strong> <span class="highlight">application notifications</span></li>
          <li><strong>March 2015:</strong> <span class="highlight">Weekend passes go on sale</span></li>
          <li><strong>April 2015:</strong> <span class="highlight">tickets go on sale</span></li>
          <li><strong>May 1, 2015:</strong> <span class="highlight"><a href="http://bhofweekend.com/attend/hotel/">hotel group rate</a> expires</span></li>
          <li><strong>June 4-7, 2015:</strong> <span class="highlight">2014 Weekender</span></li>
        </ul>
        <p> 
          <label></label>
        </p></td>
    </tr>
  </table>
  <h3><?php echo $bh_name_abbrev;?> Weekend Mission Statement:  </h3>
  <p><em>&quot;The <?php echo $bh_name_abbrev;?> Weekend's mission is to serve 
    as the <?php echo $bh_name_abbrev;?>'s major sustainable annual fundraising 
    event while also: being the foremost gathering of the international burlesque 
    community; creating an opportunity for participants to develop real and tangible 
    relationships with burlesque's past and present; to celebrate performers of 
    all generations of the art form; and to recognize the best of contemporary 
    burlesque performance in all of its diversity.&quot;</em></p>
</div>
</body>
</html>
 
