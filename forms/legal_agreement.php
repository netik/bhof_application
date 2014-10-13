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
	$sql="SELECT * FROM legal_agreement WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[legal_agreement_id];
		}
	else // else we didn't find one. So create one.
		{
		$sql="INSERT INTO legal_agreement (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		}	
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
			
	//create clean versions of form variables for sql insertion
	$clean_initials=cleanforsql($_POST[form_initials]);
						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE legal_agreement SET 
	pageant_year = '$pageant_year',
	legal_agreement_initials = '$clean_initials' 
	WHERE legal_agreement_id = $table_id AND user_id = $_SESSION[user_id]";
	

	$form_saved_confirm_msg = "Last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	$iscompleted = 1; 

	if (iscompleted($tabledata[legal_agreement_initials]) == 0) $iscompleted = 0;  
	setcompleted("legal_agreement", $iscompleted); 
	//preceding line inserts that name into the 'completed' table
	}
else // Else we didn't hit save.
	{
	// If you didn't save, we fetch the user's record so the form will be populated with it. 
	getrecord();  // Get record populates $tabledata from the database.  It also populates $table_id. 
	}


	
	
?>
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Legal agreement</title>
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
<h1 align="center"><strong><?php echo $bh_name_abbrev;?></strong> <strong> &nbsp;<?php echo $pageant_year;?> 
  Application</strong></h1>
<h2 align="center"><strong>Legal agreement </strong></h2>
<p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
<div align="center">
<div class="boxhighlight">
  <h3 align="left"><strong>In order to submit your application, you must agree to the <a href="../help/rules.php" target="_blank">complete 
    rules for entry</a>. Please initial below to indicate your agreement:</strong></h3>
  <blockquote>
    <p align="left"><font size="3"><em>As the Main Contact Person, my initials below indicate 
      my agreement in full to the following:</em></font></p>
    <div align="left">
      <ul>
        <li><font size="3"><em> I agree that I meet age requirements and agree to 
          abide by all Nevada state laws;</em></font></li>
        <li><font size="3"><em> I agree to take full responsibility for myself and 
          the act(s) I represent;</em></font></li>
        <li><em><font size="3">I agree that if offered a spot to perform in the Weekender (in any capacity) to not perform in any capacity in the Las Vegas metropolitan area for a period of ten days before the start of the Weekend and seven 
          days after the end of the Weekend; </font></em></li>
        <li><font size="3"><em> I agree to hold <?php echo $bh_name_long;?> free from 
          liability as spelled out in the complete rules for entry.</em></font></li>
        <li><em><font size="3">I agree to abide by the rest of the &quot;Complete 
          Rules for Entry&quot; for the <?php echo $pageant_year;?> Weekend.</font></em></li></ul></div></blockquote>
  <form name="form1" method="post" action="">
    <table   width="743" height="127" border="0" cellpadding="3" cellspacing="5">
      <tr> 
        <td width="277" align="right"> <div align="right">Main contact person's 
          initials:</div></td>
        <td width="73"> <input name="form_initials" type="text" id="form_initials" size=5 maxlength=5 value="<?php echo $tabledata[legal_agreement_initials]; ?>"> 
          <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"> 
        </td>
        <td width="295"><input name="Save" type="submit" id="Save" value="Save"></td>
      </tr>
      <tr>
        <td height="53" rowspan="2" align="right">&nbsp;</td>
        <td height="55" colspan="2"><font size="+1">Done on this page? <a href="../main.php">Go to main dashboard</a></font></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table
  >
  </form>
</div>
</div>
<hr>
<p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</body>
</html>
