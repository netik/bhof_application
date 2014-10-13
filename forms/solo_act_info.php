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
	$sql="SELECT * FROM solo_act_description WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[solo_act_description_id];
		
		//-- This is a clever way to set up the HTML for the radio buttons. 
		// Hanford wrote it and can explain it to you if you don't know how to make it work on another page. :)		
		global $solo_cat_var; 
		$solo_cat_var = "isselected_solo_category_" . $tabledata[solo_category]; 
		global $$solo_cat_var; 
		$$solo_cat_var = " checked"; 
		
		global $solo_compete_pref_var; 
		$solo_compete_pref_var = "isselected_solo_compete_preference_" . $tabledata[solo_compete_preference]; 
		global $$solo_compete_pref_var; 
		$$solo_compete_pref_var = " checked"; 
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO solo_act_description (user_id, pageant_year, solo_category) VALUES ($_SESSION[user_id], '$pageant_year', 'main')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		
		// Set default radio button option
		global $isselected_solo_category_main; 
		$isselected_solo_category_main=" checked";
		
		// Set default radio button option for compete preference		
		global $isselected_solo_compete_pref_compete; 
		$isselected_solo_compete_pref_compete=" checked";
		}
					
		
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
	
	//code for repopulating radio buttons on form. Makes sure radio button doesn't reset when it shouldn't.
	
		
	//create clean versions of form variables for sql insertion
	$clean_solo_performer_name=cleanforsql($_POST[form_solo_performer_name]);
	$clean_solo_city_listed_from=cleanforsql($_POST[form_solo_city_listed_from]);
	$clean_solo_country_listed_from=cleanforsql($_POST[form_solo_country_listed_from]);
	$clean_solo_performer_website=cleanforsql($_POST[form_solo_performer_website]);
	$clean_solo_category=cleanforsql($_POST[form_solo_category]);
	$clean_solo_compete_preference=cleanforsql($_POST[form_solo_compete_preference]);
	$clean_solo_weblink_footage_of_act=cleanforsql($_POST[form_solo_weblink_footage_of_act]);
	$clean_solo_weblink_other_1=cleanforsql("question discontinued for 2014");
	$clean_solo_weblink_other_2=cleanforsql("question discontinued for 2014");
	$clean_solo_weblink_other_3=cleanforsql("question discontinued for 2014");
	$clean_solo_prev_years_applied=cleanforsql($_POST[form_solo_prev_years_applied]);
	$clean_solo_prev_years_performed=cleanforsql($_POST[form_solo_prev_years_performed]);
	$clean_solo_other_stage_names=cleanforsql($_POST[form_solo_other_stage_names]);
	$clean_solo_other_festivals_performed=cleanforsql($_POST[form_solo_other_festivals_performed]);
	$clean_solo_titles_awarded=cleanforsql($_POST[form_solo_titles_awarded]);
						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE solo_act_description SET 
	pageant_year = '$pageant_year',
	solo_performer_name = '$clean_solo_performer_name', 
	solo_city_listed_from = '$clean_solo_city_listed_from',
	solo_country_listed_from = '$clean_solo_country_listed_from',
	solo_performer_website = '$clean_solo_performer_website',
	solo_category = '$clean_solo_category',
	solo_compete_preference = '$clean_solo_compete_preference',
	solo_weblink_footage_of_act = '$clean_solo_weblink_footage_of_act',
	solo_weblink_other_1 = '$clean_solo_weblink_other_1',
	solo_weblink_other_2 = '$clean_solo_weblink_other_2',
	solo_weblink_other_3 = '$clean_solo_weblink_other_3',
	solo_prev_years_applied = '$clean_solo_prev_years_applied',
	solo_prev_years_performed = '$clean_solo_prev_years_performed',
	solo_other_stage_names = '$clean_solo_other_stage_names',
	solo_other_festivals_performed = '$clean_solo_other_festivals_performed',
	solo_titles_awarded = '$clean_solo_titles_awarded'
	WHERE solo_act_description_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "This page last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated. 
	
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 
	if (iscompleted($tabledata[solo_performer_name]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[solo_city_listed_from]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[solo_country_listed_from]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[solo_performer_website]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_weblink_footage_of_act]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_weblink_other_1]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_weblink_other_2]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_weblink_other_3]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_prev_years_applied]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_prev_years_performed]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_other_festivals_performed]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_other_stage_names]) == 0) $iscompleted = 0;	
	if (iscompleted($tabledata[solo_titles_awarded]) == 0) $iscompleted = 0;	
	setcompleted("solo_act_info", $iscompleted);  
	
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Solo Act - Basic Information</title>
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
  <h1 align="center" class="rulepageheaders"><strong><?php echo $bh_name_abbrev;?> &nbsp;<?php echo $pageant_year;?> Application</strong></h1>
  <h2 align="center" class="rulepageheaders"><strong>Solo act: basic information</strong></h2>
  <p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
  <h3><strong>Basic information about your SOLO ACT should be entered below. Notes:</strong></h3>
  <ul>
    <li><strong>Time limit:</strong> solo acts must be FOUR MINUTES or less, with a maximum of 15 
      additional seconds TOTAL before and/or after the music. (In other words-- 
      you must be on and off stage in under 4:15.) There are no exceptions to this, 
      so please make sure your music and choreography fit this limit.</li>
    <li>If any of these fields are blank, this page will show up as &quot;incomplete&quot; 
      on the main dashboard. So for any that you aren't answering, such as optional 
      ones, enter &quot;n/a&quot; in the form for &quot;Not Applicable.&quot; 
      <hr>
    </li>
  </ul>
  <form name="form1" method="post" action="">
    <table   width="871" height="1084" border="0" align="center" cellpadding="3" cellspacing="5" class="boxhighlight">
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">Your <strong>solo</strong> act - performer name with no 
          byline: </div></td>
        <td width="503"><input name="form_solo_performer_name" type="text" id="form_solo_performer_name" size=60 value="<?php echo $tabledata[solo_performer_name]; ?>" > 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="Your performer name as a soloist. Just your name! Do not include taglines or bylines here. If you have a tagline or byline, you can include it in the ''emcee intro'' part of the act description. For instance, if you are ''Serafina Sirena, the Sultry Sexy Siren of Sicily'' then here you would JUST put ''Serafina Sirena''."> 
        </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">The city where you want to be listed 
          as being from:</div></td>
        <td width="503"><input name="form_solo_city_listed_from" type="text" id="form_solo_city_listed_from2" size=60 value="<?php echo $tabledata[solo_city_listed_from]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="The city you would like to be listed as being from, as it would appear inside a printed show program. For instance, you could list 'Dallas Metroplex', or you could list 'Chicago' if you live in a suburb of Chicago. No matter what, it should give a good indication of where you are from without having to guess."></font></td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">The country where you want to be listed 
          as being from:</div></td>
        <td width="503"><input name="form_solo_country_listed_from" type="text" id="form_solo_country_listed_from2" size=60 value="<?php echo $tabledata[solo_country_listed_from]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="The country you would like to be listed as being from, as it would appear inside a printed show program."></font></td>
      </tr>
      <tr> 
        <td width="320" height="62" valign="top" class="rulepageheaders"> 
          <div align="right">Category you are applying 
            in. See <a href="../help/rules.php#categories" target="_blank">here</a> 
            for help with which to select.</div></td>
        <td width="503" valign="top">
  <label> 
    <input name="form_solo_category" type="radio" value="main" <?php echo $isselected_solo_category_main;?>>
    (female) Main Category (Reigning Queen of Burlesque</label>
  )
  <br> <label> 
      <input type="radio" name="form_solo_category" value="debut" <?php echo $isselected_solo_category_debut;?>>
      (female) Debut</label> <br> <label> 
        <input type="radio" name="form_solo_category" value="boylesque" <?php echo $isselected_solo_category_boylesque;?>>
        Boylesque</label></td>
      </tr>
      <tr> 
        <td width="320" valign="top" class="rulepageheaders"><div align="right"></div>
          <div align="right">We are planning to offer both competitive spots (for 
            a title) and noncompetitive showcase spots. Please indicate your preference:          </div>
          <div align="right"></div></td>
        <td width="503"> <label> 
          <input name="form_solo_compete_preference" type="radio" value="compete" <?php echo $isselected_solo_compete_preference_compete;?>>
          I'm ONLY interested in competing!</label> <br> <label> 
            <input type="radio" name="form_solo_compete_preference" value="showcase" <?php echo $isselected_solo_compete_preference_showcase;?>>
            I want to perform on that stage but I'm ONLY interested in a non-competitive 
            showcase spot!</label> <br> <label> 
              <input type="radio" name="form_solo_compete_preference" value="either" <?php echo $isselected_solo_compete_preference_either;?>>
              I want to perform this act in EITHER a competitive or non-competitive 
          capacity! </label> <label></label> </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">Weblink of footage of the <strong>solo</strong> act you are 
          submitting-- we highly recommend using a free URL-shortening service 
          like <a href="http://bit.ly" target="_blank">http://bit.ly</a> or <a href="http://www.tinyurl.com" target="_blank">Tinyurl.com</a>, 
          but be sure to test it first: </div></td>
        <td width="503" valign="top"> <p> 
          <input name="form_solo_weblink_footage_of_act" type="text" id="form_solo_weblink_footage_of_act2" size=70 value="<?php echo $tabledata[solo_weblink_footage_of_act]; ?>">
          <img src="../assets/help_icon_2013.png" width="18" height="18" align="top" title="Link to Youtube.com, Vimeo.com, or other video. MUST BE OF THE ACT YOU ARE SUBMITTING. It is very helpful to us if you include your performer name in the title of the video. Videos must be publicly viewable without requiring any login."> </font> 
          </p>
          <p><em>(Link must be viewable until the full lineup is published. See 
            the <a href="../help/rules.php#press" target="_blank">rules</a> for 
            more info.)</em></p></td>
      </tr>
      <tr> 
        <td height="63">&nbsp;</td>
        <td width="503" valign="bottom">&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="2"><div align="center"> 
          <p><strong>The rest of the questions on this page 
            help the Selection Team get a sense of who you are-- they see a lot 
            of applications! Answers are required, but for these, there are no 
            &quot;right&quot; or &quot;wrong&quot; answers. The actual act submitted 
            is what will be evaluated.</strong></p>
          </div></td>
      </tr>
      <tr> 
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr> 
        <td class="rulepageheaders"><div align="right">Your website (if none, please put &quot;n/a&quot;):</div></td>
        <td><input name="form_solo_performer_website" type="text" id="form_solo_performer_website2" size=70 value="<?php echo $tabledata[solo_performer_website]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="If you have a website or Facebook page, include the link here. If you don't, just put ''n/a'' and it won't count against you."> 
        </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">List any previous years that you have 
          applied, regardless of whether you were accepted or not. (Just list 
          the years only. If none, please put &quot;n/a&quot;):</div></td>
        <td width="503"> <input name="form_solo_prev_years_applied" type="text" id="form_solo_prev_years_applied2" size=60 value="<?php echo $tabledata[solo_prev_years_applied]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any previous years that you have applied, regardless of whether you were accepted. Just list the years."> </font> 
        </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">List any previous years that you have 
            <em>performed</em> at the pageant (either competitive or noncompetitive) 
          and the category, if applicable. If none, please put &quot;n/a&quot;:</div></td>
        <td width="503"> <input name="form_solo_prev_years_performed" type="text" id="form_solo_prev_years_performed2" size=60 value="<?php echo $tabledata[solo_prev_years_performed]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any previous years you have performed at the Pageant or Weekend, and in what capacity (e.g. competed for a title-- which one? Or perhaps a noncompetitive performance slot during the Weekend, such as at the pool party or opening night."> 
        </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">List any other stage names you have previously 
          used in performing. If none, please put &quot;n/a&quot;:</div></td>
        <td width="503"> <input name="form_solo_other_stage_names" type="text" id="form_solo_other_stage_names2" size=60 value="<?php echo $tabledata[solo_other_stage_names]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any other stage names you may have performed under. If you include groups, mention that. For example: ''I was previously known as Minnie Damoocher, and have performed as half of the Bedlam Bunnies.''"> 
        </td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right"></div>
          <div align="right">List any other burlesque festivals/conventions that 
            you have performed at and the year(s). If none, please put &quot;n/a&quot;:</div></td>
        <td width="503"><textarea name="form_solo_other_festivals_performed" cols="50" rows="3"  id="form_solo_other_festivals_performed2"><?php echo $tabledata[solo_other_festivals_performed]; ?></textarea> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" align="top" title="If you have performed at any other festivals, please list them and the year, and indicate whether it was as a soloist or part of a group."></td>
      </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="right">List your top 3 (if any) burlesque titles you have been 
          awarded, and what entity awarded the title. (If none, please put &quot;n/a&quot;):</div></td>
        <td width="503"> <input name="form_solo_titles_awarded" type="text" id="form_solo_titles_awarded2" size=60 value="<?php echo $tabledata[solo_titles_awarded]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="List any burlesque titles, awards, or honors you have won or received. These should be titles awarded to you by another burlesque entity, such as a Festival, and NOT a title that you have given yourself or unofficial title that others call you."> 
          <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"> 
        </td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr> 
        <td height="42"><div align="right" class="highlight"><strong>End of the page! Don't forget to save it here:</strong> </div></td>
        <td><input name="Save" type="submit" id="Save" value="Save this page"></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td><font size="+1">Done on this page? <a href="../main.php">Go to main 
          dashboard</a></font></td>
      </tr>
    </table
  >
    <div align="center"></div>
    </form>
  <p>&nbsp;</p>
  <hr>
  <p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
    for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
      criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</blockquote>
</body>
</html>
