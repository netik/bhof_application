<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
include ("../includes/session_incl.php");
submitted_redirect();

//this sets radio buttons to default

function getrecord()
	{ /// this function will select a record if it exists, and if it does not exist, it will create a new one. 
	global $db; 
	global $tabledata;
	global $table_id; 
	global $pageant_year; 
	$sql="SELECT * FROM group_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[group_act_description_id];
		
		//-- This is a clever way to set up the HTML for the radio buttons. 
		// Hanford wrote it and can explain it to you if you don't know how to make it work on another page. :)		
		global $group_compete_pref_var; 
		$group_compete_pref_var = "isselected_group_compete_pref_" . $tabledata[group_compete_preference]; 
		global $$group_compete_pref_var; 
		$$group_compete_pref_var = " checked"; 
		 
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO group_act_description (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		
		// Set default radio button option		
		global $isselected_group_compete_pref_compete; 
		$isselected_group_compete_pref_compete=" checked";
		}					
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
	
		
	//create clean versions of form variables for sql insertion
	$clean_group_performer_name=cleanforsql($_POST[form_group_performer_name]);
	$clean_group_city_listed_from=cleanforsql($_POST[form_group_city_listed_from]);
	$clean_group_country_listed_from=cleanforsql($_POST[form_group_country_listed_from]);
	$clean_group_compete_preference=cleanforsql($_POST[form_group_compete_preference]);	
	$clean_group_performer_website=cleanforsql($_POST[form_group_performer_website]);
	$clean_group_weblink_footage_of_act=cleanforsql($_POST[form_group_weblink_footage_of_act]);
	$clean_group_headcount=cleanforsql($_POST[form_group_headcount]);
	$clean_group_all_performer_names=cleanforsql($_POST[form_group_all_performer_names]);
	$clean_group_weblink_other_1=cleanforsql("question discontinued for 2014");
	$clean_group_weblink_other_2=cleanforsql("question discontinued for 2014");
	$clean_group_weblink_other_3=cleanforsql("question discontinued for 2014");
	$clean_group_prev_years_applied=cleanforsql($_POST[form_group_prev_years_applied]);
	$clean_group_prev_years_performed=cleanforsql($_POST[form_group_prev_years_performed]);
	$clean_group_other_stage_names=cleanforsql("question discontinued for 2014");
	$clean_group_other_festivals_performed=cleanforsql($_POST[form_group_other_festivals_performed]);
	$clean_group_titles_awarded=cleanforsql($_POST[form_group_titles_awarded]);
						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE group_act_description SET 
	pageant_year = '$pageant_year',
	group_performer_name = '$clean_group_performer_name', 
	group_city_listed_from = '$clean_group_city_listed_from',
	group_country_listed_from = '$clean_group_country_listed_from',
	group_compete_preference = '$clean_group_compete_preference',
	group_performer_website = '$clean_group_performer_website',
	group_weblink_footage_of_act = '$clean_group_weblink_footage_of_act',
	group_headcount = '$clean_group_headcount',
	group_all_performer_names = '$clean_group_all_performer_names',
	group_weblink_other_1 = '$clean_group_weblink_other_1',
	group_weblink_other_2 = '$clean_group_weblink_other_2',
	group_weblink_other_3 = '$clean_group_weblink_other_3',
	group_prev_years_applied = '$clean_group_prev_years_applied',
	group_prev_years_performed = '$clean_group_prev_years_performed',
	group_other_stage_names = '$clean_group_other_stage_names',
	group_other_festivals_performed = '$clean_group_other_festivals_performed',
	group_titles_awarded = '$clean_group_titles_awarded'
	WHERE group_act_description_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "This page last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 
	if (iscompleted($tabledata[group_performer_name]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_city_listed_from]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_country_listed_from]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_performer_website]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_weblink_footage_of_act]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_headcount]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_all_performer_names]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_weblink_other_1]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_weblink_other_2]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_weblink_other_3]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_prev_years_applied]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_prev_years_performed]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_other_festivals_performed]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_other_stage_names]) == 0) $iscompleted = 0;	
	if (iscompleted($tabledata[group_titles_awarded]) == 0) $iscompleted = 0;	
	setcompleted("group_act_info", $iscompleted);  
	//preceding line writes the word "group_act_info" to the Completed table if it is all complete.
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Group Act - Basic Information</title>
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
<blockquote>
<h1 align="center" class="rulepageheaders"><strong><?php echo $bh_name_abbrev;?>&nbsp;<?php echo $pageant_year;?> 
  Application</strong></h1>
<h2 align="center" class="rulepageheaders"><strong>Group act: basic information</strong></h2>
<p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
<h3><strong>Information about your GROUP ACT should be entered below. Notes:</strong></h3>
<ul>
  <li><strong>Time limit:</strong> group acts must be FIVE MINUTES or less, with a maximum of 15 
    additional seconds TOTAL before and/or after the music. (In other words-- 
    you must be on and off stage in under 5:15.) There are no exceptions to this, 
    so please make sure your music and choreography fit this limit.</li>
  <li>If any of these fields are blank, this page will show up as &quot;incomplete&quot; 
    on the main dashboard. So for any that you aren't answering, such as optional 
    ones, enter &quot;n/a&quot; in the form for &quot;Not Applicable.&quot;
    <hr>
    </li>
</ul>
<form name="form1" method="post" action="">
    
      <div align="center">
        <table width="1069" height="789" border="0" cellpadding="3" cellspacing="5" class="boxhighlight">
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">Your <strong>group's</strong> 
              name (with no byline): </div></td>
            <td width="529"><input name="form_group_performer_name" type="text" id="form_group_performer_name" size=60 value="<?php echo $tabledata[group_performer_name]; ?>" > 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="Your group's name. Just your name! Do not include taglines or bylines. If you have a tagline or byline, you can include it in the ''emcee intro'' part of the act description. For example, if you are ''Serafina Sirena, the Sultry Sexy Siren of Sicily'' then here you would JUST put ''Serafina Sirena''."> 
            </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">The city where you 
              want your <strong>group</strong> to be listed as being from:</div></td>
            <td width="529"><input name="form_group_city_listed_from" type="text" id="form_group_city_listed_from" size=60 value="<?php echo $tabledata[group_city_listed_from]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="The city you would like to be listed as being from, as it would appear inside a printed show program. For instance, you could list 'Dallas Metroplex', or you could list 'Chicago' if you live in a suburb of Chicago. No matter what, it should give a good indication of where you are from without having to guess."></font></td>
          </tr>
           <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">The country where you 
              want your <strong>group</strong> to be listed as being from:</div></td>
            <td width="529"><input name="form_group_country_listed_from" type="text" id="form_group_country_listed_from" size=60 value="<?php echo $tabledata[group_country_listed_from]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="The country you would like to be listed as being from, as it would appear inside a printed show program."></font></td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">We are planning to offer 
              both competitive spots (for a title) and noncompetitive showcase spots. 
              Please indicate your preference:</div></td>
            <td width="529"><label> 
              <input name="form_group_compete_preference" type="radio" value="compete" <?php echo $isselected_group_compete_pref_compete;?>>
              We're ONLY interested in competing with this act!</label> <br> <label> 
                <input type="radio" name="form_group_compete_preference" value="showcase" <?php echo $isselected_group_compete_pref_showcase;?>>
                We want to perform on that stage but are ONLY interested in a non-competitive 
                showcase spot!</label> <br> <label> 
                  <input type="radio" name="form_group_compete_preference" value="either" <?php echo $isselected_group_compete_pref_either;?>>
                  We're interested in performing this act in EITHER a competitive or non-competitive 
              capacity! </label> </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">Weblink of footage of 
              the <strong>group</strong> act you are submitting-- we highly recommend 
              using a free URL-shortening service like <a href="http://bit.ly" target="_blank">http://bit.ly</a> 
              or <a href="http://www.tinyurl.com" target="_blank">Tinyurl.com</a>, 
              but be sure to test it first: </div></td>
            <td width="529"> <p> 
              <input name="form_group_weblink_footage_of_act" type="text" id="form_group_weblink_footage_of_act" size=70 value="<?php echo $tabledata[group_weblink_footage_of_act]; ?>">
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="Link to Youtube.com, Vimeo.com, or other video. MUST BE OF THE ACT YOU ARE SUBMITTING. It is very helpful to us if you include your performer name in the title of the video. Videos must be publicly viewable without requiring any login."> </font> 
              </p>
              <p><em>(Link must be viewable until the full lineup is published. See 
                the <a href="../help/rules.php#press" target="_blank">rules</a> for 
                more info.)</em> </p></td>
          </tr>
          <tr> 
            <td height="17" align="right" class="rulepageheaders">Total number of onstage performers in your group:</td>
            <td width="529" valign="bottom"><input name="form_group_headcount" type="text" id="form_group_headcount" size=3 maxlength=2 value="<?php echo $tabledata[group_headcount]; ?>">
            <img src="../assets/help_icon_2013.png" width="18" height="18" title="You CANNOT add more people after the application is submitted. Please see full rules for information about substituting or removing people."></td>
          </tr>
          <tr>
            <td height="17" align="right" class="rulepageheaders">Legal name and performer name (if applicable) of <strong>everyone</strong> in your group. Use this format: <em><strong>legal name (stage name)</strong></em> separated by commas. For instance: <em>Jane Smith (Tasty Horchata), Gerrit Graham (Beef Slab), and Jennifer Blaire (Animala)</em>:</td>
            <td width="529" valign="bottom"><textarea name="form_group_all_performer_names" cols="60" rows="6" id="form_group_all_performer_names"><?php echo $tabledata[group_all_performer_names]; ?></textarea>  <img src="../assets/help_icon_2013.png" alt="see description in the rules and use a serial comma" width="18" height="18" title="We need the legal name of everyone in your group. Please see the official rules for information regarding substitutions after the application is submitted. If you are listing more than two people, you should use the Oxford comma."></td>
          </tr>
          <tr> 
            <td colspan="2" align="right"><div align="center"><strong>The 
              rest of the questions on this page help the Selection Team get a sense 
              of who your group is-- they see a lot of applications! Answers are required, 
              but for these, there are no &quot;right&quot; or &quot;wrong&quot; answers. 
              The actual group act submitted is what will be evaluated.</strong></div></td>
          </tr>
          <tr> 
            <td colspan="2" align="right">&nbsp;</td>
          </tr>
          <tr> 
            <td width="294" align="right" valign="middle" class="rulepageheaders"> <div align="right">Your <strong>group's</strong> 
              website (if none, please put &quot;n/a&quot;):</div></td>
            <td width="529" valign="middle"> <input name="form_group_performer_website" type="text" id="form_group_performer_website2" size=70 value="<?php echo $tabledata[group_performer_website]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="If you have a website or Facebook page, include the link here. If you don't, just put ''n/a'' and it won't count against you."> 
            </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">List any previous years 
              that your <strong>group</strong> has applied, regardless of whether 
              you were accepted or not. (Just list the years only. If none, please 
              put &quot;n/a&quot;):</div></td>
            <td width="529" valign="bottom"> <input name="form_group_prev_years_applied" type="text" id="form_group_prev_years_applied" size=60 value="<?php echo $tabledata[group_prev_years_applied]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any previous years that you have applied, regardless of whether you were accepted. Just list the years."> </font> 
            </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">List any previous years 
              that your <strong>group</strong> has <em>performed</em> at the pageant 
              (either competitive or noncompetitive) and the category, if applicable. 
              If none, please put &quot;n/a&quot;:</div></td>
            <td width="529" valign="bottom"> <input name="form_group_prev_years_performed" type="text" id="form_group_prev_years_performed" size=60 value="<?php echo $tabledata[group_prev_years_performed]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any previous years you have performed at the Pageant or Weekend, and in what capacity (e.g. competed for a title-- which one? Or perhaps a noncompetitive performance slot during the Weekend, such as at the pool party or opening night."> 
            </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">List any other burlesque 
              festivals/conventions that your <strong>group</strong> has performed 
              at and the year(s). If none, please put &quot;n/a&quot;:</div></td>
            <td width="529" valign="bottom"> <input name="form_group_other_festivals_performed" type="text" id="form_group_other_festivals_performed2" size=60 value="<?php echo $tabledata[group_other_festivals_performed]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="If your group has performed at any other festivals, please list them and the year."> 
            </td>
          </tr>
          <tr> 
            <td width="294" align="right" class="rulepageheaders"> <div align="right">List your top 3 (if any) burlesque titles 
              your <strong>group</strong> has been awarded, and what entity awarded 
              the title. (If none, please put &quot;n/a&quot;):</div></td>
            <td width="529" valign="bottom"> <input name="form_group_titles_awarded" type="text" id="form_group_titles_awarded" size=60 value="<?php echo $tabledata[group_titles_awarded]; ?>"> 
              <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any burlesque titles, awards, or honors you have won or received. These should be titles awarded to you by another burlesque entity, such as a Festival, and NOT a title that you have given yourself or unofficial title that others call you."> 
              <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"> 
            </td>
          </tr>
          <tr> 
            <td align="right">&nbsp;</td>
            <td valign="bottom">&nbsp;</td>
          </tr>
          <tr> 
            <td align="right"><strong class="highlight">End of the page! Don't forget to save it here:</strong></td>
            <td valign="bottom"><input name="Save" type="submit" id="Save" value="Save this page"></td>
          </tr>
          <tr> 
            <td align="right">&nbsp;</td>
            <td valign="bottom"><font size="+1">Done on this page? <a href="../main.php">Go 
              to main dashboard</a></font></td>
          </tr>
          </table
  >
        </div>
        </div>
      </div>
</form>
<p></p>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
