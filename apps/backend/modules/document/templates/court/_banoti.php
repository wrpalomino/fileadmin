<?php
  if (!isset($helper->title)) $helper->title = "NOTICE OF INTENTION TO MAKE APPLICATION FOR BAIL";
  
  if (!isset($helper->header_section)) $helper->header_section = "<div>
    <div style='float:right'>No. _______ of 20</div><div class='clear'></div>
    <p>".$form['field10']->renderRow()."</p>
    IN THE MATTER of the Crimes Act 1958 (Victoria)<p>-and-</p>
    IN THE MATTER of the Bail Act 1997<p>-and-</p>
    IN THE MATTER of an Application for Bail by
    <p>".$form['field4']->renderRow()."</p>
    </div>";
  
  $helper->declaration_text = '';
  
  $helper->low_content_text = "<p><span class='important'>TAKE NOTICE:</span><br/>".$form['field17']->renderRow()."</p>".
    "<p>The <span class='important'>GROUNDS UPON WHICH BAIL</span> are sought to be granted include:<br/>".
    $form['field18']->renderRow().'</p>';
  
  $helper->footer_section = '<p class="final_greetings">DATED: '.$form->getDocumentDate("d F Y", 'span', true, false).'</p>'.
  '<div style="float:right" class="centered">__________________________________<br/>Applicant</div>';
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>