<?php
include ("../includes/db_incl.php"); 
?>
<html>
<head>
<title><?php echo $bh_name_abbrev;?> Application System</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" href="../includes/styles.css">
<style type="text/css">
.yellow {
	color: #FF0;
}
</style>
</head>

<body>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  Instructions for completing the application  
  - <a href="judging_criteria.php">Judging 
  criteria</a> - <a href="rules.php">Rules for entry </a></font>- <a href="privacy.php">Privacy</a></p>
<hr align="center">
<h2 align="center" class="rulepageheaders"><strong>Instructions for completing the application</strong></h2>
<h3>&nbsp;</h3>
<blockquote>
  <h3 class="rulepageheaders"><strong>1. Who should complete the application: </strong></h3>
</blockquote>
<ol>
  <ul>
    <ul>
      <li>If you're interested in performing or competing at BHoF Weekend 2015, you're in the right place! <strong>If you're a Legend and are interested in performing on Legends night, you don't need to complete this application-- </strong>instead, just email the Legends team at <a href="mailto:legends@burlesquehall.com">legends@burlesquehall.com</a> and they will follow up with you. </li>
      <li> Each act or performing entity (for example, you or your group) must have 
        a Main Contact Person (&quot;MCP&quot;) with an account on this system who 
        is responsible for completing and submitting this application.</li>
      <li>Each act submitted 
        must have its own account/email address. (For instance, if you are submitting 
        a solo act and a group act, use a different email address for each.)</li>
      <li>Each act or performing entity (a soloist or group) can submit up to two
        entries. (Example: Minnie Mouse can submit a solo act by itself, a group act by itself, two solo acts, two group acts, or any combination of one or two solo/group acts.  </li>
      <li> Solo applicants must be the MCP for their solo act; but they do not have 
        to be the Main Contact Person for a group entry they are a part of. Example: 
        Minnie Mouse is applying as a solo act, and is also part of the Disney Troupe. 
        She must complete the application for her own act, but either she or Mickey 
        or any other member of the group can have an account and be the MCP for 
        the group entry.<br>
      </li>
    </ul>
  </ul>
</ol>
<blockquote>
  <h3 class="rulepageheaders"><strong>2. Completion of online entry form:</strong></h3>
</blockquote>
<ol>
  <ul>
    <ul>
      <li>The application website is not optimized for mobile. Please use a regular web browser to complete it.</li>
      <li> Complete each linked section shown on the main dashboard. </li>
      <li> You can save each page individually as you go and return later to finish 
        or edit. To see tips, hover over the help icon wherever it appears: <img src="../assets/help_icon_2013.png" alt="Like this!" width="18" height="18" title="Just like this! The tip will appear here."></li>
      <li> Be sure to save frequently, and use the &quot;log out&quot; button when 
        you are done.</li>
      <li> You can save each page in progress without filling out all the fields; 
        but to finally submit the application, all fields must be complete. The 
        chart on the main application dashboard indicates if each section is complete 
        or not. The system is designed to not allow submission of incomplete applications. 
        <ul>
          <li> Note that the chart shows each section as &quot;complete&quot; only 
            if there is information entered in all fields; it doesn't check for 
            accuracy or content of those fields.<br>
          </li>
        </ul>
      </li>
    </ul>
  </ul>
</ol>
<blockquote>
  <h3 class="rulepageheaders"><strong>3. Application fee: </strong></h3> 
  <ul>
    <ul>
      <li>There is no cost to create an account or begin an application. The only 
      fee is a $39 application fee that must be paid before you can submit a completed application. This year, we're offering a discount for early payment-- and once paid, you can still have until <?php echo $deadline_abbrev;?> to complete and submit the application:      </li>
      <ul>
          <li><span class="highlight"><strong>*Super Earlybird* - Payment before December 15, 2013</strong> </span>11:59pm PST: <strong><span class="highlight">$29; 50% refundable</span></strong> if you end up not submitting the application</li>
          <li><span class="highlight"><strong class="highlight">*Earlybird* - Payment between  December 16, 2013 and  January 15, 2014 </strong></span>11:59pm PST: <strong><span class="highlight">$29; nonrefundable</span></strong></li>
          <li><strong><span class="highlight">Payment after January 16 2014</span></strong>, 12:00am PST until application deadline: <strong><span class="highlight">$39; nonrefundable</span></strong></li>
      </ul>
      <li>One of the sections on the main application dashboard is a PayPal link 
          to pay the application fee. You can do that at any time while you are working 
          on your application. Because we have to update the &quot;paid&quot; status 
          of your application manually, it helps us if you can do this at least a 
      few days before you are ready to submit your application!</li>
      <li>The discount deadlines apply to all acts, including the second act submitted (if submitted at all). The system does not allow for an additional second-act discount beyond that.<br>
      </li>
    </ul>
  </ul>
<h3 class="rulepageheaders"><strong>4. Submission of completed application and deadline:</strong> </h3> 
  <ul>
    <ul>
      <li>Once all sections are complete (including the payment), you will be able 
        to officially submit the application electronically. The main dashboard 
        will be updated to show that your application has been submitted.</li>
      <li>The deadline for all applications is <?php echo $deadline_with_time;?>. 
        This online system will not allow submissions after that. We recommend aiming 
        to finish your application ahead of time just in case.<br>
      </li>
    </ul>
  </ul>
<h3 class="rulepageheaders"><strong>5. Notification:</strong> </h3>
  <ul>
    <ul>
      <li>Upon electronic submission of your application, you can log in to see 
        your application status. We expect that final notifications will not be 
        available until March 2014 or later (if necessary). All notifications 
        will be online via this system-- you can log into your account after that 
        date to see your status. We will announce on the Facebook page and via email to all applicants when decisions are ready.</li>
    </ul>
  </ul>
  <div align="left"> 
    <p>&nbsp;</p>
    <p><strong><font size="+1">Stuck and need help?</font></strong><font size="+1"> 
      You can email us at <?php echo $pageant_year;?>@bhofapplication.com, but please do not add this 
      address to any mailing lists. When contacting us by email, please give as 
      much detail as possible with your question, and we will do our best to get 
      back to you as quickly as possible!</font></p>
  </div>
  <ul>
  </ul>
  <hr align="center">
</blockquote>
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?>  
  Instructions for completing the application  
  - <a href="judging_criteria.php">Judging 
  criteria</a> - <a href="rules.php">Rules for entry </a></font>- <a href="privacy.php">Privacy</a></p>
</body>
</html>
