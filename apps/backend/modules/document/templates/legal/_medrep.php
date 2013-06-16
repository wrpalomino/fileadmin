<?php
  $helper->title = 'MEDICAL REPORT WORKSHEET';
  
  $helper->content_text = '<p class="subtitle">GENERAL</p>
  <p>
  Before recommending that assistance be granted for a disbursement you must have formed the view that:
  <ol>
  <li>The disbursement is relevant to the position the aided person wishes to put to the court and is 
  not fishing; AND</li>
  <li>The disbursement is necessarily and/or reasonably required to maintain that position and cannot 
  be achieved in some other way; AND</li>
  <li>The expenditure can be justified on a cost/benefit* analysis.</li>
  </ol>
  </p>
  <p>*Cost/benefit involves recognition that public funds are being spent. The cost of thedisbursement 
  must be balanced against the likely benefit that incurring the disbursementmay bring to the applicant. 
  If a prudent self-funding litigant would not spend the money, itwill not be reasonable to expect VLA 
  to pay for it.</p>
  <p class="subtitle">Summary Crime: Medical - Treating Practitioner (Plea)</p>
  <p class="important final_greetings">**Solicitors may only recommend assistance up to a fee of $200 
  for Medical   Practitioner reports & up to $280 for Hospital reports. Any higher fees must be 
  specifically considered and approved by VLA.</p>
  <p>Before recommending that assistance be granted for such a report you must form the view that the 
  client’s medical history – <br/>
  I. Directly relates to the proposed plea AND<br/>
  II. Provides substantial exculpatory material likely to lead to a significantly reduced sentence AND<br/>
  III. Is material that cannot be presented to the court without obtaining the report.
  </p>
  <p>Reasons:<br/>'.$form['field17']->renderRow().'</p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>