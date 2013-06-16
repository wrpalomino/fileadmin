<?php
  $helper->title = 'TRAFFIC PROSECUTIONS WORKSHEET';
  
  $helper->content_text = '<p class="subtitle">This guideline applies regardless of the applicant’s plea 
  of guilty or Not Guilty</p>
  <p>Before recommending that assistance be granted for a traffic prosecution, practitioners MUST form 
  the view that conviction is <span class="underline">likely to result in:</span></p>
  <p class="subtitle">a) Imprisonment or<br/>b) Suspended sentence</p><br/>
  <p class="subtitle">Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS<br/>'.
  $form['field17']->renderRow().'</p>
  <p class="subtitle">Full details of prior convictions, '.$form['field5']->renderRow().'&nbsp;or REFER TO FILE COPY OF PRIORS<br/>'.
  $form['field18']->renderRow().'</p>
  <p class="subtitle">Assessment of likely penalty</p>
  '.$form['field19']->renderRow().'<p class="final_greetings"></p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>