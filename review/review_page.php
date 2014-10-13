<?php
include ("../includes/db_incl.php"); 
$db=dbconnect ();
// $sql="SELECT * FROM mainperson_contactinfo WHERE 1 ORDER BY mainperson_id DESC LIMIT 30";
if(!$_GET[id]){
	$sql="SELECT * FROM mainperson_contactinfo WHERE 1 ORDER BY mainperson_id DESC LIMIT 30";
	} else {
	$sql="SELECT * FROM mainperson_contactinfo WHERE mainperson_id=$_GET[id] ORDER BY mainperson_id DESC LIMIT 30";
	}
$r = mysql_query($sql, $db);
//the variable m contains everything for that record. Is used to access and view.
//everything inside the brackets matches my table names 1 to 1
while ($m = mysql_fetch_array($r) )  //means 'while this is returning true, do the following line'
	{
	 echo "<a href=\"?id=$m[mainperson_id]\">". $m[mainperson_legal_name]."</a>" . $m[mainperson_email]."<br>";
	//rendersummary($m); 
	}

?>

<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

</body>
</html>
