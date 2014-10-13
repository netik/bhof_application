<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
include ("../includes/session_incl.php");
submitted_redirect();

function getrecord()
//this sets radio buttons to default 
	{ /// this function will select a record if it exists, and if it does not exist, it will create a new one. 
	global $db;
	global $tabledata;
	global $table_id; 
	global $pageant_year; 
	$sql="SELECT * FROM group_act_essays WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[group_act_essays_id];
		
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO group_act_essays (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		
		}
					
		
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
	
	//code for repopulating radio buttons on form. Makes sure radio button doesn't reset when it shouldn't.
	
		
	//create clean versions of form variables for sql insertion
	$clean_group_essay_what_brings_you_here=cleanforsql("question discontinued for 2014");
	$clean_group_essay_how_did_you_find_out=cleanforsql("question discontinued for 2012");
	$clean_group_essay_how_long_performer=cleanforsql($_POST[form_group_essay_how_long_performer]);
	$clean_group_essay_where_do_you_perform=cleanforsql("question discontinued for 2012");
	$clean_group_essay_inspirations=cleanforsql("question discontinued for 2012");
	$clean_group_essay_your_style=cleanforsql($_POST[form_group_essay_your_style]);
	$clean_group_essay_why_act_unique=cleanforsql($_POST[form_group_essay_why_act_unique]);
	$clean_group_essay_career_highlight=cleanforsql("question discontinued for 2014");
	$clean_group_essay_additional_comments=cleanforsql($_POST[form_group_essay_additional_comments]);

						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE group_act_essays SET 
	pageant_year = '$pageant_year',
	group_essay_what_brings_you_here = '$clean_group_essay_what_brings_you_here', 
	group_essay_how_did_you_find_out = '$clean_group_essay_how_did_you_find_out',
	group_essay_how_long_performer = '$clean_group_essay_how_long_performer',
	group_essay_where_do_you_perform = '$clean_group_essay_where_do_you_perform',
	group_essay_inspirations = '$clean_group_essay_inspirations',
	group_essay_your_style = '$clean_group_essay_your_style',
	group_essay_why_act_unique = '$clean_group_essay_why_act_unique',
	group_essay_career_highlight = '$clean_group_essay_career_highlight',
	group_essay_additional_comments = '$clean_group_essay_additional_comments'
	WHERE group_act_essays_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "This page last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 
	if (iscompleted($tabledata[group_essay_what_brings_you_here]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_essay_how_did_you_find_out]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[group_essay_how_long_performer]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_where_do_you_perform]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_inspirations]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_your_style]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_why_act_unique]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_career_highlight]) == 0) $iscompleted = 0;
	if (iscompleted($tabledata[group_essay_additional_comments]) == 0) $iscompleted = 0;		
	setcompleted("group_act_essays", $iscompleted);  
	//preceding line writes "group_act_essays" to Completed table if everything is complete.
	
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Group Act - Short answers</title>
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
<h2 align="center"><strong>Group act: short answers</strong></h2>
<p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
<blockquote>
  <h3><strong>Short answers about your GROUP ACT should be entered below. Notes:</strong></h3>
  <ul>
    <li>If any of these fields are blank, this page will show up as &quot;incomplete&quot; 
      on the main dashboard.</li>
    <li>These questions (and your answers) are to help the selection team get a 
      feel for your group; there are no &quot;right&quot; or &quot;wrong&quot; answers. (For instance, 
      if your group is fairly new, saying so in the &quot;how long have you been 
      performing&quot; question won't count against you. We just want to know about 
      you! <strong>Your actual act being submitted is what will be evaluated.</strong>)
      <hr>
      </li>
  </ul>

</blockquote>
<form action="" method="post" name="form1">
  <div align="center">
  <div class="boxhighlight" width="1100">
    <table   width="1002" height="46" border="0" align="center" cellpadding="3" cellspacing="5">
      <tr> 
        <td width="320"><div align="left" class="rulepageheaders">
          <div align="right">How long has your <strong>group</strong> been performing? 
            Where do you perform at? <em>(2 to 4 sentences)</em></div>
        </div></td>
        <td width="655"><textarea name="form_group_essay_how_long_performer" cols="60" rows="4" id="form_group_essay_how_long_performer"><?php echo $tabledata[group_essay_how_long_performer]; ?></textarea> 
          </td>
        </tr>
      <tr> 
        <td width="320" class="rulepageheaders"><div align="left"></div>
          <div align="right">How would you describe your <strong>group's</strong> performance style?<em> (1-4 sentences)</em></div></td>
        <td> <textarea name="form_group_essay_your_style" cols="60" rows="4" id="form_group_essay_your_style"><?php echo $tabledata[group_essay_your_style]; ?></textarea> 
          </td>
        </tr>
      <tr> 
        <td width="320"><div align="left" class="rulepageheaders">
          <div align="right">What makes the act your <strong>group</strong> wants to 
            bring to Las Vegas unique?<em> (1-4 sentences)</em></div>
        </div></td>
        <td> <textarea name="form_group_essay_why_act_unique" cols="60" rows="4" id="form_group_essay_why_act_unique"><?php echo $tabledata[group_essay_why_act_unique]; ?></textarea> 
          </td>
        </tr>
      <tr> 
        <td width="320"><div align="left" class="rulepageheaders">
          <div align="right">Any additional comments, thoughts, or 
            suggestions?<em> (This question is optional; if none, please put &quot;n/a&quot;. 
              You can answer up to a few sentences.)</em></div>
        </div></td>
        <td> <textarea name="form_group_essay_additional_comments" cols="60" rows="4" id="form_group_essay_additional_comments"><?php echo $tabledata[group_essay_additional_comments]; ?></textarea> 
          <input name="form_table_id" type="hidden" id="form_table_id" value="<?php echo $table_id;?>"> 
          </td>
        </tr>
      <tr> 
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr> 
        <td><div align="right" class="highlight"><strong>End of the page! Don't forget to save it 
          here:</strong></div></td>
        <td><input name="Save" type="submit" id="Save" value="Save this page"></td>
        </tr>
      <tr> 
        <td>&nbsp;</td>
        <td><font size="+1">Done on this page? <a href="../main.php">Go to main 
          dashboard</a></font></td>
        </tr>
      </table
  >
    
  </div>
</form>
<hr align="center">
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
