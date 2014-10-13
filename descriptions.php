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

<h2 align="center" class="rulepageheaders"><strong>Welcome to the <?php echo $bh_name_abbrev;?> <?php echo $pageant_year;?> application system</strong></h2>
<h2 align="center" class="rulepageheaders">Important info before you start - page 3 of 3</h2>
<h3 align="center" class="highlight"><strong>And finally: here's how to categorize your act - this has slightly changed from before so please read it carefully!</strong></h3>
<blockquote>
  <div id="welcome_div">
    <blockquote>
      <blockquote>
        <ol>
          <li><span class="rulepageheaders"><strong>For all solo acts: you can have no extra visible people onstage, period.</strong></span> If your act requires anyone else with a visual presence at all... it is considered to be a group act, and you should indicate this and apply as a group. See the full rules for what to do if you require an assistant.</li>
          <li><strong class="rulepageheaders"><span class="highlight"><strong>*Updated for 2014* </strong></span>For female solo acts, here's what category to choose:</strong>
            <ul>
              <li><strong>Apply in the main Miss <?php echo $bh_name_abbrev;?> category if:</strong>
<ul>
                  <li>You have <strong>previously competed as a soloist</strong> at any <strong><?php echo $bh_name_abbrev;?></strong> or Exotic World weekend 
              from 2004-2013.</li>
                  <li>You have <strong>previously performed as a soloist in a noncompetitive 
                  spot</strong> at any Weekend from 2004-2012, or in the opening night show of 2013.</li>
                </ul>
              </li>
              <li><strong>Apply in the Best Debut category if:</strong>
                <ul>
                  <li>You have <strong>previously performed/competed at the Weekend but 
                    only as a member of a group.</strong></li>
                  <li>If you have <strong>never previously performed/competed at the Weekend</strong><strong>.</strong></li>
                  <li>You<strong> performed at the 2013 Weekend at an afterparty or pool party.</strong></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><span class="rulepageheaders"><strong>For all groups of two or more performers:</strong></span> apply as a group. The application does not have a separate category for groups of a specific size (like duos or trios); so if your act has more than one person, just use the &quot;group&quot; option and we will consider this during the evaluation. We  work to make sure to evaluate similar groups (and group sizes) against each other, and we reserve the right to recategorize acts as needed and to best suit the makeup of the applications received. </li>
        </ol>
      </blockquote>
    </blockquote>
  </div>
  <div align="center">
    <blockquote>
      <blockquote>
        <p>&nbsp;</p>
        <p><strong>Got it? <a href="main.php" class="highlight">I sure do! I understand that these 3 pages covered only the most important things and that I promise to still read the full rules! But take me to the Main Dashboard so I can get started!</a></strong> <br>
        <em>Tip: bookmark the Main Dashboard to skip this stuff in the future!</em></p>
      </blockquote>
    </blockquote>
  </div>
</blockquote>
<p align="right"><a href="account/logout.php" title="log out" class="navlinks">log out</a>
</body>
</html>
