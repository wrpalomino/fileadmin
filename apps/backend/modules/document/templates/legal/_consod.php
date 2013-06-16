<?php
  $helper->title = 'CONSOLIDATION WORKSHEET';
  
  $helper->content_text = "<p>Practitioners should only recommend the granting of assistance at the 
    consolidated rate where:</p>
    <p>
      a) There are two or more sets of charges that fall within the guidelines for assistance.<br/>
      OR<br/>
      b) A grant of aid is current pursuant to Table A1 and the client receives a further charge or 
      charges that fall within the guidelines for assistance
    </p>
    <p>Full details of the charges, ".$form['field4']->renderRow()."&nbsp;or REFER TO CHARGE SHEETS</p>".
    $form['field17']->renderRow()."
    <br/><p>".$form['field5']->renderRow()."&nbsp;Matters yet to be listed at plea:(provide charges 
    & Informant details</p>".
    $form['field18']->renderRow()."
    <p class='important'>AND</p>
    <p>Each of those sets of charges would, if they were the only set of charges, qualify the applicant 
    for a grant of assistance under the relevant guilty plea guideline.</p>
    <p class='final_greetings'></p>";
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>