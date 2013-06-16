<?php
  $helper->title = 'COMMONWEALTH NOT GUILTY WORKSHEET';
  
  $helper->content_text = 'Before recommending that assistance be granted for a not guilty plea, 
  the practitioner MUST form the view that the applicant has a <span class="underline">reasonable 
  prospect of acquittal AND</span>
  <ol>
  <li>Conviction would be likely to have a significantly detrimental effect on the applicant’s 
  livelihood or employment, actual or prospective; or</li>
  <li>The applicant has a disability or disadvantage which would present self representation; or</li>
  <li>Conviction would be likely to result in a term of imprisonment, including a suspended term being 
  imposed</li>
  </ol>
  <p>Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS<br/>'.
  $form['field17']->renderRow().'</p>
  <p>Full details of the defence - Whether a <span class="underline">reasonable prospect of acquittal</span><br/>'.
  $form['field18']->renderRow().'</p>
    
  <p><b>AND (one of the following 3 criteria)</b></p>
  <p>1. Proof of ‘significantly detrimental effect’: (must be <span class="underline">real and not 
  speculative or a mere possibility</span>)<br/>
  eg. Loss of licence where the applicant’s employment requires a licence<br/>
  eg. Inability to pursue the career of choice (eg dishonesty convictions for person in the banking 
  industry or law student<br/>
  '.$form['field5']->renderRow().'<b>OR,</b></p>
  <p>2. The applicant has a disability or disadvantage that would prevent self-representation<br/>
  '.$form['field6']->renderRow().'<b>OR,</b></p>
  <p>3. Likely penalty (if convicted, risk of a term of imprisonment / suspended sentence)<br/>
  '.$form['field7']->renderRow().'<b>OR,</b></p>
  <p><b>Other relevant matters</b><br/>'.$form['field19']->renderRow().'</p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>