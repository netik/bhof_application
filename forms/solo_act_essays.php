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
	$sql="SELECT * FROM solo_act_essays WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[solo_act_essays_id];
		
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO solo_act_essays (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		
		}
					
		
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
	
	//code for repopulating radio buttons on form. Makes sure radio button doesn't reset when it shouldn't.
	
		
	//create clean versions of form variables for sql insertion
	$clean_solo_essay_what_does_title_mean=cleanforsql("question discontinued for 2012");
	$clean_solo_essay_how_did_you_find_out=cleanforsql("question discontinued for 2012");
	$clean_solo_essay_favorite_thing=cleanforsql($_POST[form_solo_essay_favorite_thing]);
	$clean_solo_essay_how_long_performer=cleanforsql($_POST[form_solo_essay_how_long_performer]);
	$clean_solo_essay_where_do_you_perform=cleanforsql("question discontinued for 2012");
	$clean_solo_essay_inspirations=cleanforsql("question discontinued for 2012");
	$clean_solo_essay_your_style=cleanforsql($_POST[form_solo_essay_your_style]);
	$clean_solo_essay_why_act_unique=cleanforsql($_POST[form_solo_essay_why_act_unique]);
	$clean_solo_essay_career_highlight=cleanforsql("question discontinued for 2014");
	$clean_solo_essay_vanilla_life=cleanforsql($_POST[form_solo_essay_vanilla_life]);
	$clean_solo_essay_additional_comments=cleanforsql($_POST[form_solo_essay_additional_comments]);

						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE solo_act_essays SET 
	pageant_year = '$pageant_year',
	solo_essay_what_does_title_mean = '$clean_solo_essay_what_does_title_mean', 
	solo_essay_how_did_you_find_out = '$clean_solo_essay_how_did_you_find_out',
	solo_essay_favorite_thing = '$clean_solo_essay_favorite_thing',
	solo_essay_how_long_performer = '$clean_solo_essay_how_long_performer',
	solo_essay_where_do_you_perform = '$clean_solo_essay_where_do_you_perform',
	solo_essay_inspirations = '$clean_solo_essay_inspirations',
	solo_essay_your_style = '$clean_solo_essay_your_style',
	solo_essay_why_act_unique = '$clean_solo_essay_why_act_unique',
	solo_essay_career_highlight = '$clean_solo_essay_career_highlight',
	solo_essay_vanilla_life = '$clean_solo_essay_vanilla_life',
	solo_essay_additional_comments = '$clean_solo_essay_additional_comments'
	WHERE solo_act_essays_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "This page last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 
	if (iscompleted($tabledata[solo_essay_what_does_title_mean]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[solo_essay_how_did_you_find_out]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[solo_essay_favorite_thing]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_how_long_performer]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_where_do_you_perform]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_inspirations]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_your_style]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_why_act_unique]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_career_highlight]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_vanilla_life]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[solo_essay_additional_comments]) == 0) $iscompleted = 0;		
	setcompleted("solo_act_essays", $iscompleted);  
	//preceding line writes "solo_act_essays" to Completed table if everything is complete.
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Solo Act - Short answers</title>
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
<h2 align="center"><strong>Solo act: short answers</strong></h2>
<p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
<h3><strong>Short answers about your SOLO ACT should be entered below. Notes:</strong></h3>
<ul>
  <li><strong>If you are <em>not</em> applying with a solo act,</strong> you can 
    disregard this page and <a href="../main.php">go to main dashboard.</a></li>
  <li>If any of these fields are blank, this page will show up as &quot;incomplete&quot; 
    on the main dashboard.</li>
  <li>These questions (and your answers) are to help the selection team get a 
    feel for you; <strong>there are no &quot;right&quot; answers.</strong> (For instance, if you 
    are a fairly new performer, saying so in the &quot;how long have you been 
    performing&quot; question won't count against you. We just want to know about 
    you! <strong>Your actual act being submitted is what will be evaluated.</strong>)
    <hr>
  </li>
</ul>
<form name="form1" method="post" action="">
    <div align="center">
    <div class="boxhighlight" width="1100">
      <table  width="1100" height="46" border="0" cellpadding="3" cellspacing="5" align="center">
        <tr> 
          <td width="315"><div align="left"> <strong><span class="rulepageheaders">Have you previously been to the <?php echo $bh_name_abbrev;?> 
            Weekend? If so, what is your favorite memory? If you haven't yet attended, 
            what are you most excited about seeing? <em>(1 to 4 sentences)</em></span></strong></div>
          </td>
          <td width="758"> </font> <textarea name="form_solo_essay_favorite_thing" cols="60" rows="4"  id="form_solo_essay_favorite_thing"><?php echo $tabledata[solo_essay_favorite_thing]; ?></textarea> </font> 
          </td>
        </tr>
        <tr> 
          <td width="315"><div align="left" class="rulepageheaders"><strong>How long have you been a performer? How 
            long have you been a burlesque performer? Where do you perform? <em>(1 
              to 4 sentences)</em></strong></div>
            <div align="left"></div>
            </td>
          <td width="758"><textarea name="form_solo_essay_how_long_performer" cols="60" rows="4" id="form_solo_essay_how_long_performer"><?php echo $tabledata[solo_essay_how_long_performer]; ?></textarea> 
          </td>
        </tr>
        <tr> 
          <td width="315">
            <strong><span class="rulepageheaders">How would you describe your performance style?<em> (1-4 sentences)</em></span></strong></td>
          <td width="758"> <textarea name="form_solo_essay_your_style" cols="60" rows="4" id="form_solo_essay_your_style"><?php echo $tabledata[solo_essay_your_style]; ?></textarea> 
          </td>
        </tr>
        <tr> 
          <td width="315"><div align="left" class="rulepageheaders"><strong>What makes the act you want to bring to 
          Las Vegas unique?<em> (1-4 sentences)</em></strong></div></td>
          <td width="758"> <textarea name="form_solo_essay_why_act_unique" cols="60" rows="4" id="form_solo_essay_why_act_unique"><?php echo $tabledata[solo_essay_why_act_unique]; ?></textarea> 
          </td>
        </tr>
        <tr> 
          <td width="315"><div align="left" class="rulepageheaders"><strong>What do you do when you're not performing?<em> 
          (up to a few sentences)</em></strong><em></em></div></td>
          <td width="758"> <textarea name="form_solo_essay_vanilla_life" cols="60" rows="4" id="form_solo_essay_vanilla_life"><?php echo $tabledata[solo_essay_vanilla_life]; ?></textarea> 
          </td>
        </tr>
        <tr> 
          <td width="315"><div align="left" class="rulepageheaders"><strong>Any additional comments, thoughts, or 
            suggestions?<em> (This question is optional; if none, please put &quot;n/a&quot;. 
          You can answer up to a few sentences.)</em></strong><em></em></div></td>
          <td width="758"> <textarea name="form_solo_essay_additional_comments" cols="60" rows="4" id="form_solo_essay_additional_comments"><?php echo $tabledata[solo_essay_additional_comments]; ?></textarea> 
            <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"> 
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td><div align="right" class="highlight"><strong>End of the page! Don't forget to save it 
          here! </strong></div></td>
          <td><input name="Save" type="submit" id="Save" value="Save this page"></td>
        </tr>
        <tr> 
          <td rowspan="2">&nbsp;</td>
          <td><font size="+1">Done on this page? <a href="../main.php">Go to main 
            dashboard</a></font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table
  >
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
