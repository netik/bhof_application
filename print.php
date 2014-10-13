<?php
include ("includes/db_incl.php"); 
$db=dbconnect ();
include ("includes/session_incl.php");
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Printable application form for the <?php echo $bh_name_abbrev;?> Application 
  System. You may print this from your browser.</p>
<p> <font size="+1"><strong>Applicant Contact Person:</strong></font></p>

<!-- Next few lines are php for populating the Contact Person fields -->
<?php 
	$sql = "SELECT * FROM mainperson_contactinfo WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug:  or die(mysql_error());
?>
<ul>
  <li><strong>Email address:</strong> <?php echo $_SESSION[user_email];?></li> 
  <li><strong>Pageant year applied for:</strong> <?php echo $pageant_year;?></li>
  <li><strong>Application status:</strong> <?php echo $_SESSION[submitted_status];?></li>
  <li><strong>Legal name:</strong> <?php echo $m[mainperson_legal_name];?></li>
  <li><strong>Mailing address:</strong> <?php echo $m[mainperson_street_address];?></li>
  <li><strong>Daytime phone:</strong> <?php echo $m[mainperson_phone_day];?></li>
  <li><strong>Evening phone:</strong> <?php echo $m[mainperson_phone_eve];?></li>
</ul>
<p><font size="+1"><strong>Solo Act:</strong></font></p>
<!-- Next few lines are php for populating the SOLO DESCRIPTION fields -->
<?php 
	$sql = "SELECT * FROM solo_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
<ul>
  <li><strong>Solo - description - performer name:</strong> <?php echo $m[solo_performer_name];?></li>
  <li><strong>Solo - description - city you are listed as being from:</strong> 
    <?php echo $m[solo_city_listed_from];?></li>
  <li><strong>Solo - description - category:</strong> <?php echo $m[solo_category];?></li>
  <li><strong>Solo - description - performer's website:</strong> <?php echo $m[solo_performer_website];?></li>
  <li><strong>Solo - description - compete/showcase preference:</strong> <?php echo $m[solo_compete_preference];?></li>
  <li><strong>Solo - description - weblink of footage of act:</strong> <?php echo $m[solo_weblink_footage_of_act];?></li>
  <li><strong>Solo - description - other weblink #1:</strong> <?php echo $m[solo_weblink_other_1];?></li>
  <li><strong>Solo - description - other weblink #2:</strong> <?php echo $m[solo_weblink_other_2];?></li>
  <li><strong>Solo - description - other weblink #3:</strong> <?php echo $m[solo_weblink_other_3];?></li>
  <li><strong>Solo - description - previous years applied:</strong> <?php echo $m[solo_prev_years_applied];?></li>
  <li><strong>Solo - description - previous years performed:</strong> <?php echo $m[solo_prev_years_performed];?></li>
  <li><strong>Solo - description - other festivals performed:</strong> <?php echo $m[solo_other_festivals_performed];?></li>
  <li><strong>Solo - description - other stage names:</strong> <?php echo $m[solo_other_stage_names];?></li>
  <li><strong>Solo - description - other titles awarded:</strong> <?php echo $m[solo_titles_awarded];?></li>
  <!-- Next few lines are php for populating the SOLO SHORT ANSWERS fields -->
  <?php 
	$sql = "SELECT * FROM solo_act_essays WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
  <li><strong>Solo - short answers - favorite thing:</strong> <?php echo $m[solo_essay_favorite_thing];?></li>
  <li><strong>Solo - short answers - how long have you performed:</strong> <?php echo $m[solo_essay_how_long_performer];?></li>
  <li><strong>Solo - short answers - your style:</strong> <?php echo $m[solo_essay_your_style];?></li>
  <li><strong>Solo - short answers - why your act is unique:</strong> <?php echo $m[solo_essay_why_act_unique];?></li>
  <li><strong>Solo - short answers - career highlight:</strong> <?php echo $m[solo_essay_career_highlight];?></li>
  <li><strong>Solo - short answers - your outside life:</strong> <?php echo $m[solo_essay_vanilla_life];?></li>
  <li><strong>Solo - short answers - additional comments:</strong> <?php echo $m[solo_essay_additional_comments];?></li>
  <!-- Next few lines are php for populating the SOLO TECH INFO fields -->
  <?php 
	$sql = "SELECT * FROM solo_act_tech_info WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
  <li><strong>Solo - tech info - song title(s):</strong> <?php echo $m[solo_tech_songtitle];?></li>
  <li><strong>Solo - tech info - song artist(s):</strong> <?php echo $m[solo_tech_songartist];?></li>
  <li><strong>Solo - tech info - act duration:</strong> <?php echo $m[solo_tech_act_duration];?></li>
  <li><strong>Solo - tech info - name of act:</strong> <?php echo $m[solo_tech_name_of_act];?></li>
  <li><strong>Solo - tech info - brief description of act:</strong> <?php echo $m[solo_tech_act_brief_description];?></li>
  <li><strong>Solo - tech info - costume description:</strong> <?php echo $m[solo_tech_costume_description];?></li>
  <li><strong>Solo - tech info - costume colors:</strong> <?php echo $m[solo_tech_costume_colors];?></li>
  <li><strong>Solo - tech info - props:</strong> <?php echo $m[solo_tech_props];?></li>
  <li><strong>Solo - tech info - other tech info:</strong> <?php echo $m[solo_tech_other_tech_info];?></li>
  <li><strong>Solo - tech info - setup needs:</strong> <?php echo $m[solo_tech_setup_needs];?></li>
  <li><strong>Solo - tech info - setup time:</strong> <?php echo $m[solo_tech_setup_time];?></li>
  <li><strong>Solo - tech info - breakdown needs:</strong> <?php echo $m[solo_tech_breakdown_needs];?></li>
  <li><strong>Solo - tech info - breakdown time:</strong> <?php echo $m[solo_tech_breakdown_time];?></li>
  <li><strong>Solo - tech info - sound cue:</strong> <?php echo $m[solo_tech_sound_cue];?></li>
  <li><strong>Solo - tech info - microphone needs:</strong> <?php echo $m[solo_tech_microphone_needs];?></li>
  <li><strong>Solo - tech info - lighting needs:</strong> <?php echo $m[solo_tech_lighting_needs];?></li>
  <li><strong>Solo - tech info - aerial needs:</strong> <?php echo $m[solo_tech_aerial_needs];?></li>
  <li><strong>Solo - tech info - emcee intro:</strong> <?php echo $m[solo_tech_emcee_intro];?></li>
</ul>
<p>&nbsp;</p>
<p><font size="+1"><strong>Group Act:</strong></font></p>
<!-- Next few lines are php for populating the GROUP DESCRIPTION fields -->
<?php 
	$sql = "SELECT * FROM group_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
<ul>
  <li><strong>Group - description - performer name:</strong> <?php echo $m[group_performer_name];?></li>
  <li><strong>Group - description - city you are listed as being from:</strong> 
    <?php echo $m[group_city_listed_from];?></li>
  <li><strong>Group - description - compete/showcase preference:</strong> <?php echo $m[group_compete_preference];?></li>
  <li><strong>Group - description - performer's website:</strong> <?php echo $m[group_performer_website];?></li>
  <li><strong>Group - description - weblink of footage of act:</strong> <?php echo $m[group_weblink_footage_of_act];?></li>
  <li><strong>Group - description - other weblink #1:</strong> <?php echo $m[group_weblink_other_1];?></li>
  <li><strong>Group</strong><strong> - description - other weblink #2:</strong> 
    <?php echo $m[group_weblink_other_2];?></li>
  <li><strong>Group - description - other weblink #3:</strong> <?php echo $m[group_weblink_other_3];?></li>
  <li><strong>Group - description - previous years applied:</strong> <?php echo $m[group_prev_years_applied];?></li>
  <li><strong>Group - description - previous years performed:</strong> <?php echo $m[group_prev_years_performed];?></li>
  <li><strong>Group - description - other festivals performed:</strong> <?php echo $m[group_other_festivals_performed];?></li>
  <li><strong>Group - description - other stage names:</strong> <?php echo $m[group_other_stage_names];?></li>
  <li><strong>Group - description - other titles awarded:</strong> <?php echo $m[group_titles_awarded];?></li>
  <!-- Next few lines are php for populating the GROUP SHORT ANSWERS fields -->
  <?php 
	$sql = "SELECT * FROM group_act_essays WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
  <li><strong>Group - short answers - what brings you to the Weekend:</strong> 
    <?php echo $m[group_essay_what_brings_you_here];?></li>
  <li><strong>Group - short answers - how long have you performed:</strong> <?php echo $m[group_essay_how_long_performer];?></li>
  <li><strong>Group - short answers - your style:</strong> <?php echo $m[group_essay_your_style];?></li>
  <li><strong>Group - short answers - why your act is unique:</strong> <?php echo $m[group_essay_why_act_unique];?></li>
  <li><strong>Group - short answers - career highlight:</strong> <?php echo $m[group_essay_career_highlight];?></li>
  <li><strong>Group - short answers - additional comments:</strong> <?php echo $m[group_essay_additional_comments];?></li>
  <!-- Next few lines are php for populating the GROUP TECH INFO fields -->
  <?php 
	$sql = "SELECT * FROM group_act_tech_info WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db);
	$m = mysql_fetch_array($r); // uncomment to debug or die(mysql_error());
?>
  <li><strong>Group - tech info - song title(s):</strong> <?php echo $m[group_tech_songtitle];?></li>
  <li><strong>Group - tech info - song artist(s):</strong> <?php echo $m[group_tech_songartist];?></li>
  <li><strong>Group</strong><strong> - tech info - act duration:</strong> <?php echo $m[group_tech_act_duration];?></li>
  <li><strong>Group - tech info - name of act:</strong> <?php echo $m[group_tech_name_of_act];?></li>
  <li><strong>Group - tech info - brief description of act:</strong> <?php echo $m[group_tech_act_brief_description];?></li>
  <li><strong>Group</strong><strong> - tech info - costume description:</strong> 
    <?php echo $m[group_tech_costume_description];?></li>
  <li><strong>Group - tech info - costume colors:</strong> <?php echo $m[group_tech_costume_colors];?></li>
  <li><strong>Group - tech info - props:</strong> <?php echo $m[group_tech_props];?></li>
  <li><strong>Group - tech info - other tech info:</strong> <?php echo $m[group_tech_other_tech_info];?></li>
  <li><strong>Group - tech info - setup needs:</strong> <?php echo $m[group_tech_setup_needs];?></li>
  <li><strong>Group - tech info - setup time:</strong> <?php echo $m[group_tech_setup_time];?></li>
  <li><strong>Group - tech info - breakdown needs:</strong> <?php echo $m[group_tech_breakdown_needs];?></li>
  <li><strong>Group - tech info - breakdown time:</strong> <?php echo $m[group_tech_breakdown_time];?></li>
  <li><strong>Group - tech info - sound cue:</strong> <?php echo $m[group_tech_sound_cue];?></li>
  <li><strong>Group - tech info - microphone needs:</strong> <?php echo $m[group_tech_microphone_needs];?></li>
  <li><strong>Group - tech info - lighting needs:</strong> <?php echo $m[group_tech_lighting_needs];?></li>
  <li><strong>Group - tech info - aerial needs:</strong> <?php echo $m[group_tech_aerial_needs];?></li>
  <li><strong>Group - tech info - emcee intro:</strong> <?php echo $m[group_tech_emcee_intro];?></li>
</ul>
<hr>
<p align="center">Thank you for using the <?php echo $bh_name_abbrev;?> application 
  system!</p>
</body>
</html>
