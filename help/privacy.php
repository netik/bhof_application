<?php
include ("../includes/db_incl.php"); 
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  <a href="instructions.php">Instructions for completing the application</a> - <a href="judging_criteria.php">Judging 
  criteria</a> - <a href="rules.php">Rules for entry</a></font> - Privacy</p>
<hr align="center">
<h2 align="center" class="rulepageheaders"><strong>Privacy</strong></h2>
<h3>&nbsp;</h3>
<h3 class="rulepageheaders"><strong>Some notes on security and what we do with your application information:</strong></h3>
<ol>
  <li>In applying to participate in this event, you grant <?php echo $bh_name_long;?> and its assignees irrevocable permission to use your name, likeness, and performance 
  for unlimited promotional use. (This is further covered in the rules.) </li>
  <li>We use your application information to evaluate applications and make a decision, and then contact you regarding your application. We do not share your information with any third parties.</li>
  <li>We won't spam you! However, if you submit an application, we will need to add your email address to any distribution lists that relate directly and specifically to the <?php echo $pageant_year;?> production and/or selection process. You cannot opt out of these lists. We reserve the right to email you for this purpose for either 18 months or  up to and including notification about the next year's applications, whichever comes first. We will not automatically add your email address to   <?php echo $bh_name_long;?> general mailing list. But we encourage youto join it, of course!</li>
  <li><?php echo $bh_name_long;?> reserves the right to use your mailing address for future direct mail, but only from <?php echo $bh_name_long;?>. It will not be provided to third parties. If you do not wish for this, please contact <?php echo $bh_name_long;?> with this request.</li>
  <li>Passwords on our site are encrypted and nobody at <?php echo $bh_name_long;?> has the ability to see them. (This system does offer a self-service password reset tool.)</li>
  <li>We gather aggregate use statistics (like number of page views) to help us make improvements to the application. These statistics do not link to any personally identifiable information. </li>
</ol>
<blockquote>
  <hr align="center">
</blockquote>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  <a href="instructions.php">Instructions for completing the application</a> 
   - <a href="judging_criteria.php">Judging 
  criteria</a> - <a href="rules.php">Rules for entry </a></font>- Privacy</p>
</body>
</html>
