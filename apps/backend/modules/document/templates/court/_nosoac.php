<?php
  if (!isset($helper->title)) $helper->title = "<h1>NOTICE THAT SOLICITOR ACTS</h1>";
  
  $helper->top_header_section = '<p class="centered subtitle">Supreme Court (Criminal Procedure) Rules 2008</p>';
  
  $helper->header_section = "<div class='centered'>
    <p>".$form['field10']->renderRow()."</p>V<p>".$form['field4']->renderRow()."</p>
    </div>";
  
  $helper->declaration_text = '<p class="subtitle"><span class="important">TO:</span>
    THE REGISTRAR OF CRIMINAL APPEALS</p>
    <p class="final_greetings"><b>TAKE NOTICE</b> that the solicitor (or firm) indicated below acts for the 
    applicant in this matter</p>
    <p>Dated this: '.$form->getDocumentDate("d F Y", 'span', true, false).'</p>
      
    <p class="centered final_greetings subtitle">PARTICULARS</p>
    <table class="fax">
    <tr><td class="half">1. Name of legal practitioner (or firm):</td><td>'.$form['field11']->renderRow().'</td></tr>
    <tr><td>2. Address of legal practitioner (or firm):</td><td>'.$form['field8']->renderRow().'</td></tr>
    <tr><td>3. Telephone number:</td><td>'.$form['field2']->renderRow().'</td></tr>
    <tr><td>4. Facsimile number:</td><td>'.$form['field3']->renderRow().'</td></tr>
    <tr><td>5. Name of person handling matter:</td><td>'.$form['field9']->renderRow().'</td></tr>
    <tr><td>6. Present address of accused person:</td><td>'.$form['field5']->renderRow().'</td></tr>
    </table>';
  
  $helper->low_content_text = '';
 
  $helper->footer_section = '<p class="final_greetings">
      <p class="centered subtitle">IMPORTANT NOTES</p>
      <ol>
        <li>That upon filing this notice with the Registrar, Rule 2.03.2 (4) will then apply.</li>
        <li>This notice must be sent to the DPP and, where applicable, the applicant’s previous solicitor.</li>
      </ol>
    </p>';
  
  $helper->show_table = false;
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>