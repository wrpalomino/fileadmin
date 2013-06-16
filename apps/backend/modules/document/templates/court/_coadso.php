<?php
  if (!isset($helper->title)) $helper->title = "RESPONSE OF ACCUSED TO SUMMARY OF PROSECUTION OPENING 
    AND NOTICE OF PRETRIAL ADMISSIONS AS PER SECTION 183 OF THE CRIMINAL PROCEDURE ACT 2009";
  
  if (!isset($helper->top_header_section)) $helper->top_header_section = '';
  
  if (!isset($helper->header_section)) $helper->header_section = "<div style='position:relative'>
    <b>BETWEEN:</b>".
    "<p>".$form['field10']->renderRow()."</p>V.<p>".$form['field4']->renderRow()."</p>
    <div style='position:absolute;left:500px;top:22px'>Informant<br/><br/><br/><br/>Defendant</div>
    </div>";
  
  if (!isset($helper->declaration_text)) $helper->declaration_text = '';
  
  if (!isset($helper->low_content_text)) $helper->low_content_text = '<p class="final_greetings subtitle centered">
    THE ACCUSED SAYS AS TO THE REQUEST FOR PRE-TRIAL ADMISSIONS</p>';
 
  if (!isset($helper->footer_section)) $helper->footer_section = '<p class="final_greetings">
    <br/><br/>_______________________________<br/>Martinez & Morgan<br/>Solicitors for the Accused
    <br/>'.$form->getDocumentDate("d F Y", 'span', true, false).'
    </p>';
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>