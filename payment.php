<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
require ("includes/session_incl.php");
submitted_redirect();
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
<div align="right" class="navlinks"><?php echo account_nav_links(); ?></div>
<blockquote>
  <blockquote>
    <h1 align="center"><strong><?php echo $bh_name_abbrev;?>&nbsp;<?php echo $pageant_year;?> 
      Application</strong></h1>
    <h2 align="center"><strong>Payment of application fee</strong>    </h2>
    <div>
      <p><strong>The $39 application fee is discounted to US$29 if paid before 11:59pm PST on January 15, 2013. If you are submitting 
        both a solo and a group act, please make a separate payment from within each 
        application. </strong></p>
    </div>
    <div align="center">
    <div class="boxhighlight">
      <h3 align="left">What to do on this page:</h3>
      <div align="left">
        <ul>
          <li>Please enter the name of the performer or group that you are paying the 
            fee for, then click &quot;Pay Now&quot;. You will be taken to the PayPal website, 
            where you can pay with a credit card or a PayPal account. </li>
          <li><strong>If you are going to be submitting more than one act, do this from within each application, and please include the act's name/description along with your performer or group name. </strong>
<ul>
  <li><strong>Example 1-- submitting one solo act:</strong> Jessica Rabbit is applying with only one act, a solo. In the box below, she'll type &quot;Jessica Rabbit&quot; and click the button.</li>
              <li><strong>Example 2-- submitting two solo acts:</strong> Natasha Fatale is applying with two acts: her &quot;Moose act&quot; and her &quot;Squirrel act.&quot; In the box below, she'll type &quot;Natasha Fatale - Moose act&quot;. In the other application, she'll type &quot;Natasha Fatale - Squirrel act.&quot; (<strong>Two group acts</strong> should be submitted the same way.)</li>
              <li><strong>Example 3-- submitting one solo and one group act:</strong> Sporty Spice is submitting a solo act for herself, and also one for the entire Spice Girls group. In the box below, she'll type &quot;Sporty Spice&quot;. In the other application, she'll type &quot;Spice Girls.&quot;</li>
          </ul>
          </li>
          </ul>
      </div>
      <h3 align="left">What happens after that:</h3>
      <div align="left">
        <ul>
          <li>Once we have received your payment, we will update your account on the main 
            dashboard to show that the fee has been paid, but won't send you an email 
            notifying you. <strong>Please note that currently, we have to set this in 
              your account manually... we're aiming for quick turnaround, but it can still 
              take a day. So please do this early, and then check the Main Dashboard to 
              see that this is marked as Completed.</strong> </li>
        </ul>
      </div>
      <ul>
      </ul>
      <p align="left">
        <?php 
	// this is code to check to see if they have paid. Can put it back in later but decided to not check for this.
	//$sql = "SELECT * FROM completed WHERE user_id = $_SESSION[user_id] AND completed_year = $pageant_year";
	//$r = mysql_query($sql, $db); // Perform the SQL command
	//$m = mysql_fetch_array($r);
  
	//if ($m[completed_form_name] == 'payment')
	//	{
	//	echo "You have already paid the application fee. Thank you!";
	//	}
    //	else  // Else they haven't paid yet so show them buttons.
			//Next few lines surface either the "earlybird" or "regular price" button depending on if that deadline has passed. Yay for automation! This is similar to the code from index.php. The code that checks for this is from http://www.cyberscorpion.com/2011-06/using-php-to-dynamically-hide-content-after-an-expiration-date/. 
						//SET THE TIME ZONE
			date_default_timezone_set('America/Los_Angeles');
			//CREATE TIMESTAMP VARIABLES
			$current_ts = time();
			//$current_ts = mktime(0,10,1,1,27,2014);  //This line is to test sample dates against the deadline. Change this to fake what the "current" date/time is. Just for debugging/testing. Comment out to make it live. 
			$deadline_ts = mktime(0,2,0,1,16,2014);    //Format to shut it off 10 mins after midnight on date is (0,10,0,1,27,2014)
			//IF THE DEADLINE HAS PASSED, LET USER KNOW…ELSE, DISPLAY THE REGISTRATION FORM
			if($current_ts > $deadline_ts) 
				{
				include ("includes/paypal_button_fullprice.php");  //changed from includes/paypal_button_earlybird.php when price went up
				} 
			else 
				{
			include ("includes/paypal_button_earlybird.php");  //changed from includes/paypal_button_earlybird.php when price went up
				}
?>
      </p>
      <p align="left">&nbsp;</p>
      <p align="left"><font size="+1">Done on this page? <a href="../main.php">Go to main dashboard</a></font></p>
    </div>
    </div>
    <p>&nbsp;</p>
    <hr>
    <p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
      for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
        criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
  </blockquote>
</blockquote>
</body>
</html>
