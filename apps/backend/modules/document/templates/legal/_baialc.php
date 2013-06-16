<?php
  $helper->title = 'BAIL APPLICATIONS WORKSHEET';
  
  $helper->content_text = '
  <p>Before recommending that assistance be granted for a bail application in the Magistrates’ Court 
  practitioners MUST form the view that there is a:</p>
  <p><span style="font-style:underline">Realistic prospect of bail being granted</span> AND<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;a) Bail is opposed by the prosecution; or<br/>
  &nbsp;&nbsp;&nbsp;&nbsp;b) The accused has to show cause why bail should be granted</p>
  <p>
    Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS<br/>'.
    $form['field17']->renderRow().'
  </p>
  <p>
    <p>The Grounds & Strengths relied upon in support of the application: For example</p>'.
    $form['field5']->renderRow().'
    Comments<br/>'.
    $form['field18']->renderRow().'
  </p>
  <p>
    <p>Practitioner’s assessment of the weaknesses of the application: For example</p>'.
    $form['field6']->renderRow().'
    Comments<br/>'.
    $form['field19']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>