<?php
  $helper->title = "NOTICE THAT SOLICITOR HAS CEASED TO ACT";
  
  $helper->top_header_section = "<div class='centered'><p class='subtitle'>FORM 2-11A</p>
    <div style='float:left'>Rule 11.03 (1)</div>
    <div style='float:right'>Court Ref: ".$form['field13']->renderRow()."</div>
    <div class='clear'></div>
    </div>";
  
  $helper->declaration_text = '<p class="final_greetings">TAKE NOTICE that the solicitor indicated below 
    has ceased to act for the accused in this matter;</p><br/>';
  
  $helper->low_content_text = '<p class="centered"><hr class="division" width="60%" /></p>
    <table class="fax">
    <tr><td class="fourth">Signed by: </td><td>'.$form['field9']->renderRow().'</td></tr>
    <tr><td>Firm: </td><td>'.$form['field8']->renderRow().'</td></tr>
    <tr><td>Telephone: </td><td>'.$form['field2']->renderRow().'</td></tr>
    </table>';
  
  $helper->footer_section = '<p class="final_greetings">
    Date: '.$form->getDocumentDate("d F Y", 'span', true, false).'
    <br/><br/><br/>NOTES:
    <ol class="compact">
    <li>This notice must be served on the DPP and Criminal Trial Listing Directorate and the former client 
    as soon as possible after a solicitor ceases to act for the accused person.</li>
    <li>As soon as possible after ceasing to act for an accused person, the solicitor must return to CTLD, 
    the copy depositions, to the DPP all materials provided by the DPP in relation to the matter</li>
    <li>If a notice under Rule 11.03 (1) or 11.06 (1) has been filed with the Registrar this notice must be 
    filed with the Registrar as soon as possible after a solicitor ceases to act for an accused person</li>
    </ol>
    </p>';
?>
<?php echo $helper->get_partial_subfolder('coadso', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>