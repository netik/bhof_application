<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
require ("includes/session_incl.php");
?>

<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="includes/styles.css"> 
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link. Commented out for 2012
<!-- function decision(message, url){
<!-- if(confirm(message)) location.href = url;
<!-- }
// --->
</SCRIPT>
</head>

<body>
<div align="right"> 
  <div align="right" class="navlinks"> <?php echo account_nav_links(); ?></div>
  <h1 align="center"><?php echo $bh_name_abbrev;?><strong> &nbsp;<?php echo $pageant_year;?> 
    Application</strong></h1>
  <h2 align="center"><strong>Congratulations! Your application has been submitted! 
    Here's where to go from here:</strong></h2>
  <p align="left">&nbsp;</p>
</div>
<ul>
  <li> 
    <div align="left">We expect that decisions will be available on this website 
      <strong>in March 2014.</strong></div>
  </li>
  <li> 
    <div align="left">Decisions will not be directly emailed, but instead will 
      be through this website. We'll announce when decisions are ready. To find out your decision, log in to this system.</div>
  </li>
  <li>The main dashboard page is now updated to show that your application has 
    been submitted. You cannot make changes to your application, but if you need 
    to update your email address or print a copy of your application, you can 
    still log in and do so on that page.</li>
</ul>
<p align="center"><strong><font size="+1">Click <a href="main.php">here</a> to 
  go to the main dashboard, and be sure to log out when you are done! Thank you 
  for using the <?php echo $bh_name_abbrev;?> Application system!</font></strong></p>
<div align="right"> 
  <div align="center"></div>
</div>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
