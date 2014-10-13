<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
// include ("../includes/session_incl.php");

?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> - Account Created Successfully</title>
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<div align="right"></div>
<h1 align="center"><strong><?php echo $bh_name_abbrev;?> Application</strong></h1>
<h2 align="center">Account created!</h2>
<hr align="center">
<blockquote>
  <blockquote>
    <h3 align="left"><strong><font size="+1">Your account has been created! We've 
      sent you an email to verify your email address.</font></strong></h3>
    <h3 align="left"><font size="+1"><strong>Here's what to do next:</strong></font></h3>
    <ul>
      <li>Check your email and click the activation link in the email we just sent 
        you. You only need to do this once.</li>
      <li><strong>We recommend you read the following before you get started. If you 
        need to refer back to these at any time, there are links to them at the bottom 
        of every page.</strong> 
        <ul>
          <li><strong><font size="-1"><a href="../help/instructions.php">Instructions 
            for completing the application</a> </font></strong></li>
          <li><strong><font size="-1"><a href="../help/judging_criteria.php">Judging 
            criteria</a> </font></strong></li>
          <li><strong><font size="-1"><a href="../help/rules.php">Complete rules for 
            entry</a></font></strong></li>
        </ul>
      </li>
    </ul>
    <p>Good luck!</p>
    <p>The <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Team</p>
  </blockquote>
</blockquote>
<hr>
<p align="center"><font size="-1"><a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
<p align="center">&nbsp; </p>
</body>
</html>
