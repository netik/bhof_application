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
	$sql="SELECT * FROM mainperson_contactinfo WHERE user_id = $_SESSION[user_id] AND pageant_year = '$pageant_year'";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
	if ($tabledata)  //means "if it finds a record that matches email". This returns a record as an array.
		{
		$table_id = $tabledata[mainperson_contact_id];
		}
	else // else we didn't find one. So create one.0
		{
		$sql="INSERT INTO mainperson_contactinfo (user_id, pageant_year) VALUES ($_SESSION[user_id], '$pageant_year')"; 
		$r = mysql_query($sql, $db); // Perform the SQL command
		$table_id = mysql_insert_id(); 
		}	
	}
	
	
if ($_POST[Save])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
			
	//create clean versions of form variables for sql insertion
	$clean_mainperson_legal_name=cleanforsql($_POST[form_mainperson_legal_name]);
	$clean_mainperson_street_address=cleanforsql($_POST[form_mainperson_street_address]);
	$clean_mainperson_phone_day=cleanforsql($_POST[form_mainperson_phone_day]);
	$clean_mainperson_phone_eve=cleanforsql($_POST[form_mainperson_phone_eve]);
						
	if(!$_POST[form_table_id]) // Just in case the form didn't include the table ID. 
		{getrecord();
		$_POST[form_table_id] = $table_id; 
		}
	
	// Get the table ID from the form. 
	$table_id = cleanforsql($_POST[form_table_id]); // It came from the form, so we should clean it
	
	$sql="UPDATE mainperson_contactinfo SET 
	pageant_year = '$pageant_year',
	mainperson_legal_name = '$clean_mainperson_legal_name', 
	mainperson_street_address = '$clean_mainperson_street_address',
	mainperson_phone_day = '$clean_mainperson_phone_day',
	mainperson_phone_eve = '$clean_mainperson_phone_eve'
	WHERE mainperson_contact_id = $table_id AND user_id = $_SESSION[user_id]";
	
	$form_saved_confirm_msg = "Last saved: " . date("F d, Y, H:i:s:a", time());
	$r = mysql_query($sql, $db); // Perform the SQL command

	getrecord();  // Should get the data we just updated.  
	
	//------ Next few lines check for completeness of entire form; if it's complete, it updates the "completed" table to show this. 
	
	$iscompleted = 1; 

	if (iscompleted($tabledata[mainperson_legal_name]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[mainperson_street_address]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[mainperson_phone_day]) == 0) $iscompleted = 0; 
	if (iscompleted($tabledata[mainperson_phone_eve]) == 0) $iscompleted = 0; 
	//to propagate to other pages, copy these 7 lines, fix variables, and change table name
	setcompleted("main_contact_person_info", $iscompleted); 
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
<title>BH <?php echo $pageant_year;?> - Main person contact info</title>
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
  <h1 align="center" class="rulepageheaders"><font face="Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?></strong></font><font face="Geneva, Arial, Helvetica, sans-serif"> 
    <strong> &nbsp;<?php echo $pageant_year;?> Application</strong></font></h1>
  <h2 align="center" class="rulepageheaders"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Main 
    contact person details</font></strong></h2>
  <p><span class="user_account_error_msg"><?php echo $form_saved_confirm_msg; ?></span></p>
  <p align="center"><font face="Geneva, Arial, Helvetica, sans-serif"><strong>Information about 
    the MAIN CONTACT PERSON of your act. This is so that we can contact you if 
    we need to.</strong></font></p>
</blockquote>
  <div align="center">
<form action="" method="post" name="form1" class="boxhighlight">
    <table width="776" height="393" border="0" align="center" cellpadding="3" cellspacing="5">
      <tr> 
        <td width="264" height="46" align="right"><div align="right"><font face="Geneva, Arial, Helvetica, sans-serif" class="rulepageheaders"><strong>Main Contact Person's legal name as it would appear on an ID:</strong></font></div></td>
        <td width="431"><font face="Geneva, Arial, Helvetica, sans-serif">
          <input name="form_mainperson_legal_name" type="text" id="form_mainperson_legal_name" size=50 maxlength=40 value="<?php echo $tabledata[mainperson_legal_name]; ?>">
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="Your legal name, as it would appear on a government ID."> 
          </font></td>
      </tr>
      <tr> 
        <td width="264"><div align="right" class="rulepageheaders"><strong>Primary contact's email address:</strong></div></td>
        <td width="431"> <em>(note that this cannot be changed on this page. We 
            will use the email address that you log in with. To change your login 
          information, go <a href="../account/account_info.php">here</a>.</em></td>
      </tr>
      <tr> 
        <td width="264" align="center"> <div align="right" class="rulepageheaders"><strong>Primary contact's full 
          mailing address:</strong></div></td>
        <td width="431"> <label> 
            <textarea name="form_mainperson_street_address" cols="40" rows="4" id="form_mainperson_street_address"><?php echo $tabledata[mainperson_street_address]; ?></textarea>
            <img src="../assets/help_icon_2013.png" width="18" height="18" title="Your complete mailing address."> 
          </label></td>
      </tr>
      <tr> 
        <td width="264"><div align="right" class="rulepageheaders"><strong>Primary contact's daytime phone number:</strong></div></td>
        <td width="431"> <input name="form_mainperson_phone_day" type="text" id="form_mainperson_phone_day" size=40 maxlength=20 value="<?php echo $tabledata[mainperson_phone_day]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="Phone number you can be reached at during the day. Don't forget area code and country code if necessary."> 
        </td>
      </tr>
      <tr> 
        <td width="264"><div align="right" class="rulepageheaders"><strong>Primary contact's evening phone number:</strong></div></td>
        <td width="431"> <input name="form_mainperson_phone_eve" type="text" id="form_mainperson_phone_eve" size=40 maxlength=20 value="<?php echo $tabledata[mainperson_phone_eve]; ?>"> 
          <img src="../assets/help_icon_2013.png" width="18" height="18" title="Phone number you can be reached at in the evening."> 
          <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"> 
        </td>
      </tr>
      <tr> 
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr> 
        <td height="32"> 
          <div align="right" class="highlight"><strong>End of the page! Don't forget 
        to save it here: </strong> </div></td>
        <td height="32"> 
          <input name="Save" type="submit" id="Save" value="Save this page!"></td>
      </tr>
      <tr> 
        <td height="38"> <div align="center"></div></td>
        <td height="38"><font size="+1">Done on this page? <a href="../main.php">Go 
          to main dashboard</a></font></td>
      </tr>
    </table>
    <blockquote>&nbsp;</blockquote>
</form>

<blockquote>
  <p><font face="Geneva, Arial, Helvetica, sans-serif"> </font></p>
  <hr>
  <p align="center"><font size="-1"><a href="../main.php">Main dashboard</a> - <a href="../help/instructions.php">Instructions 
    for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
      criteria</a> - <a href="../help/rules.php">Rules for entry</a> - <a href="../help/privacy.php">Privacy</a></font></p>
</blockquote>
</body>
</html>
