<?php
include ("includes/db_incl.php"); 
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="includes/styles.css">
<style type="text/css">
.yellow {
	color: #FF0;
}
#apDiv1 {
	position:absolute;
	left:49px;
	top:143px;
	width:935px;
	height:328px;
	z-index:1;
}
</style>
</head>

<body>

<?php if ($_SESSION[submitted_status])
  		header ("location: /main.php"); //if session variable shows they are "submitted", takes them to Main and bypasses 3 pages of intro crap.
		?>
        
<h2 align="center" class="rulepageheaders"><strong>Welcome to the <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> application system</strong></h2>
<h2 align="center" class="rulepageheaders">Important info before you start! Page 1 of 3</h2>
<h3 align="center" class="highlight"><strong>Welcome! Please read these three pages carefully before you start!</strong></h3>
<blockquote>
  <div id="welcome_div">
    <blockquote>
      <blockquote>
        <p>This online application consists of four parts, with EVERYTHING due by electronic submission at <strong><span class="rulepageheaders"><?php echo $deadline_with_time;?> </span></strong>This year's application is a bit shorter than last year's. If you have your act and video link ready, the application can be done in less than an hour. </p>
        <p><span class="rulepageheaders"><strong>As with last year, we're offering a $10 discount on the application fee if you do parts 1 and 2 (the quick parts) early!</strong></span> We want you to spend time on the application and not rush. And also to have time to make changes if you need to. To encourage this, we're offering this discount if you do the first two parts early, which should take no more than ten minutes. Once you've paid it, you can still have until <?php echo $deadline_abbrev;?> to complete the rest of your application and fully submit it. The discount cutoff dates are December 15th (SUPER earlybird) and January 6th (regular earlybird). You'll see more info on that once you start the application.</p>
        <p>The four parts of the application are: 1) QUICK basic info (estimated 5-10 minutes); 2) Payment of application fee (3 minutes); 3) Additional info about the act (15-45 minutes); and 4) Legal agreement and online submission of the application (3 minutes). <strong class="rulepageheaders">To get the earlybird discount: just complete parts 1 and 2 early. Then you can work on the rest and submit it all by <?php echo $deadline_abbrev;?>.</strong></p>
        <p>And as before, we're planning to offer applicant-only presale tickets at the largest discount of the year, so don't miss out on your chance to get the best seats at the best price by submitting an application!      </p>
      </blockquote>
    </blockquote>
  </div>
  <div align="center">
    <blockquote>
      <blockquote>
        <p>&nbsp;</p>
        <p><strong>Got it? <a href="allapplicants.php" class="highlight">Yes, I understand about the final due date, the earlybird payment discount, and that even if I pay early I have until <?php echo $deadline_abbrev;?> to submit the application. Take me to the next page!</a></strong>      </p>
      </blockquote>
    </blockquote>
  </div>
</blockquote>
<p align="right"><a href="account/logout.php" title="log out" class="navlinks">log out</a>
</body>
</html>
