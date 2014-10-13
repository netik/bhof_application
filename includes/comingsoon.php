<?php
include_once ("includes/db_incl.php"); //change other pages to include_once too
$db=dbconnect ();
session_start(); 
?>

<html>
<head>
<title><?php echo $bh_name_abbrev;?><?php echo $pageant_year;?>- Coming soon in 3D!</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="includes/styles.css"> 
</head>

<body>
<h1 align="center" class="rulepageheaders">&nbsp;</h1>
<h1 align="center" class="rulepageheaders">The <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> application system will be ready soon!</h1>
<p>&nbsp;</p>
<table width="600" border="0" align="center">
  <tr>
    <td width="847"><p align="center"><strong>Thank you for stopping by! </strong>The online application system is temporarily unavailable while we update it for the 2015 Weekender. </p>
      <p align="center">&nbsp;</p>
      <p align="center"><strong>Dates to know:</strong></p>
      <table width="750" height="154" border="2" align="center" cellpadding="2" cellspacing="2" class="boxhighlight">
        <tr>
          <td width="289"><div align="center"><strong>fall 2014</strong></div></td>
          <td width="289" class="highlight"><div align="center"><strong>2015 application rules posted</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>November 2014</strong></div></td>
          <td class="highlight"><div align="center"><strong>2015 application opens</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong><?php echo $deadline_without_time;?></strong></div></td>
          <td class="highlight"><div align="center"><strong>Application deadline</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>March 2015</strong></div></td>
          <td class="highlight"><div align="center"><strong>Application notifications</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>March 2015</strong></div></td>
          <td class="highlight"><div align="center"><strong>Weekend passes go on sale</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>April 2015</strong></div></td>
          <td class="highlight"><div align="center"><strong>Tickets go on sale</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>May 1, 2015</strong></div></td>
          <td class="highlight"><div align="center"><strong><a href="http://bhofweekend.com/attend/hotel/" target="new">Hotel group rate</a> expires</strong></div></td>
        </tr>
        <tr>
          <td><div align="center"><strong>June 4-7, 2015</strong></div></td>
          <td class="highlight"><div align="center"><strong>2015 Weekender</strong></div></td>
        </tr>
      </table>
    <p align="center"><strong>To be notified by email when the rules are posted and the application system opens, go <a href="http://eepurl.com/Hniz1" title="Notification sign-up form" target="_blank">here</a>.</strong> (You'll receive three notification emails: when the rules are posted, when the application opens, and two weeks before it closes. This will not add you to any other lists.) In the meantime, here's some information about  <a href="http://www.burlesquehall.com/selection/" target="_blank">how the selection process works</a>. </p></td>
  </tr>
</table>
<p align="center"><strong>Please join us online at: </strong><br><a href="http://www.burlesquehall.com" target="_blank"><?php echo $bh_name_abbrev;?> website</a> - <a href="http://www.facebook.com/theburlesquehall" target="new"><?php echo $bh_name_abbrev;?> Facebook page</a> - <a href="http://www.bhofweekend.com" target="new"><?php echo $bh_name_abbrev;?> Weekender website</a> - <a href="http://www.facebook.com/bhofweekend" target="new"><?php echo $bh_name_abbrev;?> Weekender Facebook page</a> - <a href="https://twitter.com/burlesquehall" target="_blank"><?php echo $bh_name_abbrev;?> Twitter</a></p>
<p>&nbsp;</p>
<p align="center">-Team <?php echo $bh_name_abbrev;?></p>
<hr>
<p align="center">&nbsp;</p>
</body>
</html>
 
