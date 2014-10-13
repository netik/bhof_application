<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
include ("../includes/session_incl.php");
submitted_redirect();

header('Content-Type: text/html; charset=utf-8');
$db = dbconnect(); 

$max_images = 6;

if ($_GET[delete])
	{
	$cleanid = cleanforsql($_GET[delete]);
	$sql = "DELETE FROM images WHERE user_id = $_SESSION[user_id] AND image_id = $cleanid"; 
	if(!$r = mysql_query($sql, $db)) die("Error deleting photo.");
	}

if ($_POST[Save])
	{
	// Caption loop
	
	// this loops through captions 1 thu $max_images . Fields are hardcoded to 1 thru $max_images 
	// we update the table by getting the iamge_id which is printed into the form using a hidden field. 
	// We update them all, whether they changed or not. 
	
	for ($i=0; $i<$max_images; $i++)
		{
		$caption = "caption_" . $i; 
		$imageid = "imageid_" . $i; 
		$mycaption = cleanforsql($_POST[$caption]); 
		$myid = cleanforsql($_POST[$imageid]); 
		$sql = "UPDATE images SET image_caption = '$mycaption' WHERE image_id = '$myid' AND user_id = $_SESSION[user_id]"; 
		if ($myid) // Only execute the sql if we have a valid image id 
			{
			if(!$r = mysql_query($sql, $db)) die("Error updating captions.");
			}
		}

	}
	
if ($_POST[Submit])
	{
	while(1)
		{
		$filepath = "../photos/$pageant_year/"; // filepath to the image hosted directory.
		for($i=0; $i < 10; $i++)
			{
			$iid = uniqid(""); 
			$prefix = substr($iid, 0, 8);// grab a chunk out of the middle
			$imagebase = $_SESSION[user_id] . "x" . $prefix; 
			$imagename = $imagebase . ".jpg"; 
			$thumbname = $imagebase . "-t.jpg"; 
			//echo " > ". $imagename . " < "; 
			if(!file_exists($filepath . $imagename))
				{
				$foundfile = 1; 
				break;
				}
			}

		if(!$foundfile)
			{// This is a hail-mary filename. 
			$imagebase = $userid . "x" . uniqid(""); 
			$imagename = $imagebase . ".jpg"; 
			$thumbname = $imagebase . "-t.jpg"; 
			}
		// -- the steps: 
		/*
		Check to see if they are over their image threshold
		check to make sure it's an image
		check to see if it's bigger than the maximum
			(if it is, scale it down)
		Make an icon
		save both of them
		update the database table. 
		*/
		$valid = 1; 
		$fileinfo = (getimagesize($_FILES['file']['tmp_name']));
		//print_r($fileinfo);  
		 /* output of getimagesize: 
		[0] => 506
    	[1] => 768
    	[2] => 2
    	[3] => width="506" height="768"
    	[bits] => 8
    	[channels] => 3
    	[mime] => image/jpeg
		*/
		if(!$fileinfo)
			{// Not a valid image
			$valid = 0; 
			$errormsg = "Not a valid image file. We only accept JPG files.";
			break; 
			}
		if($fileinfo[2] != 2)
			{
			// file is not a gif or jpg
			$vaild = 0;
			$errormsg = "Not a supported image file. We only accept JPG files.";  
			break;
			}	
		
		$isourcefile = $_FILES['file']['tmp_name']; 
		$isourceimg = imagecreatefromjpeg($isourcefile); 			

		$width = $fileinfo[0]; // original's width and height;  
		$height = $fileinfo[1]; 
			
		$iconWidth = 220; 
		$iconHeight = 220; 
		
		//--VV-- Code below resizes the original. We don't want to for this project, 
		// but we're going to leave this here in case we want to make a third version (medium size?)
		/*
		$maxWidth = 5000; 
		$maxHeight = 5000; 
		
		if( ($width > $maxWidth) || ($height > $maxHeight) )
			{// Scale down the original to a smaller size
			//--VV-- Calculate the new size
			if ($width > $height)
				{$iscale = $maxWidth / $width;
				$maxHeight = intval($iscale * $height); 
				}
			else
				{$iscale  = $maxHeight / $height;
				$maxWidth = intval($iscale * $width); 
				}
			//--AA-- 
			$scaledImg= imagecreatetruecolor($maxWidth, $maxHeight); // Create new image at the new size. 
			imagecopyresampled($scaledImg, $isourceimg, 0, 0, 0, 0, $maxWidth, $maxHeight, $width, $height); // Shrink the original down. 						
			imagejpeg($scaledImg, $filepath . $imagename); // Save it 
			imagedestroy($isourceimg);  // Destory the original. 
			$isourceimg = $scaledImg; // Use the scaled for the original. 
			$width = $maxWidth; 
			$height = $maxHeight; 
			}
		else
			{// use the original 
			imagejpeg($isourceimg, $filepath .  $imagename); 
			}
		*/
	
		imagejpeg($isourceimg, $filepath .  $imagename);  // Save the original to the new folder. 
			
		// --VV-- This piece of code figures out the new aspect ratio for the thumbnail:
		if ($width > $height)
			{$iscale = $iconWidth / $width;
			$iconHeight = intval($iscale * $height); 
			}
		else
			{$iscale  = $iconHeight / $height;
			$iconWidth = intval($iscale * $width); 
			}
		//--AA--
		
		$newImg = imagecreatetruecolor($iconWidth, $iconHeight);
		imagecopyresampled($newImg, $isourceimg, 0, 0, 0, 0, $iconWidth, $iconHeight, $width, $height);
		imagejpeg($newImg,  $filepath . $thumbname); 
		
		$image_name_with_year = $pageant_year . "/" . $imagename;
		$datestamp = date("Y-m-d H:i:s"); 
		$sql = "INSERT INTO images ( image_name, user_id, pageant_year) VALUES ('$image_name_with_year', $_SESSION[user_id], $pageant_year)";
	//	echo $sql . "<br><br>"; 
		if(!$r = mysql_query($sql, $db))
			{
			die("Error with database. error MP-IMG01");
			}
		
		$errormsg = "Image uploaded."; 
		break; 
		} // End while;
	}	


//--VV-- This generates HTML for captions and thumbs for all images. 
$imagetotal = 0; 
$mday = explode("-",date("H-i-s-m-d-Y")); 
$dist = mktime($mday[0], $mday[1], $mday[2], $mday[3], $mday[4]-1, $mday[5]);
$datethreshold = date("Y-m-d H:i:s",$dist);
//--AA--
$sql = "SELECT  * FROM images WHERE user_id = $_SESSION[user_id] ORDER BY image_id desc"; 
$r = mysql_query($sql, $db);
if (!r)
	{echo "db probs.";}
else
	{
	$increment = 0; // This is used for incrementing form controls on this page
	$imagecode = "";
	while($m = mysql_fetch_array($r))
		{
		//print_r($m); 
		$imagetotal = imagetotal + 1; 
		$ifile = explode(".",$m['image_name']);
		$imagecode .= "<img src=\"/photos/" . $ifile[0] . "-t." . $ifile[1] . "\" align=\"ABSMIDDLE\" border=\"0\"><br><br>\n"; 
		$imagecode .= "<input name=\"caption_$increment\" type=\"textfield\" value=\"$m[image_caption]\">";
		$imagecode .= "<input name=\"imageid_$increment\" type=\"hidden\" value=\"$m[image_id]\">";
		$imagecode .= "<a href=\"photos.php?delete=" . $m[image_id] . "\">delete this image</a>"; 
		$imagecode .="<br><br>"; 
		$increment ++; 
		}
	$total_images = $increment; 
	} 
	
if($imagetotal == 0)
	{
	$imagecode .= "<span class=\"hilite\">No pictures added yet.</span>";
	}

if ($total_images >= $max_images)
	{
	$uploader = "Maximum number of photos reached. You must delete at least one below in order to upload more."; 
	}
else
	{ // Less than max images, so render a control to upload
	$uploader = '<input name="file" type="file" class="medium" value="f:\hanford2.jpg">'; 	
	$uploader .= '<input name="Submit" type="submit" class="medium" value="Submit">';
	}

//---VV--- this checks to see if it is considered complete.
// Fetch Solo, group, or both.  
$sql = "SELECT application_solo_vs_group_pref AS type FROM user_account WHERE user_id = $_SESSION[user_id]";  //'type' eliminates need to name var everywhere on pg
$r = mysql_query($sql, $db);
$app_preference = mysql_fetch_array($r);

if ($app_preference[type] == "both")
	{ // if we're both, we need to have two images minimum.
	$completed_count = 2; 
	}
else // else we're either solo, or group. Both only need 1 photo to submit
	{ 
	$completed_count = 1; 
	}

if ($total_images >= $completed_count) // could be 1 or 2, based on their solo_vs_group setting
	{
	setcompleted("photos",1);
	}
else
	{
	setcompleted("photos",0);
	}
//--AA---  END checking to see if this section is complete.


if (!$errormsg)
	{
	$msg = "Click 'browse' and choose a file to upload, then click 'Submit'."; 
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BH <?php echo $pageant_year;?> - Photo Upload</title>
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
 <SCRIPT LANGUAGE="Javascript">
<!---this function is the alert box for the 'log out' link
function decision(message, url){
if(confirm(message)) location.href = url;
}
// --->
</SCRIPT>

<link href="tc1.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
function ClipBoard(cliptext)
	{
	holdtext.innerText = $cliptext;
	Copied = holdtext.createTextRange();
	Copied.execCommand("Copy");
	}
</SCRIPT>
<link href="../blog.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="right"><?php echo account_nav_links(); ?></div>
<h1 align="center"><font face="Arial, Helvetica, sans-serif"><strong><?php echo $bh_name_abbrev;?></strong></font><font face="Geneva, Arial, Helvetica, sans-serif"> 
  <strong> &nbsp;<?php echo $pageant_year;?> Application</strong></font></h1>
<h2 align="center"><strong><font face="Geneva, Arial, Helvetica, sans-serif">Add</font><font face="Geneva, Arial, Helvetica, sans-serif"> 
  photos </font></strong></h2>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableborder">
          <tr>
            <td>
<table width="100%"  border="0" cellspacing="1" cellpadding="4">
        <tr> 
          <td colspan="3" class="table1" scope="col"><div align="left" class="posttitle"> 
              <hr>
            </div></td>
        </tr>
        <tr> 
          <td colspan="3" class="table1" scope="col"><div align="center"> 
              <h3><font size="+1"><strong>Upload images here.</strong></font></h3>
            </div></td>
        </tr>
        <tr> 
          <td width="8%" class="table1" scope="col">&nbsp;</td>
          <td width="90%" class="table1" scope="col"><div align="left"></div>
            <ul>
              <li> 
                <h3 align="left"><em>You may include up to three photos of each 
                  act being submitted, but must include at least one. See rules 
                  for more info about photo usage.</em></h3>
              </li>
              <li> 
                <h3 align="left"><em>Images must be JPGs and should be at a resolution 
                  of AT LEAST 1024x768 and preferably higher. The uploader won't 
                  allow other file types.</em></h3>
              </li>
              <li> 
                <h3 align="left"><em>2nd and 3rd photos aren't required but they 
                  may be used at the discretion of program designers for optimal 
                  color, resolution, positioning, etc.</em></h3>
              </li>
            </ul></td>
          <td width="2%" class="table1" scope="col">&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="3" class="table2" scope="col"><div align="center"> 
              <form action="" method="post" enctype="multipart/form-data" name="form1">
                <p><?php echo $msg;?><span class=\"hilite\"><?php echo $errormsg;?></span></p>
                <p> <span class="user_account_error_msg"><?php echo $uploader; // Renders the upload control, or an error message ?></span> 
                </p>
              </form>
            </div></td>
        </tr>
        <tr> 
          <td colspan="3" class="table1" scope="col"><hr> </td>
        </tr>
        <tr> 
          <td colspan="3" class="table2" scope="col"><div align="center"> </div>
            <div align="center"> 
              <h3><font size="+1"><strong> Images uploaded for <?php echo $pageant_year;?></strong></font><strong><br>
                </strong><em>Small versions of your images are shown here.<br>
                Please give them captions with your performer or group name as 
                appropriate, and click "Save Captions." </em><br>
              </h3>
            </div>
            <p align="center"> 
            <form name="form2" method="post" action="">
              <?php echo $imagecode; ?> 
              <input type="submit" name="Save" value="Save captions">
            </form></span></p>
            </td>
        </tr>
      </table>
</td></tr></table>
<p><font size="+1">Done on this page? <a href="../main.php">Go to main dashboard</a></font></p>
<hr>
<p align="center"><font size="-1" face="Geneva, Arial, Helvetica, sans-serif"><a href="../main.php">Main 
  application dashboard</a> - <a href="../help/instructions.php">Instructions 
  for completing the application</a> - <a href="../help/judging_criteria.php">Judging 
  criteria</a> - <a href="../help/rules.php">Rules for entry</a></font></p>
<p>&nbsp;</p>
</body>
</html>
