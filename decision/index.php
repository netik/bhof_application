<?php
include ("../photos/includes/db_incl.php"); 
$db=dbconnect ();
require ("../photos/includes/session_incl.php");
?>

<html>
<head>
<title>You do not have access</title>
<meta http-equiv="refresh" content="6; url=../index.php">
<link rel="stylesheet" type="text/css" href="/includes/styles.css">
</head>

<body>
<div align="right"><?php echo account_nav_links(); ?></div>
<h1 align="center"><strong><?php echo $bh_name_abbrev;?> &nbsp;<?php echo $pageant_year;?> 
  Application</strong></h1>
<h2 align="center"><strong>Nice try! You don't have access to this directory.</strong></h2>
<p align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">If 
  you are not redirected to the home page in a few seconds, click <a href="/index.php">here</a></font> 
  </strong></p>
</body>
</html>
