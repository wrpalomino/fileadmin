<?php
  $helper->title = "NOTICE THAT SOLICITOR ACTS";
  
  $helper->top_header_section = "<div class='centered'><p class='subtitle'>FORM 2-11A</p>
    <div style='float:left'>Rule 11.03 (1)</div>
    <div style='float:right'>Court Ref: ".$form['field13']->renderRow()."</div>
    <div class='clear'></div>
    </div>";
  
  $helper->declaration_text = '<p>'.$form['field14']->renderRow().'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
    $form['field15']->renderRow().'</p><p class="final_greetings">TAKE NOTICE that the solicitor indicated 
    below acts for the accused in this matter;</p><br/>';
  
  $helper->low_content_text = '<p class="centered"><hr class="division" width="60%" /></p>
    <table class="fax">
    <tr><td class="fourth">Signed by:</td><td>'.$form['field9']->renderRow().'</td></tr>
    <tr><td>Firm:: </td><td>'.$form['field8']->renderRow().'</td></tr>
    <tr><td>Telephone: </td><td>'.$form['field2']->renderRow().'</td></tr>
    </table>';
  
  $helper->footer_section = '<p class="final_greetings">
    Date: '.$form->getDocumentDate("d F Y", 'span', true, false).'
    <br/><br/><br/>NOTES:
    <ol>
    <li>This notice has been sent to the DPP and to the Criminal Trial Listing Directorate as soon as 
    possible after a solicitor commences to act for an accused person.</li>
    <li>This notice must be filed with the Registrar after a copy of the presentment has been served</li>
    </ol>
    </p>';
?>
<?php echo $helper->get_partial_subfolder('coadso', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>