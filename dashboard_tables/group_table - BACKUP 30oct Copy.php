 <p><strong>Use the following menu to complete your application. Click on a form 
  to go to (and/or edit) it. Need help? See the help links at the bottom of every 
  page.</strong></p>
<table width="95%" border="2" align="center" cellpadding="6" cellspacing="2" bordercolor="#999999" style="background-color:#e9f2f1">
  <tr> 
    <td colspan="2" bgcolor="#FFCCFF"><div align="center"><font color="#232929"><strong>GROUP ACT form</strong></font></div></td>
    <td width="59" bgcolor="#FFCCFF"> <div align="center"><font color="#232929"><strong>Estimated 
        time to complete</strong></font></div></td>
    <td width="59" bgcolor="#FFCCFF"><div align="center"><font color="#232929"><strong>Status</strong></font></div></td>
    <td width="500" bgcolor="#FFCCFF"><div align="left"><font color="#232929"><strong>Notes</strong></font></div></td>
  </tr>
  <tr> 
    <td width="81" rowspan="2"><div align="center"><font color="232929"><strong>Do this part FIRST!</strong></font></div></td>
    <td width="210"><font color="#781428" size="-1"><a style="color: #781428; text-decoration: underline" href="forms/main_contact_person_info.php">Main 
      Contact Person's information</a></font></td>
    <td align="center"><font color="#781428" size="-1">2 mins </font> <div align="center"></div></td>
    <td align="center"><?php echo showcompleted($completed[main_contact_person_info]);?></td>
    <td rowspan="2"><font color="#781428" size="-1">Basic info  about the Main Contact 
      Person and the act being submitted.  Please complete this before making the payment.</font></td>
  </tr>
  <tr>
    <td width="210"><a href="../forms/group_act_info.php"><font color="#781428" size="-1"><strong>Group act</strong> - basic info</font></a></td>
    <td align="center"><font color="#781428" size="-1">5-10 mins </font></td>
    <td align="center"><?php echo showcompleted($completed[group_act_info]);?></td>
  </tr>
  <tr> 
    <td><div align="center"><font color="232929"><strong>Part 2</strong></font></div></td>
    <td><font color="#781428" size="-1"><a style="color: #781428; text-decoration: underline" href="payment.php">Payment 
      of application fee</a></font></td>
    <td><div align="center"><font color="#781428" size="-1">3 mins</font></div></td>
    <td><div align="center"><?php echo showcompleted($completed[payment]);?></div></td>
    <td><p><font color="#781428" size="-1">Fee is due via credit card or PayPal account on 
        the PayPal website. <font color="#FF0000"><strong>We have to update these 
        manually so please do Part 1 FIRST, then do the 
        payment NEXT, then work on the rest of the application! Please allow up to 12 hours to see it updated here, although we try to process them a few times a day. As the deadline nears, we'll be doing them more frequently.</strong></font></font></p>
<p><strong><font color="#781428" size="-1">Payment is $29 and partially refundable if made before 11:59pm PST on December 15, 2013; then $29 and nonrefundable until 11:59pm PST on January 10, 2014; then $39 and nonrefundable until the application closes. After payment, you still have until <?php echo $deadline_with_time;?> to complete and fully submit the application.</font></strong></p></td>
  </tr>
  <tr>
    <td rowspan="2"><div align="center"><font color="232929"><strong>Part 3</strong></font></div></td> 
    <td><a href="forms/group_act_essays.php"><font color="#781428" size="-1"><strong>Group  act</strong> - short answers</font></a></td>
    <td><div align="center"><font color="#781428" size="-1">5 mins</font></div></td>
    <td align="center"><?php echo showcompleted($completed[group_act_essays]);?></td>
    <td rowspan="2"><font color="#781428" size="-1">Shortened for 2014! Additional information about your act. This part will take the longest. You can start this part at any time but we strongly recommend doing Parts 1 and 2 first!</font></td>
  </tr>
  <tr>
    <td><a href="forms/group_act_tech.php"><font color="#781428" size="-1"><strong>Group act</strong> - tech/staging info</font></a></td>
    <td><div align="center"><font color="#781428" size="-1">10-15 mins</font></div></td>
    <td align="center"><?php echo showcompleted($completed[group_act_tech]);?></td>
  </tr>
  <tr>
    <td rowspan="2"><div align="center"><font color="232929"><strong>Part 4</strong></font></div></td>
    <td><font color="#781428" size="-1"><a style="color: #781428; text-decoration: underline" href="forms/legal_agreement.php">Legal 
    agreement</a></font></td>
    <td><div align="center"><font color="#781428" size="-1">2 mins</font></div></td>
    <td align="center"><?php echo showcompleted($completed[legal_agreement]);?></td>
    <td><font color="#781428" size="-1">You must agree to this in order to submit 
    the application.</font></td>
  </tr>
  <tr>
    <td><font color="#781428" size="-1"><a style="color: #781428; text-decoration: underline" href="forms/submit_application.php">Go 
    to "Submit Application" page</a></font></td>
    <td><div align="center"><font color="#781428" size="-1">2 mins</font></div></td>
    <td><div align="center"><font color="#FF0000">not submitted</font></div></td>
    <td><font color="#781428" size="-1">Final submission must be done before the 
      deadline of <strong><?php echo $deadline_with_time;?></strong>. You will not 
      be able to submit the application until all required information and payment 
      are complete. Clicking this will take you to a page where you will officially 
    submit the application. You will also be able to print a copy on that page.</font></td>
  </tr>
</table>
