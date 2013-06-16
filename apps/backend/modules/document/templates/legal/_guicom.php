<?php
  $helper->title = 'COMMONWEALTH GUILTY WORKSHEET';
  
  $helper->content_text = '<p>Before recommending that assistance be granted for a guilty plea, the 
  practitioner MUST form the view that, because of <span style="font-style:underline">complexity</span>, 
  or some other <span style="font-style:underline">aggravating feature</span> the matter cannot be 
  dealt with by the duty lawyer service:<br/>
  For example, the likelihood that a lengthy sentence may be imposed; or<br/>
  A disability or disadvantage of the applicant such as a language difficulty or mental illness</p>
  <p>Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS</p>'.
  $form['field17']->renderRow().'<br/><br/>
  <p class="subtitle">'.$form['field5']->renderRow().'&nbsp;MATTER CANNOT BE DEALT WITH BY THE DUTY LAWYER SERVICE:</p>
  <p>1. Aggravating circumstances: Likelihood that a lengthy sentence may be imposed</p>'.
  $form['field18']->renderRow().'
  AND/OR
  <p>2. Complexity</p>'.
  $form['field19']->renderRow().'
  AND/OR;
  <p>3. A disability or disadvantage of the applicant, such as a language difficulty or mental illness</p>'.
  $form['field20']->renderRow().'<p class="final_greetings"></p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>