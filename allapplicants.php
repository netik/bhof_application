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
<h2 align="center" class="rulepageheaders">Important info before you start - page 2 of 3</h2>
<h3 align="center" class="rulepageheaders"><strong>We recommend you read the <a href="help/rules.php" target="_blank">full rules</a> and <a href="help/judging_criteria.php" target="_blank">judging criteria</a> (linked at the bottom of most pages) but here are the <span class="highlight">most essential  rules and guidelines for EVERYONE:</span></strong></h3>
<blockquote>
  <div id="welcome_div">
    <blockquote>
      <blockquote>
        <ol>
          <li><strong><span class="rulepageheaders">An online video link of THE SPECIFIC ACT YOU ARE SUBMITTING is required. Solo acts must be FOUR MINUTES OR LESS, and group acts must be FIVE MINUTES OR LESS... no exceptions.</span></strong> <strong class="highlight">We strongly encourage that you make sure your application video matches this time length. </strong>          </li>
          <ul>
            <li>If your video is longer, please indicate in the application that you will trim the act.<strong> But really... we prefer video of the final act! </strong>You will not be penalized or disqualified if the video is longer, but it will slow down our evaluation if we have to contact people to confirm that they can trim the act. See the <a href="help/rules.php" target="_blank">full rules</a> for specifics about time limits, time getting on/off stage, etc.</li>
          </ul>
          <li><strong>Absolutely <span class="highlight">NO FIRE and NO LIQUIDS</span> are allowed!!!</strong></li>
          <li><span class="rulepageheaders"><strong>Absolutely </strong></span><span class="highlight"><strong>NO MYLAR CONFETTI</strong></span><span class="rulepageheaders"><strong> is allowed!!!</strong></span> Fine glitter is allowed but <strong>strongly discouraged.</strong></li>
          <li><strong><span class="rulepageheaders">The stage surface will be the same as last year. </span></strong>We will have resin available as well as shop vacs to clean the stage between acts. </li>
          <li><strong><span class="highlight">New for this year: </span> <span class="rulepageheaders">Each solo performer or group can submit up to <em>two</em> acts.</span></strong> Each act submitted will need to have a separate account &amp; login in the application system. (For the purpose of submitting the application, duos are considered groups, although we may split them out once all the applications are in.) See the <a href="help/rules.php" target="_blank">official rules</a> for full details.</li>
          <li><strong><span class="rulepageheaders">You must perform your act to recorded music, not live.</span></strong> (Please see the rules for what to do if musical instruments are specifically part of your act.)</li>
          <li><span class="rulepageheaders"><strong>We STRONGLY discourage the use of really large props.</strong></span> They're viewed unfavorably by judges, audience, and the stage crew. Think about it from a production standpoint: every minute in the theater is costly and we have to efficiently get many people on and offstage quickly. Plus, we want to see YOU shine and be remembered for your <em>performance</em>, not your prop!</li>
          <li><strong><span class="rulepageheaders">The <?php echo $bh_name_abbrev;?> does not offer payment and you are responsible for your own expenses. </span></strong>If you are offered a spot to perform, you receive a free pass for that night only, but not for the whole Weekend. Beyond that, the <?php echo $bh_name_abbrev;?> cannot offer compensation for performing or subsidize any props, materials, or costs. You must bear all expenses, including travel and lodging. Presale Weekend passes should be available for purchase in  March. <strong>Particularly if you are a group, this could add up to be costly,</strong> so make sure to understand the costs if you apply.</li>
        </ol>
      </blockquote>
    </blockquote>
  </div>
  <div align="center">
    <blockquote>
      <blockquote>
        <p>&nbsp;</p>
        <p><strong>Got it? <a href="descriptions.php" class="highlight">Yes, I agree that my act will be WITHIN TIME LIMIT and have NO FIRE and NO LIQUIDS and NO MYLAR CONFETTI and all the other things above! Take me to the last page!</a></strong></p>
      </blockquote>
    </blockquote>
  </div>
</blockquote>
<p align="right"><a href="account/logout.php" title="log out" class="navlinks">log out</a></p>
</body>
</html>
