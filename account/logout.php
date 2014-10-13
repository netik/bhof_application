<?PHP
session_start();
$_SESSION = array();
session_destroy();
?>


<html>
<head>
<title>You are now logged out</title>
<meta http-equiv="refresh" content="6; url=../index.php">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<p align="center">&nbsp;</p>
<hr align="center">
<h2 align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong>Thank 
  you for using the <?php echo $bh_name_abbrev;?> system!</strong></font></h2>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">You 
  are now logged out.</font></strong></h2>
<h3 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">If 
  you are not redirected to the home page in a few seconds, click <a href="../index.php">here</a></font></strong></h3>
</body>
</html>
