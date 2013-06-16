<?php
  $helper->title = '<h3>STATE & COMMONWEALTH CRIMINAL TRIALS WORKSHEET</h3>';
  
  $helper->content_text = '<p class="important">TYPE OF AID SOUGHT</p>
  This application relates to (tick the applicable category):
  '.$form['field4']->renderRow().'
  <p class="subtitle">TRIALS & PLEAS</p>
  <p>'.$form['field5']->renderRow().'&nbsp;Before recommending that assistance be granted for a criminal trial, practitioners 
  must form the view that the matter for which aid is sought is not (in the absence of compelling 
  reasons) a matter that could be, and normally is, heard and disposed of in the Magistrates’ Court 
  (please confirm below. If compelling reasons are relied upon, the application must come to VLA 
  for assessment)</p>
  <p class="subtitle">TRIALS</p>
  <p>'.$form['field6']->renderRow().'&nbsp;It is desirable, in the interests of justice, to provide legal assistance, and that 
  the merits of the application for assistance have been considered (Please outline those reasons 
  that support both conclusions, with particular reference to main aspects of prosecution case and 
  defence instructions, and the strength of the both sides’ cases)<br/>
  '.$form['field17']->renderRow().'</p>
  <p class="smaller_font"><b>Number of hearing days:</b> (genuine and realistic estimation of the length 
  of the trial) - briefly outline estimations of hearing time of prosecution case and defence including 
  estimations given to the Court. Please note, if the case is projected to run longer than Sixty days, 
  a recommendation for aid cannot be made: instead, the application must be sent to VLA for assessment.
  </p><br/>
  <p class="subtitle">Recommendation for a limited grant of assistance for a trial</p>
  A recommendation is made for a limited grant in a trial to:
  '.$form['field7']->renderRow().'
  <p>The reasons for this recommendation are as follows:<br/>'.$form['field18']->renderRow().'</p>
  <p class="subtitle">Notes:
  <ul class="compact">
    <li>Preparation fees over and above that provided for in the lump sum cannot be the subject of a 
    practitioner’s recommendation. Any application for preparation fees must be made to VLA for its 
    assessment and decision.</li>
    <li>If Senior Counsel is to briefed in excess of the Junior’s fees set out in the fee tables, an 
    application must be made to VLA for a decision. Likewise, any application for two counsel must also 
    come to VLA for assessment and decision</li>
  </ul>.
  </p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>