<?php


function getrecord()
	{ //this function will populate the "solo vs. group vs. both" preference. 
	global $db; 
	global $tabledata;
	global $pageant_year; 
	$sql="SELECT * FROM user_account WHERE user_id = $_SESSION[user_id]";
	$r = mysql_query($sql, $db); // Perform the SQL command
	$tabledata = mysql_fetch_array($r);  // Fetch a record from SQL results
		//-- This is a clever way to set up the HTML for the radio buttons. 
		// Hanford wrote it and can explain it to you if you don't know how to make it work on another page. :)		
		global $app_preference_var; 
		$app_preference_var = "isselected_app_preference_" . $tabledata[application_solo_vs_group_pref]; 
		global $$app_preference_var; 
		$$app_preference_var = "checked"; 
		
		// Set default radio button option
		global $isselected_app_pref_solo; 
		$isselected_app_pref_solo="checked";			
	}
	
	
if ($_POST[Submit])
	{ // this gets called when the user saves the form. We UPDATE the record, and we then select it. 
		
	//create clean versions of form variables for sql insertion
	$clean_solo_vs_group_pref=cleanforsql($_POST[solo_vs_group_pref]);

	
	$sql="UPDATE user_account SET
	application_solo_vs_group_pref = '$clean_solo_vs_group_pref'
	WHERE user_id = $_SESSION[user_id]";
	
	$r = mysql_query($sql, $db); // Perform the SQL command
	getrecord();  // Should get the data we just updated. 	
	}
	else 
		{
		getrecord();
		}	


?>

<form name="preferences" method="post" action="">
  <table width="1025" height="105" border="1" align="center" cellpadding="3" cellspacing="3" bordercolor="" bgcolor="#e9f2f1" ">
    <tr> 
      <td width="718" height="99">
<p><font color="056fab"><strong>Please select whether this 
          application is for a solo or a group, then click &quot;Save.&quot;</strong></font>
          </p>
        <ul>
          <li><font size="-1">For each act you want to submit, use a separate account in this system.</font></li>
          <li><font  size="-1">If you need to (or accidentally) 
            change this, don't worry, you can change it back and the information will still be there!</font></li>
        </ul></td>
      <td width="132"><font color="056fab"> 
        <label> 
        <input name="solo_vs_group_pref" type="radio" value="solo" <?php echo $isselected_app_preference_solo;?>>
        solo application</label>
        <br>
        <label> 
        <input type="radio" name="solo_vs_group_pref" value="group" <?php echo $isselected_app_preference_group;?>>
        group application</label>
        <br>
        <label> </label>
        </font></td>
      <td width="123"><input type="submit" name="Submit" value="Save"> <input name="form_table_id" type="hidden" id="form_table_id2" value="<?php echo $table_id;?>"></td>
    </tr>
  </table>
  </form>

