<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
include ("../includes/session_incl.php");
submitted_redirect();

function getrecord()
	{ /// this function will select a record if it exists, and if it does not exist, it will create a new one. 
	global $db; 
	global $tabledata;
	global $table_id; 
	global $pageant_year; 
	$sql="SELECT * FROM group_act_tech_info WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[group_tech_id];
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO group_act_tech_info (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		}

	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
		
	//create clean versions of form variables for sql insertion
	$clean_group_tech_songtitle=cleanforsql($_POST[form_group_tech_songtitle]);
	$clean_group_tech_songartist=cleanforsql($_POST[form_group_tech_songartist]);
	$clean_group_tech_act_duration=cleanforsql($_POST[form_group_tech_act_duration]);
	$clean_group_tech_name_of_act=cleanforsql($_POST[form_group_tech_name_of_act]);
	$clean_group_tech_act_brief_description=cleanforsql($_POST[form_group_tech_act_brief_description]);
	$clean_group_tech_costume_description=cleanforsql($_POST[form_group_tech_costume_description]);
	$clean_group_tech_costume_colors=cleanforsql($_POST[form_group_tech_costume_colors]);
	$clean_group_tech_props=cleanforsql($_POST[form_group_tech_props]);
	$clean_group_tech_other_tech_info=cleanforsql($_POST[form_group_tech_other_tech_info]);
	$clean_group_tech_setup_needs=cleanforsql($_POST[form_group_tech_setup_needs]);
	$clean_group_tech_setup_time=cleanforsql($_POST[form_group_tech_setup_time]);
	$clean_group_tech_breakdown_needs=cleanforsql($_POST[form_group_tech_breakdown_needs]);
	$clean_group_tech_breakdown_time=cleanforsql($_POST[form_group_tech_breakdown_time]);
	$clean_group_tech_sound_cue=cleanforsql($_POST[form_group_tech_sound_cue]);
	$clean_group_tech_microphone_needs=cleanforsql($_POST[form_group_tech_microphone_needs]);
	$clean_group_tech_lighting_needs=cleanforsql($_POST[form_group_tech_lighting_needs]);
	$clean_group_tech_aerial_needs=cleanforsql($_POST[form_group_tech_aerial_needs]);
	$clean_group_tech_emcee_intro=cleanforsql($_POST[form_group_tech_emcee_intro]);
						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE group_act_tech_info SET 
	pageant_year = '$pageant_year',
	group_tech_songtitle = '$clean_group_tech_songtitle', 
	group_tech_songartist = '$clean_group_tech_songartist',
	group_tech_act_duration = '$clean_group_tech_act_duration',
	group_tech_name_of_act = '$clean_group_tech_name_of_act',
	group_tech_act_brief_description = '$clean_group_tech_act_brief_description',
	group_tech_costume_description = '$clean_group_tech_costume_description',
	group_tech_costume_colors = '$clean_group_tech_costume_colors',
	group_tech_props = '$clean_group_tech_props',
	group_tech_other_tech_info = '$clean_group_tech_other_tech_info',
	group_tech_setup_needs = '$clean_group_tech_setup_needs',
	group_tech_setup_time = '$clean_group_tech_setup_time',
	group_tech_breakdown_needs = '$clean_group_tech_breakdown_needs',
	group_tech_breakdown_time = '$clean_group_tech_breakdown_time',
	group_tech_sound_cue = '$clean_group_tech_sound_cue',
	group_tech_microphone_needs = '$clean_group_tech_microphone_needs',
	group_tech_lighting_needs = '$clean_group_tech_lighting_needs',
	group_tech_aerial_needs = '$clean_group_tech_aerial_needs',
	group_tech_emcee_intro = '$clean_group_tech_emcee_intro'
	WHERE group_tech_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "This page last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 
	if (iscompleted($tabledata[group_tech_songtitle]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_tech_songartist]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_tech_act_duration]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_name_of_act]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_act_brief_description]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_costume_description]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_costume_colors]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_props]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_other_tech_info]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_setup_needs]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_setup_time]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_breakdown_needs]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_breakdown_time]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_sound_cue]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_microphone_needs]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_lighting_needs]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_aerial_needs]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_tech_emcee_intro]) == 0) $iscompleted = 0;		
	setcompleted("group_act_tech", $iscompleted);  
	//preceding line writes "group_act_tech" to Completed table if everything is complete.

	
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Group Act - Technical & Staging Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
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
<h1 align="center"><strong><?php echo $bh_name_abbrev;?> &nbsp;<?php echo $pageant_year;?> Application</strong></h1>
<h2 align="center"><strong>Group act: technical &amp; staging information</strong></h2>
<p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
<blockquote>
  <h3><strong>Technical information about your GROUP ACT should be entered below. 
    Notes:</strong></h3>
<ul>
    <li>If any of these fields are blank, this page will show up as &quot;incomplete&quot; 
      on the main dashboard. If any don't apply, enter &quot;n/a&quot; in the form 
      for &quot;Not Applicable.</li>
    <li>Remember,<strong> <em>ABSOLUTELY NO 
    FIRE, LIQUID, or MYLAR CONFETTI </em></strong> is permitted in your act. Thank you for understanding!</li>
    <li><strong>You do not need to submit a music track at this time<em>.</em></strong> 
      If you are selected to perform during the Weekend, the show producers will 
      contact you to provide music.</li>
    <li>Due to schedule requirements, <em><strong>all group acts must be FIVE MINUTES 
      OR LESS, </strong></em><strong>with up to 15 additional seconds TOTAL before/after 
        your music.</strong> There are no exceptions to this, so please make sure 
      your music and choreography fit this limit.
        <ul>
          <li><strong class="highlight">If your video shows the act lasting longer than this, please indicate in the &quot;duration of music and act&quot; box that you will trim the act to the required time!</strong> You will not be penalized or disqualified if the video is longer, but it will slow down our evaluation if we have to contact people to confirm that they can trim the act.</li>
        </ul>
    </li>
  </ul>
<hr>
<form name="form1" method="post" action="">
  <table width="1002" height="1414" border="0" align="center" cellpadding="3" cellspacing="5" class="boxhighlight">
    <tr> 
      <td width="419"> <div align="right" class="rulepageheaders">Song title. (If multiple titles, please 
          include all song titles; and you will be asked to mix them all into 
          one track.)</div></td>
      <td width="404"><textarea name="form_group_tech_songtitle" cols="60" rows="4" id="form_group_tech_songtitle"><?php echo $tabledata[group_tech_songtitle]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td width="419"><div align="right" class="rulepageheaders">Artist(s):</div></td>
      <td width="404"><textarea name="form_group_tech_songartist" cols="60" rows="4" id="form_group_tech_songartist"><?php echo $tabledata[group_tech_songartist]; ?></textarea></font> 
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Duration of music and 
          duration of act (from the time you<br>
          enter the stage until you exit).  If the video is longer than 4:15, please indicate that you can trim the act:</div></td>
      <td width="404"><label></label> <label> 
        <textarea name="form_group_tech_act_duration" cols="60" rows="4" id="form_group_tech_act_duration"><?php echo $tabledata[group_tech_act_duration]; ?></textarea>
        </label></td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Name of act: </div></td>
      <td width="404" valign="bottom"> <input name="form_group_tech_name_of_act" type="text" id="form_group_tech_name_of_act" size=66 value="<?php echo $tabledata[group_tech_name_of_act]; ?>">
        <img src="../assets/help_icon_2013.png" width="18" height="18" align="top" title="A name that you use to refer to this act, e.g., ''my purple fan dance'' or ''my Carmen Miranda number'' or ''panties from heaven''. This is to help our selection team when discussing acts, and won't be published or factored into the decision."> 
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Please give a brief 
          description of your piece, such as overall concept, theme, era or musical 
          style (so that we can be sure to appropriately space similar acts): 
          <em>(up to a few sentences):</em></div></td>
      <td width="404"> <textarea name="form_group_tech_act_brief_description" cols="60" rows="4" id="form_group_tech_act_brief_description"><?php echo $tabledata[group_tech_act_brief_description]; ?></textarea> 
        <br> <br></font>
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Briefly describe your 
          <strong>group's</strong> costuming:</div></td>
      <td width="404"> <textarea name="form_group_tech_costume_description" cols="60" rows="4" id="form_group_tech_costume_description"><?php echo $tabledata[group_tech_costume_description]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Costume colors at beginning 
          of act and end of act:</div></td>
      <td width="404"> <textarea name="form_group_tech_costume_colors" cols="60" rows="4" id="form_group_tech_costume_colors"><?php echo $tabledata[group_tech_costume_colors]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Please list all props 
          (including humans), tech needs, specialty equipment, potential hazards 
          and prep/clean-up required before, during or after your act:</div></td>
      <td width="404"> <textarea name="form_group_tech_props" cols="60" rows="4" id="form_group_tech_props"><?php echo $tabledata[group_tech_props]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td width="419" valign="middle"> <div align="right" class="rulepageheaders">Other special technical 
          info (if none, please put &quot;n/a&quot;):</div></td>
      <td width="404"> <textarea name="form_group_tech_other_tech_info" cols="60" rows="4" id="form_group_tech_other_tech_info"><?php echo $tabledata[group_tech_other_tech_info]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td height="104" colspan="2" valign="middle"> <div align="left"><strong><font size="+1">You're 
          halfway through with this page! You may want to click the &quot;Save&quot; 
          button at the bottom of the page, just in case.</font></strong></div></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Set-up (what needs to be preset 
          onstage before your entrance; Ex: &quot;one chair downstage right&quot;):</div></td>
      <td width="404"><textarea name="form_group_tech_setup_needs" cols="60" rows="4" id="form_group_tech_setup_needs"><?php echo $tabledata[group_tech_setup_needs]; ?></textarea> 
      </td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Estimated set-up time: </div></td>
      <td><input name="form_group_tech_setup_time" type="text" id="form_group_tech_setup_time" size=60 value="<?php echo $tabledata[group_tech_setup_time]; ?>"></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Pick-up/breakdown needs (please 
          include all props and costume pieces that the stagehands need to clear 
          at the end of your act):</div></td>
      <td><textarea name="form_group_tech_breakdown_needs" cols="60" rows="4" id="form_group_tech_breakdown_needs"><?php echo $tabledata[group_tech_breakdown_needs]; ?></textarea></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Estimated break-down time: </div></td>
      <td><input name="form_group_tech_breakdown_time" type="text" id="form_group_tech_breakdown_time" size=60 value="<?php echo $tabledata[group_tech_breakdown_time]; ?>"></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Sound Cue (EX: &quot;After introduction;&quot; 
          &quot;Performer in place onstage;&quot; etc.):</div></td>
      <td><textarea name="form_group_tech_sound_cue" cols="60" rows="4" id="form_group_tech_sound_cue"><?php echo $tabledata[group_tech_sound_cue]; ?></textarea></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Do you have any microphone needs? 
          (If so, please include information about placement and stands.)</div></td>
      <td><textarea name="form_group_tech_microphone_needs" cols="60" rows="4" id="form_group_tech_microphone_needs"><?php echo $tabledata[group_tech_microphone_needs]; ?></textarea></td>
    </tr>
    <tr> 
      <td valign="middle"><div align="right" class="rulepageheaders">Please describe your lighting needs.</div></td>
      <td><textarea name="form_group_tech_lighting_needs" cols="60" rows="4" id="form_group_tech_lighting_needs"><?php echo $tabledata[group_tech_lighting_needs]; ?></textarea></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Does your act require any aerial 
          rigging? (The venue DOES allow for aerial; however, anyone 
          wishing to perform an aerial act must assume all expenses associated 
          with their rigging, and sign a waiver releasing the <?php echo $bh_name_abbrev;?>, production 
      crew, and venue from any liability relating to their act.) </div></td>
      <td><textarea name="form_group_tech_aerial_needs" cols="60" rows="4" id="form_group_tech_aerial_needs"><?php echo $tabledata[group_tech_aerial_needs]; ?></textarea></td>
    </tr>
    <tr> 
      <td valign="middle"> <div align="right" class="rulepageheaders">Please give a brief (25 words or 
          less) stage introduction, including a phonetic spelling of your group's 
          name:</div></td>
      <td><textarea name="form_group_tech_emcee_intro" cols="60" rows="4" id="form_group_tech_emcee_intro"><?php echo $tabledata[group_tech_emcee_intro]; ?></textarea> 
        <input name="form_table_id" type="hidden" id="form_table_id" value="<?php echo $table_id;?>"> 
      </td>
    </tr>
    <tr>
      <td valign="middle">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle"><div align="right" class="highlight"><strong>End of the page! Don't forget 
          to save it here:</strong></div></td>
      <td><input name="Save" type="submit" id="Save" value="Save this page"></td>
    </tr>
    <tr>
      <td valign="middle">&nbsp;</td>
      <td><font size="+1">Done on this page? <a href="../main.php">Go to main 
        dashboard</a></font></td>
    </tr>
  </table
  >
</form>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
