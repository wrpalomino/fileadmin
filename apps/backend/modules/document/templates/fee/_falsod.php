<?php
  $helper->show_xtra_field = false;
  if (empty($helper->field1_text)) $helper->field1_text = '_______';

  if (!isset($helper->professional_fees))
    $helper->professional_fees = "<h3>3. <span class='underline'>Professional fees</span></h3>
  We will charge you a lump sum fee of $ ".$form['field12']->renderRow()."<br/>
  You will also have to pay GST of $ ".$form['field13']->renderRow()."<br/>".$form['field17']->renderRow();
  
  if (!isset($helper->disbursements))
    $helper->disbursements = "<h3>4. <span class='underline'>Disbursements</h3>
  In addition to our professional fees, you will be required to pay for expenses we incur on your behalf 
  as your agent. These may include the costs of medical reports, interpreters fees or issuing and service fees.<br/>
  If we need to engage an expert or consultant on your behalf you will also have to pay for these costs. We 
  will confirm these fees with you before we engage those services.";  

  $helper->fee_content = "<p>Thank you for your instructions to act for you in this matter.</p>
  <p>Under the <span class='underline'>Legal Profession Act 2004</span> ('the Act') you are 
  entitled to receive certain information.</p>
  This information includes:
  <ul style='margin-right:0px;'>
  <li>You have a right to negotiate a costs agreement with us</li>
  <li>Details of fees and expenses</li>
  <li>Billing intervals and arrangements</li>
  <li>Your rights should you feel dissatisfied with our services or billing</li>
  <li>You have the right to details of any substantial changes that may affect the cost of your matter.</li>
  </ul>
  <h3>1. <span class='underline'>Costs Agreement</span></h3>
  The Act give us and you the right to make a written agreement concerning how legal costs are to 
  be calculated and paid.<br/>
  This letter sets out the terms on which we will undertake this work for you. Should this be accepted 
  by you this letter will be the Costs Agreement between us for the work we do for you.
  <h3>2. <span class='underline'>Reporting</span></h3>
  ".$form['field9']->renderRow()." of our office will primarily perform the work on your file and will keep 
  you informed about the progress of your case. Please feel free to contact us at any time.<br/>
  You should note that you are entitled to written progress reports at suitable breaks in the matter.<br/>
  If you have a particular way that you want to be provided with reports or want to receive more regular 
  reports please inform ".$form['field9']->renderRow().".<br/>
  ".$helper->professional_fees."
  ".$helper->disbursements."  
  <h3>5. <span class='underline'>Total legal costs</span></h3>
  On the basis of these estimates your total legal costs should be $ ".$form['field14']->renderRow()."<br/>
  As discussed your fees must be paid into our trust account by ".$form['field15']->renderRow()."
  <h3>6. <span class='underline'>Recovery of Costs</span></h3>
  If you successfully defend these proceedings costs may be awarded in your favour. Costs are in the discretion 
  of the court and a party has no right to costs unless and until the court awards them. You should not count on 
  costs being awarded to you.<br/>
  Please note that if the Court does order costs in your favour this only gives you a right to recover some costs 
  from the Informant. It does not affect your responsibility to pay our legal fees and legal costs.
  <h3>7. <span class='underline'>Compensation to victim orders</span></h3>
  We note that if you plead guilty to a crime where a victim may be entitled to compensation or damages, that 
  victim may make such a claim either on the day you enter your plea or at some later date. The fact of your 
  entering a plea of guilty may make it considerably easier for a victim to successfully claim against you.
  <h3>8. <span class='underline'>Disposal of files</span></h3>
  We note that we will keep your file for six years. We require your permission to destroy your file at the end 
  of that period. Given that there may be considerable difficulty locating you in six years we hereby request in 
  advance your authority to destroy your file six years after it is finalised.<br/>
  <h3>9. <span class='underline'>Accounts (Bill of Costs)</span></h3>
  We will render an account or bill of costs to you at the conclusion of each stage of your matter.<br/>
  A brief description of the work will be provided. If you require an itemized account you must request this 
  within 30 days after you receive our account or bill of costs.<br/>
  If your account is outstanding for more than 30 days we will charge you interest at a rate no greater than that 
  fixed under the Penalty Interests Rates Act 1983.
  <h3>10. <span class='underline'>Trust Money</span></h3>
  When we receive money on your behalf we will deposit the money into our trust account. We will deduct our costs 
  and any disbursements from this money where we have already given you an account or bill of costs.<br/>
  We will ask that you pay us an amount to provide security for professional fees and that amount is indicated 
  at point 5 of this letter. We will hold these monies in our trust account and will, once we render your account 
  or bill of costs to you, then deduct money from our trust account to pay our fees, any disbursements and GST.<br/>
  By signing this letter you give us permission to do this.
  <h3>11. <span class='underline'>Rights</span></h3>
  If you have any concerns about our fees, services or this letter please raise them with us. In the event that 
  we can not resolve the enquiry to your satisfaction then you may take any of the following actions;
  *Seek a costs review by the Taxing Master under Division 7 of Part 3.4 of the Legal Profession Act 2004 ('the Act') within 60 days after the bill 
  is given to you or the law practice requests payment of costs or you pay the costs (whichever is earlier or earliest).
  *You may seek a costs review outside the 60 day time limit. In these circumstances the Taxing Master will not 
  deal with the review if we can establish that to do so would, in all the circumstances, cause unfair prejudice 
  to us;<br/>
  *Apply to VCAT to set aside this agreement under section 3.4.32 of the Act; or<br/>
  *Make a complaint to the Legal Services Commissioner under chapter 4 of the Act within 60 days after the legal 
  costs were payable or, if an itemised bill was requested in respect of those costs, within 30 days after the 
  request was complied with.<br/>
  *You may be able to make a complaint to the Legal Services Commissioner up to 4 months after the end of the 
  period referred to. This is provided that you can satisfy the Commissioner that there was a reasonable cause for 
  the delay in making the complaint, and legal proceedings have not been commenced for the recovery or review of 
  the legal costs that are the subject of the complaint.<br/>
  <h3>12. <span class='underline'>Commencement of work in this matter</span></h3>
  You should be aware that we may commence work on your behalf prior to your returning this signed agreement. 
  If we choose to commence work you will be liable for our fees in accordance with this letter.<br/>
  We will however not be liable for, or liable to take, any step on your behalf including attending Court until 
  such time as we have received from you sufficient cleared funds.
  <h3>13. <span class='underline'>Ending our engagement/Ceasing to act</span></h3>
  You may end our engagement by written notice at any time. If you do this you must pay our legal costs up until 
  that time. If you choose to take your matter elsewhere we will charge you at a rate of $330 per hour including 
  GST for work done to an amount no more than the lump sum fee indicated in this letter<br/>
  We reserve the right to cease to act for you if you do not pay your costs into our trust account as indicated 
  in this letter and we will exercise a lien over all documents held on your behalf until all money due has been 
  paid.<br/>
  <p>Thank you for instructing us and if you do not understand anything in this letter please contact us.</p><br/><br/>
  <p>Please sign and return this letter.</p>
  Please note as above that we may not be able to further progress your matter until we have received your agreement 
  indicated by the return of your signed copy.<br/>
  <p>We look forward to working with you</p>
  <p class='final_greetings'>Yours faithfully</p>%%solicitor%%<br/><br/><br/><br/>
  I, %%client%%, instruct %%solicitor%% to act on the terms outlined above<br/><br/><br/>
  ___________________________________________<br/>
  <p>Dated: ".$form->getDocumentDate('j F Y', 'span', false, false)."</p>
  Our bank account details:<br/>".$form['field11']->renderRow()."
  <p><b>Please note:</b><br/>
  It is very important that you enter the <b>number ".$helper->field1_text." as a reference number</b> when 
  depositing money. This way we will know that the payment relates to your file. If you can then phone and 
  let us know that you have made payment that will be helpful. It is fine to leave a message with reception.</p>";
  /*Please put ".$helper->field1_text." as a reference number if payment is made electronically.<br/>
  Please then phone us and confirm you payment<br/></p>";*/
?>

<?php echo $helper->get_partial_subfolder('adlefm', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>