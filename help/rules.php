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
<p align="center"><font size="-1">
    <?php $current_ts = time(); //checks to see if app is launched. If it is, then it displays the main dash link. Hides it if not.
	if($current_ts > $system_launchdate)  //system_launchdate is a global variable defined in db_incl.php 
		{ ?>	
         <a href="../main.php">Main application dashboard</a> - 
		 <?php 
		}
		?> 
  <a href="instructions.php">Instructions for completing the application</a> 
  - <a href="judging_criteria.php">Judging criteria</a> - Rules for entry - <a href="privacy.php">Privacy</a></font></p>
<hr>
<blockquote>
  <blockquote>
    <h2 align="center" class="rulepageheaders">Rules &amp; how to apply</h2>
    <h3>The following are the complete rules for applying for the <?php echo $pageant_year;?> 
      Weekender. There's a lot contained here but we wanted to make sure you can find 
      a clear answer for everything!</h3>
    <h3>Quick links to content on this page:</h3>
    <p><font size="-1"> <a href="#Updates">Opening of application and rule updates</a><br>
      <a href="#requirements">Requirements, eligibility of entries, and submission 
      of materials</a><br>
      <a href="#finalauthority">Final authority and decisions</a> <br>
      <a href="#entryfee">Entry fee</a><br>
      <a href="#presales">Applicant tickets</a><br>
      <a href="#categories">Categories, time limits, props, and multiple-category applicants</a></font><br>
      <a href="#appropriateness">Appropriateness of act and act elements</a></font><br>
      <a href="#photo">Photo submissions</a><br>
      <a href="#video">Video submissions</a><br>
      <a href="#press">Optional press material, and web links and viewability of online 
      submissions</a><br>
      <a href="#noncompetitive">Non-competitive participation</a><br>
      <a href="#exclusivity">Performance exclusivity</a><br>
      <a href="#photography">Photography and videography at the event</a><br>
      <a href="#legal">Legal compliance and indemnification</a><br>
      </font></p>
    <h3 class="rulepageheaders"><strong><a name="updates" id="updates"></a>Opening of application and rule updates</strong></h3>
    <ol>
      <li>The application &quot;season&quot; and application opening are considered to begin when <?php echo $bh_name_long;?> publishes via mailing list, Facebook, or otherwise online stating that applications are now open for the year. </li>
      <li>To help applicants plan acts, we try to publish the rules as early as possible and before the application opens. We reserve the right to make unannounced rule changes at any point after this but before the applications system formally opens. </li>
      <li>Once the season begins: we will take every measure possible to avoid changing rules once the application 
        system is open. Our policy is that only &quot;critical&quot; rule changes can occur after the season opens; with &quot;critical&quot; meaning: essential to the function of the applications, evaluation system, or clarity of rules. Once the season is open, rule suggestions and non-essential changes are held for discussion for inclusion in subsequent years. If it is absolutely necessary to update the rules, we will clearly indicate in this section of the rules what changes have been made.     </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="requirements"></a>Requirements, eligibility of entries, and 
      submission of materials</strong></h3>
    <ol>
      <li><strong class="rulepageheaders">Age:</font></strong> You must be 21 years of 
        age or older (as of June 4, <?php echo $pageant_year;?>) to apply or participate. (This is also noted 
        in the Legal Compliance section.) </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Application: </strong></font>All applications 
        for the <?php echo $pageant_year;?> Weekend will be submitted online through 
        this system. All application fee payments will be through PayPal.
        <ul>
          <li>If for some reason you are unable to use this online system, a paper application 
            is available by special arrangement only. But please make every effort to 
            use this online system. Mailed applications will receive equal consideration 
            but note that any mailed application must be RECEIVED, not postmarked, by 
            the application deadline. If you wish to mail yours in, please email us 
            at 2014@bhofapplication.com to arrange this <em>in advance</em>.</li>
        </ul>
      </li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Deadline:</font></strong> The application deadline 
        is <?php echo $deadline_with_time;?>. The online application system will 
        not allow applications to be submitted or updated after that time. </li>
      <li><strong class="rulepageheaders">Performance dates and your own availability:</font></strong> 
        The <?php echo $pageant_year;?> Weekend will take place over four nights-- Thursday June 5 through 
        Sunday June 8, <?php echo $pageant_year;?>. Which events occur on which nights are subject to change 
        between now and when we notify you of your application decision. If you are 
        accepted to perform during the Weekend, your acceptance message will indicate 
        which night's show you will be performing in. If you are unable to attend 
        on your specific night, your spot cannot be switched for another night and 
        you may be asked to forfeit your spot.</li>
      <li><strong class="rulepageheaders">Completeness of application:</font></strong> 
        All fields in the application form are required unless otherwise indicated. 
        The online application system is designed to not allow entries that are incomplete 
        due to any blank fields; however, the online system does not check for completeness 
        of these fields. (For instance, it can check that a phone number has not been 
        entered; but it won't be able to determine if a phone number is wrong or incomplete.) 
        Please check your application for accuracy before submitting.</li>
      <li><strong class="rulepageheaders">Changes to application:</font></strong> Except 
        for updating your login information, no changes to the application can be 
        made once it is submitted.</li>
      <li><font class="rulepageheaders"><strong>Changes to tech requirements:</strong></font> 
        Once the application has been submitted, we do understand that you may need 
        to make small changes to the tech info you have provided in the application. 
        The tech info in your application will be provided to the show producers, 
        who will contact you to confirm final details (and any changes) and schedule 
        run-throughs. Small changes to tech requirements are permissible but your 
        act cannot be significantly different from how it is described in your application 
        and submitted. Final authority over changes is at the <?php echo $bh_name_abbrev;?>'s discretion.</li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Submitted materials: </font></strong>Submitted 
        materials are non-returnable and may be used for the purpose of promoting 
        <?php echo $bh_name_long;?> and the Weekend.</li>
      <li><strong class="rulepageheaders">Confirmation of application submission:</font></strong> 
        When your application is submitted, you will see a confirmation screen and 
        your status on the main application dashboard will be updated to reflect that 
        it has been received. This is your confirmation that your entry has been properly 
        submitted.</li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Timing of entries: </font></strong>All entries 
        within the open application period will receive equal evaluation. We are offering a discounted application fee for early payment, but early entries 
        will not receive special consideration for being early. Therefore, you should 
        make sure to submit the best application possible. </li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">False accounts: </font></strong>The <?php echo $bh_name_abbrev;?> 
        and Selection Team reserve the right to delete or remove from consideration 
        any application accounts that are deemed to be false, misleading, spam, or 
        otherwise not representative of an actual performer intending to submit a 
        legitimate application.</li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="finalauthority"></a>Final authority and decisions</strong></h3>
    <ol>
      <li><span class="rulepageheaders"><strong>Agreement to rules:</strong></font> </span>Electronic 
        submission of the application constitutes agreement by applicant and any participating personnel (e.g., other members of a group) to abide by all stated 
        rules and guidelines. </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Selection team and evaluation: </strong></font>To 
        ensure fairness, applications are evaluated by a multi-person Selection Team 
        using a scoring system. The <?php echo $bh_name_abbrev;?> 
        reserves the right to keep Selection Team member identities confidential to 
        ensure fairness to all. </li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Continuity and consistency of act:</font></strong> 
        If accepted into the Weekend in any capacity (competitive or noncompetitive), 
        you must perform the same act that you submitted. We understand that choreography 
        may be refined and changed slightly, but the act should not be fundamentally 
        different than originally submitted. 
        <ul>
          <li>In the event that two or more acts have the same music or are very similar, 
            the selection team reserves the right to contact those applicants about 
            performing a different act. This is the only case in which substitute acts 
            will be permitted.</li>
        </ul>
      </li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Finality of decisions:</font></strong> The 
        Selection Team's decisions are final and binding, and the Selection Team reserves 
        the right to make changes as unforeseen circumstances warrant for the final 
        production of the Weekend. (For example, in the unlikely event of an erroneous 
        notification, which this electronic system is designed to avoid, the Selection 
        Team's final decision still stands). Other changes could include, but are 
        not limited to, changes to categories or number of performance slots, changes 
        to correct any database errors, or disqualification in the event of nonadherence 
        to the application and Weekender rules.</li>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Rule modification:</font></strong> The <?php echo $bh_name_abbrev;?> 
        and Selection Team reserve the right to modify these rules as needed, but 
        will do so only if absolutely necessary once the online application is open. Any such modifications that may occur 
        during the application period will be communicated either via a message on 
        the website (highlighted on this list of rules), and/or by email to registered 
        users in the system.</li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="entryfee"></a>Entry fee</strong></h3>
    <ol>
      <li><span class="rulepageheaders"><strong>Application fee:</strong></font></span> Each act entered 
        must include a non-refundable  application fee, payable via PayPal. The 
        payment page is linked to on the main application dashboard. Payment is through 
        the PayPal system but can be made with a credit card and does not require 
        a PayPal account. The application fee is <em><strong>not</strong></em> tax-deductible.</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Deadline for application fee:</strong></font> 
        Please try to have your entry fee paid by January 26, <?php echo $pageant_year;?>-- a day before 
        the final due date of the application. This is because we need up to a day 
        or two to manually update your &quot;paid&quot; status in the system. In past years we've usually 
        had this updated within an hour or two, but please allow extra time just in 
      case. To encourage early payment, we are offering a discount on the application fee if it is paid early. Discount cutoff dates are noted clearly within the application.      </li>
      <ul>
        <li>These dates are just to get a discount on the payment-- the full application doesn't need to be submitted until the final deadline.</li>
        <li> The discount deadlines apply to all acts, including the second act submitted (if submitted at all). The system does not allow for an additional second-act discount beyond that.</li>
      </ul>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Fee credit to application: </strong></font>Please 
        note your performer/act name with your Paypal payment. </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="presales" id="presales"></a>Applicant tickets</strong></h3>
    <ol>
      <li><span class="rulepageheaders"><strong>Purchase of weekend tickets/passes:</strong><strong></strong></font></span> If 
        accepted to perform during the Weekend, Applicants receive a free General Admission pass for themself for the night of their performance only. They must still purchase tickets 
        and/or weekend passes if they plan to attend any night other than their performance 
        night. Single tickets are not tax deductible. Weekend passes are not tax deductible for regular levels (general admission/premium/VIP) but there is a &quot;VIP + donation&quot; option in which the donation portion is tax deductible.</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Applicant presale tickets: </strong></font>In 
        past years, we were able to offer discounted presale tickets for applicants. We 
        are planning to do this again for <?php echo $pageant_year;?>, but this is not guaranteed until and 
        unless we publish an announcement about it. If we are able to offer this as 
        planned, it will be available for a limited time only during February and/or March, and will only be available 
        to applicants with completed and submitted applications. One additional presale 
        ticket may be offered for each performer, but presale tickets will not be 
        otherwise available for friends/family, and we reserve the right to cancel 
        any unauthorized presale tickets. </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="categories"></a>Categories, time limits, props, and multiple-category 
      applicants </strong></h3>
    <ol>
      <li><span class="rulepageheaders"><strong>Main contact person:</font></strong></span> Each performing 
        entity (for example, you, or your group) must have a Main Contact Person (&quot;MCP&quot;) 
        with an account on this system who is responsible for completing and submitting 
        this application. 
        <ul>
          <li>Solo applicants must be the MCP for their solo act; but they do not have 
            to be the Main Contact Person for a group entry they are a part of. (Example: 
            Minnie Mouse is applying as a solo act, and is also part of the Disney Troupe. 
            She must complete the application for her own act, but either she or Mickey 
            or any other member of the group can be the MCP for the group entry.)</li>
        </ul>
      </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Application accounts:</strong></font> each act submitted must have its own 
        account/email address. (For instance, if you are submitting a solo act and 
        a group act, use a different email address for each.)</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong><font color="FFAEB9" class="highlight">*Updated for 2014* </font>Limit to entries:</strong></font> Each performing entity (a soloist or group) can submit up to two entries, per category. (Example: 
        Minnie Mouse can submit up to two  solo acts and up to two for her Disney Troupe as well; 
        but neither she nor the Disney Troupe can submit three or more acts.) </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Time 
        limit for acts:</strong></font> Solo acts must be four minutes or less; group 
        acts must be five minutes or less. For both, up to 15 extra seconds TOTAL 
        is allowable on-stage time before the music starts and/or after it stops. 
        <em><font color="ffff66" class="rulepageheaders"><strong>This amount of time-- 4:15 (solo) or 5:15 
        (group)-- is the absolute maximum amount of time you can be onstage, and it applies no matter which night you are accepted into. </strong></font></em>Prop setting or clearing by the stage crew can occur before or after this 
      as long as you are not onstage. </li>
      <li><span class="rulepageheaders"><strong>Props:</strong></span> Please avoid using props that take a significant amount of <em><font color="FFFF66" class="rulepageheaders">onstage</font></em> 
        setup/breakdown time. We really mean it! (That is, we're not so much worried 
        about props that require backstage handling, but rather if it needs a significant 
        amount of time of prep <em><font color="FFFF66" class="rulepageheaders">onstage</font></em> before 
        or after your act that would take up time that could be allotted to another 
        performer.) The show is time-budgeted down to the minute, and any excess 
        greatly adds to our showroom/labor cost.
        <ul>
          <li><span class="highlight"><strong>*New for 2014*</strong></font></span> You are responsible for all aspects of props (outside of stage handling specifically for your performance), including any and all costs. The <?php echo $bh_name_abbrev;?> will not rent any equipment on your behalf, cover any freight costs, or provide extra labor for your setup. </li>
        </ul>
      </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Male acts:</strong></font> If you are a soloist, 
        apply in the Boylesque category. If there's more than one of you, then apply 
        in the Group category. 
      </li>
      <li><strong><font color="FFAEB9" class="rulepageheaders"><span class="highlight"><strong>*Updated for 2014*</strong></span></font> Female solo acts - choosing the correct category 
        (Debut vs. Main):</font></strong> 
        <ol>
          <li>If you are applying as a solo act: 
          </li>
        </ol>
        <ul>
          <ul>
            <li>If you have <strong>previously competed as a soloist</strong> at any 
              <?php echo $bh_name_abbrev;?> or Exotic World weekend 
              from 2004-2013, then apply in the <strong>main Miss <?php echo $bh_name_abbrev;?> 
              category</strong>.</li>
            <li>If you have <strong>previously performed as a soloist in a noncompetitive 
              evening showcase from 2004-2013 or at the pool party or afterparty from 2004-2012, </strong>then apply in the <strong>main Miss <?php echo $bh_name_abbrev;?> 
              category. </strong></li>
            <li>If you have <strong>previously performed as a soloist at the 2013 pool party or  afterparty, </strong>then apply in the <strong>Best Debut category.</strong></li>
            <li>If you have <strong>previously performed/competed at the Weekend but 
              only as a member of a group</strong>, then apply in the <strong>Best Debut category.</strong></li>
            <li>If you have <strong>never previously performed/competed at the Weekend</strong>, 
              then apply in the <strong>Best Debut category.</strong></li>
          </ul>
        </ul>
      </li>
      <li><span class="rulepageheaders"><strong>Additional onstage personnel - choosing the 
        correct category (Solo vs. Group): </strong></span><strong></font></strong> 
        <ol>
          <li>For the solo categories, you cannot have any other visible onstage personnel, period. If you have any additional personnel, you must apply as a group. </li>
          <li><span class="highlight"><strong>*Updated for 2014*</strong></font></span> Groups must provide a headcount in the application as well as legal names; no additional personnel may be added to the act after it is submitted. A one-for-one substitution may be allowed by the <?php echo $bh_name_abbrev;?> if it does not change the concept of the act. All such requests will only be granted at the <?php echo $bh_name_abbrev;?>'s discretion and if the request is made in writing (email is acceptable) no later than 14 days before the performance date. If you need to reduce your group size after the application is submitted, please contact the <?php echo $bh_name_abbrev;?> to clear it.</li>
          <li>Per the &quot;final decisions&quot; section of the rules, the Selection 
            Team and the <?php echo $bh_name_abbrev;?> reserve the 
            right to recategorize acts if they deem it necessary.</li>
          <li>If your act requires a non-visible assistant, then please note it in the &quot;props&quot; 
            question on the Tech Info page. If this person's role is something that 
            one of the crew members can do, the 
            show producers reserve the right to use the crew instead. </li>
        </ol>
      </li>
    </ol>
    <h3><strong><a name="appropriateness" id="appropriateness"></a><strong class="highlight">*Updated for 2014*</strong></font> <span class="rulepageheaders">Appropriateness of acts and act elements</span></strong></h3>
    <ol>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Prohibited substances:</strong></font> Per agreement with the venue, absolutely no fire or liquid is permitted 
        in any act.</li>
      <li><strong> <font color="FFAEB9" class="rulepageheaders"><strong>Additional prohibited substances:</strong></font> Mylar confetti is prohibited.</strong> If you use it in your video, you will be required to leave it out of your final act if accepted to perform. Glitter is permitted and we will have a way of cleaning it between acts, but please be mindful of not making a mess!</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Music requirements:</strong></font> Music for acts must be pre-recorded. If you have a group number with musical instruments as an integral part of the act (and not just serving as the music for the act), the group must be able to carry their own gear on/off stage <em><strong>very</strong></em> quickly (in the allotted 15 seconds) and without needing to sound check. You may contact us ahead of time (while you're working on your application) to check if it's something permissible and that we can feasibly do.</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Originality of material:</strong></font> All acts must be your own work and artistry. We reserve the right to take punitive steps (up to and including dismissal or award revocation) if we determine an act violates this due to something such as (but not limited to) demonstrable and overwhelming similarity to a previously existing act. (And really... just remember that if you do well in the competition, the burlesque world's eyes are on you!)</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Compensation and responsibility for additional costs:</strong></font> By performing, you agree that you are donating your time and talent and will not receive any additional compensation from <?php echo $bh_name_long;?>. Additionally, you are responsible for all costs relating to performing your act during the Weekender, including but not limited to: travel and lodging; shipping of materials; etc. If your act is accepted into the Weekend and requires any &quot;special handling&quot; or gear beyond what we offer to all other applicants, you agree to bear that cost. </li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Nevada state laws:</strong></font> <?php echo $bh_name_long;?> Pageant/Weekend has adult themes and all participants must abide by all Nevada laws.</li>
      <li><strong><span class="rulepageheaders"><font color="FFAEB9" class="highlight">*Updated for 2014* </font> Limitations on full nudity and lewdness:</span></strong><span class="rulepageheaders"> </font></span> Full nudity is prohibited and coverings such as pasties and G-strings must be worn at all times. Specifically:
        <ul>
          <li>ALL performers, male and female, are required to fully cover their genitals and anus with an article of clothing while onstage.</li>
          <li>For female performers, areolas must be fully covered by pasties or clothing at all times while onstage. </li>
          <li>ANY incorporation of full nudity, dildos, vulgarity, or explicit sexual imagery 
            of any kind (real or simulated) are prohibited onstage.</li>
          <li>Failure to follow any of the above will result in immediate disqualification from the competition and removal from the show, and the performer shall be excluded from <?php echo $bh_name_long;?> performance opportunities for up to two years at the discretion of the Weekender Production Team. </li>
        </ul>
      </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="photo"></a>Photo submissions</strong></h3>
    <ol>
      <li><span class="rulepageheaders"><strong>Photo 
        submission:</strong></font></span> to make the application process quicker and easier, 
        applicants are <strong><em>not</em></strong> required 
        to submit photos at the time of applying. If you are selected to perform during 
        the <?php echo $pageant_year;?> Weekend, we will contact you several weeks beforehand to provide 
        a high-resolution photograph for use in the souvenir program.</li>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Program design and suitability of photographs:</strong></font> 
        Program designers have the final decision about use of photos in the program. 
        By submitting the application, you agree that if you are selected, you will 
        provide us with a photo that meets the following guidelines:
        <ul>
          <li>Photos submitted don't have to be professionally shot, but they will be 
            for use in the program, so they should show you at your best. </li>
          <li>Headshots are preferred. Group acts should show the entire group, not 
            just an individual performer. </li>
          <li>The picture does NOT have to depict the same act that you submit, but 
            remember that the video does have to.</li>
          <li>You should have the rights to the photo, and it <strong>must be able to be printed <em> without</em> photo credit</strong> (due to space limitations). </li>
          <li>You grant the <?php echo $bh_name_abbrev;?> permission 
            to use the photograph for its promotional purposes, indefinitely. The <?php echo $bh_name_abbrev;?> may accommodate written requests for revocation of the use of your photograph at its discretion. </li>
        </ul>
      </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="video"></a>Video submissions</strong></h3>
    <ol>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Required performance footage:</strong></font> 
        Performance footage is REQUIRED of all applicants, and must be of the specific act 
        that you are submitting for consideration. You will not be evaluated on the 
        production quality of your video (sound, lighting, editing, etc.), but the 
        content of the video is essential and should still be representative of you and your talent, 
      and what makes your act special.       </li>
      <ul>
        <li><span class="highlight"><strong>Pro tip</strong>:</span> As described above, you will not be evaluated on production quality, but you should make sure it meets basic reasonable watchability standards. (e.g., that you are even visible, or that it's not shot in portrait mode.) Both the video and application represent you, and the video is the Selection Team's primary way of getting a feel for your act. Please take your time making both as indicative of your personality and talent as possible. </li>
      </ul>
      <li><strong><font color="FFAEB9" class="rulepageheaders">Performance footage link: </font></strong>All 
        video submissions will be via an online link that is included in the application, 
        such as a YouTube <strong>(preferred)</strong> or Vimeo.com link. You may also use a linked or non-publicly-linked 
        page on a website. We strongly prefer YouTube. 
      </li>
    </ol>
    <ol>
      <ul>
        <li><span class="highlight"><strong>Pro tip</strong>:</span> If you want your video to be viewable by the selection 
          team (of course!) but not viewable or searchable by the public, most video-upload 
          sites have a setting that allows this. On YouTube, it is called &quot;viewable 
          only by people who have the URL.&quot;</li>
      </ul>
      <li><font color="FFAEB9" class="rulepageheaders"><strong>Title/description of videos:</strong></font> 
        To assist the evaluation team, you are encouraged to be descriptive with your 
        online video title, such as including your performer name in the title, or 
        using text within the video. This is not essential (and you won't be penalized 
        for not having it), but it will really help the evaluation team.</li>
      <li><strong class="rulepageheaders">Important: see &quot;viewability&quot; section 
        immediately below</font></strong> for additional information about public 
        viewability/permissions of online video.</li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="viewability"></a><span class="highlight">*Section updated for 2014* </span>Web links and 
      viewability of online submissions</strong></h3>
    <ol>
      <li><span class="highlight"><strong><font color="FFAEB9" class="highlight">*Updated for 2014* </font></strong></span><strong><font color="FFAEB9" class="rulepageheaders">Nonworking web links:</font></strong> Web links of performance footage are essential to the application process so please choose and type/copy them carefully. If a link does not work, the <?php echo $bh_name_abbrev;?> may contact you for an updated link.  This is done so at the <?php echo $bh_name_abbrev;?>'s discretion and will be accompanied with a deadline to provide a working link.      </li>
      <ul>
        <li><strong><span class="highlight">Pro tip: </span></strong><span class="highlight"></span>To reduce chance of errors resulting from long URLs, we recommend using TinyUrl.com 
          or some similar service to shorten URLs. (It is a free service that requires 
          just one click to use.) If using more than one TinyUrl in your application, 
          please double-check your application to make sure that you&#8217;ve included 
          the correct TinyUrls in the right places, and aren&#8217;t accidentally giving 
          us a link to something else!</li>
      </ul>
      <li><span class="rulepageheaders"><strong><font color="FFAEB9" class="highlight">*Updated for 2014* </font>Public viewability/availability of video</font></strong><font color="FFAEB9">:</font></span> 
        <strong>For all applicants, your online video must be viewable for the entire duration of the application 
          season (i.e., after you have submitted your application) until we have published 
        the full list of performers for <?php echo $pageant_year;?>. And for those acts offered a performance spot during the Weekend, the video must be viewable until after the Weekender is over to facilitate tech preparation.</strong> Your online video should be publicly 
        viewable without any login, password, or &#8220;friend-linked&#8221; restrictions. 
        We do understand that sometimes, material may be hosted 
        on third-party sites that require this. If this is the case, you must provide 
        a password and direct link, as Selection Committee members will NOT view pages 
        that require them to join, search, browse, upload/ download, or otherwise 
        perform extra work in order to find and view your content. 
      </li>
      
      <ul>
        <li>Note: for the sake of privacy, if you feel very strongly about requiring 
          a password to view your video, then please use the &quot;additional information&quot; 
          box to clearly indicate this and provide the password. We recommend instead 
          using the &quot;viewable only to people who have the link&quot; setting.</li>
      </ul>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="noncompetitive"></a>Non-competitive participation</strong></h3>
    <ol>
      <li>We plan to offer non-competitive performance opportunities. There is a spot 
        in the application where you can indicate your preference for this.</li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="exclusivity" id="exclusivity"></a>Performance exclusivity</strong></h3>
    <ol>
      <li>Applicants who are offered a spot to perform at the Weekend in any capacity 
        (competitive or noncompetitive) agree to not perform in any other capacity 
        in the Las Vegas metropolitan area for a period of ten days before the start 
        of the Weekend and seven days after the end of <?php echo $bh_name_long;?> 
        Pageant weekend. 
        <ul>
          <li>Exceptions to this may be granted to performers who live in the Las 
            Vegas area and are already part of an existing show, e.g. Cirque du Soleil. 
            If this applies to you, please contact us at 2014@bhofapplication.com 
            to authorize it.</li>
        </ul>
      </li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="photography" id="photography"></a><font color="FFAEB9" class="highlight">*Updated for 2014*</font> Photography and videography at the event</strong></h3>
    <ol>
      <li><strong>Personal photography: </strong>The <?php echo $bh_name_abbrev;?> does allow personal photography 
        at the Weekend; if you are selected to perform, you agree that the <?php echo $bh_name_abbrev;?> 
        is not responsible for those photographs and you release the <?php echo $bh_name_abbrev;?> 
        from any liability in how those photographs are used. </li>
      <li><strong>Videography:</strong> The <?php echo $bh_name_abbrev;?> does not allow personal videography 
        of the stage performances at the Weekend. The <?php echo $bh_name_abbrev;?> does film performances for its own archive; if you are selected to perform, you agree that:
        <ul>
          <li> the <?php echo $bh_name_abbrev;?> may use your likeness from this footage for its promotional purposes, indefinitely; and</li>
          <li>your right to perform on-site is contingent upon signing a release for this.</li>
        </ul>
      </li>
      <li><strong>3rd party videography: </strong>In some cases, the <?php echo $bh_name_abbrev;?> explicitly grants permission to third parties for limited videography (such as credentialed members of the press). Third party video teams are responsible for obtaining their own releases when applicable. Your performing at the event constitutes agreement to this and a full release of responsibility in how this footage may be used.</li>
    </ol>
    <h3 class="rulepageheaders"><strong><a name="legal"></a>Legal compliance and indemnification</strong></h3>
    <ol>
      <li>All applicants and participants must be 21 years of age or older at the time 
      of performance.</li>
      <li>All applicants and participants agree to abide by Nevada state law regarding nudity and appropriateness as described elsewhere in these rules.</li>
      <li>All participants must sign an on-site safety waiver in order to perform or compete.</li>
      <li>In applying to participate in this event, you grant <?php echo $bh_name_long;?> 
        and its assignees irrevocable permission to use your name, likeness, and performance 
        for unlimited promotional use.</li>
      <li>All participants agree to take full responsibility for themselves and the 
        act they are performing. All participants agree to hold the <?php echo $bh_name_long;?> 
        and any of its representatives blameless for any accident, injury, or loss 
        that might occur due to their participation in this event, and free from all 
        liability for accidents, injuries, or losses.</li>
    </ol>
  </blockquote>
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
   - <a href="judging_criteria.php">Judging criteria</a> - 
  Rules for entry - <a href="privacy.php">Privacy</a></font></p>
<p>&nbsp;</p>
</body>
</html>
