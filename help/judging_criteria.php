<?php
include ("../includes/db_incl.php"); 
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
</head>

<body>
<blockquote>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  <a href="instructions.php">Instructions for completing the application</a> 
    - Judging criteria - <a href="rules.php">Rules for entry</a> </font>- <a href="privacy.php">Privacy</a></p>
  <hr align="center">
  <h2 align="center" class="rulepageheaders">Judging criteria</h2>
  <h3>Last year, we published <a href="http://burlesquehall.com/2012/10/selection/" title="article about the BHOF selection process" target="_blank">an article</a> describing the selection and judging process in greater detail than previously available. The process is fairly straightforward, but you may be interested to read that! As for specific judging criteria: if you're <strong>asking yourself <em>&quot;which act(s) should I submit?&quot;,</em> here's what we're looking for:</strong></h3>
  <p><?php echo $bh_name_long;?> is dedicated to showcasing 
    the most exciting, entertaining, innovative, fun, sexy and/or hilarious burlesque 
    acts from all over the world. Those qualities in your own body of work are what 
    you should have in mind when you select the act(s) you want to submit. <span class="highlight"><strong>New for 2014</strong></span><strong>, we're allowing each soloist (or group) to apply with up to two acts. We really want to showcase a diversity of acts, and we want to re-emphasize that you don't have to be a certain style (or a certain anything) in order to perform, compete, or win a title at the Weekender. </strong></p>
  <p>Generally speaking-- we are looking for acts that are ready to dazzle on the 
    big stage. Note that &quot;ready to dazzle on the big stage&quot; has a lot 
    of latitude: we have seen videos filmed in a living room that &quot;bring it,&quot; 
    and we've also seen professionally-shot videos that weren't as dazzling. 
    It's not always easy to compare different types of acts (e.g. comedy vs. classic 
    elegance vs. high glitz) but the best acts always have that <em>special something</em>: 
    we want to see that during your time onstage, you can <em>completely own it</em>-- 
    the stage, the audience, and the entire venue. A good place to start is by asking yourself, &quot;is THIS ready for the BIG STAGE?&quot;</p>
  <p>For 2014, we are going to continue to offer options for both competitive and noncompetitive 
    spots; either way, your act should still have this &quot;special something&quot; 
    mentioned above. More on that below.</p>
  <p>Note: because we allow solo applicants to also be part of group applications, 
    it is possible that a performer will be accepted under both categories, providing 
    that both their solo act and group act do well enough in the selection 
    team's evaluation. </p>
  <h3 class="rulepageheaders"><span class="rulepageheaders"><strong>The overall evaluation</strong></span><strong>:</strong></h3>
  <blockquote>
    <p><strong><font color="FFAEB9" class="rulepageheaders">The act is what counts.</font> Because we are, 
      first and foremost, evaluating the <em>acts</em> that are being submitted, the 
      act (and video) are by far the most important part of the evaluation. </strong> 
      The short answers in the application are there to help the Selection Team get a better feel for 
      your (and/or your group's) personality and flavor but don't factor into the evaluation. (This is also indicated within the application.)  We do aim to include acts 
      from across a wide range of styles and geographical areas, providing they have 
      that &quot;special something&quot; described above. <strong><font color="FFAEB9" class="rulepageheaders">To 
        be fair to all acts submitted, special consideration is <em>not</em> granted 
        for having competed before, volunteering for the <em><?php echo $bh_name_abbrev;?></em>, 
        having a particular style or appearance, who you &quot;are&quot; in the burlesque community, whether you submitted the application earlier than anyone else, etc. We give full and equal consideration to 
        each and every act submitted, and the evaluation is strictly of the act and how the selection team perceives it will translate to the big stage.</font></strong></p>
    <p><font color="FFAEB9" class="rulepageheaders"><strong>A note about competitive vs. showcase spots for 
      2014:</strong></font> as with 2012 and 2013, we are offering the option to designate whether 
      you want to perform competitively, noncompetitively, or either. This is because 
      we understand that some performers can't justify travel expenses if they aren't 
      competing; where others want to perform on the big stage but may not be interested 
      in competing. Still others would be happy in either capacity. So we are offering 
      this option. The &quot;special something&quot; and evaluation criteria described 
      on this page will be the same for all of these; acceptance rates will depend 
      on the number of spots available and the number of applicants who designate 
      their preference for each of these broad categories.</p>
    <p><strong><span class="rulepageheaders">How acceptance into one spot affects other spots: </span></strong>if you indicate &quot;either&quot; (for competitive vs. not), you'll (of course!) receive equal consideration for both. But you can only perform the act once during the Weekend. So for instance: if your act is offered a spot in one show (e.g. competition), then you will not be offered a spot in the other (e.g., showcase). However, we do offer a few alternate spots in the event of cancellations, and so it's possible in that case to switch from one to the other. For example, it's possible to be an alternate for one night yet still be offered a spot for the other night. Or it's possible to be an alternate for one night and <em>not</em> be offered a spot for the other. Your notification will describe it in detail.</p>
    <p><strong><span class="rulepageheaders">A note about showcase theme:</span></strong> For the past three years,  our showcase theme has been &quot;Movers, Shakers, and Innovators.&quot; We reserve the right to either keep this theme or change it based on the makeup of the pool of applications. </p>
  </blockquote>
  <p><font color="FFAEB9" class="rulepageheaders"><strong>Judging criteria:</strong></font> </p>
  <blockquote>
    <p>Below 
      is an overview of  judging criteria for the <?php echo $pageant_year;?> 
      Weekend Pageant. Please refer to these guidelines when deciding which of your 
      routines you would like to bring to the Weekend. <strong>For the sake of continuity 
      (and to help you plan your act submission), these guidelines/criteria serve 
      for both the selection of performers (competitive and non-competitive) from 
      all applicants, as well as the final competitive judging during the Weekend. 
      However, the people on the Selection Team and the final Event Judges will be 
      different sets of people. </strong></p>
    <blockquote>
      <p><strong><em>Style, including but not limited to &quot;Overall 
        Glamour&quot;:</em></strong> <br>
        This applies to your overall execution, stage makeup, accessories, hair, etc. 
        <strong>Three things to note about this: </strong> </p>
      <ol>
        <li>Overall Glamour doesn&#8217;t so much demand conventional beauty, but 
          more attention to detail and general theatricality of your look. We want 
          to see your personal style shine through!</li>
        <li>Costume is very important, but it does <em>not </em>necessarily have to 
          be expensive and extravagant. The focus is on dance/performance/movement/creativity/personal 
          presence, and for this you shouldn't have to break the bank. </li>
        <li>No matter what else your act contains, it should include at least some 
          amount of clothing removal!</li>
      </ol>
      <p><strong><em>Poise, Polish and Professionalism:</em></strong> <br>
        This means smoothness of performance, including handling malfunctions or other 
        unpredictable issues. </p>
      <p><strong><em>Stage Presence, Charisma and Energy:</em></strong><br>
        Judges will be looking for your passion for the art&#8212;something that should 
        shine through in your routine, regardless of poise or polish.</p>
      <p><strong><em>Originality and Creativity:</em></strong> <br>
        Bring it on! The judges are all connoisseurs of both old and new burlesque, 
        so don&#8217;t be afraid to express yourself (within PG-13 boundaries, that 
        is).</p>
      <p><strong><em>Striptease Expertise</em></strong><em>:</em><br>
        Striptease is one of the most unique theatrical elements in burlesque. Judges 
        will consider whether the way you remove your costume pieces is well-executed-- 
        whether it is done skillfully, inventively, and with exceptional ingenuity, 
        humor, mischief, and/or sensuality.</p>
      <p><strong><em>Movement or Dance Ability:</em></strong><br>
        Not necessarily classical training, but more a pleasure to watch.</p>
      <p><strong><em>Entrance to and Exit from Stage:</em></strong><br>
        Don&#8217;t forget that first and last impressions count! Does the act feel 
        complete, from beginning to end?</p>
    </blockquote>
  </blockquote>
  <p>&nbsp;</p>
  <h3 class="rulepageheaders"><strong>Some extras:</strong></h3>
  <blockquote>
    <p><strong><em>Community Spirit and other awards:</em></strong><br>
      At the Pageant, we may award additional awards (at our discretion) such as 
      a &quot;community spirit&quot; award, &quot;most classic&quot;, &quot;most 
      comical&quot;, etc. These are additional awards on top of crowning a winner 
      in each of the four main categories. The potential of receiving these &quot;bonus&quot; 
      awards does not factor into the application evaluation; these awards are intended 
      to recognize additional excellence in an already excellent field.</p>
    <p><strong><em>Knowledge of Burlesque and <?php echo $bh_name_long;?></em></strong><em>:</em><br>
      This isn't a &quot;judging criterion&quot;, but if you win a title, you become 
      a de facto ambassador for <?php echo $bh_name_long;?> &amp; Weekender, so familiarity 
      with burlesque/burlesque history is always good. For 2014, we will continue to ask that the 
      performer crowned Reigning Queen of Burlesque either produce or host at 
      least one benefit for the BHOF, locally or nationally, within one year of 
      winning their title. There's no penalty for not doing so, but it is something 
      we hope you will consider doing during your reign.</p>
  </blockquote>
  <hr>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  <a href="instructions.php">Instructions for completing the application</a>  
      - Judging criteria - <a href="rules.php">Rules for entry 
        </a></font>- <a href="privacy.php">Privacy</a></p>
  <p>&nbsp;</p>
</blockquote>
</body>
</html>
