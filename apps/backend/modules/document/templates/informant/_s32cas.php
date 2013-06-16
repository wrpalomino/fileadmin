<?php 
  if (!isset($helper->title)) $helper->title = "APPLICATION TO ISSUE A SUBPOENA OR TO PRODUCE OR TO ADDUCE EVIDENCE";
  if (!isset($helper->sign_text)) 
    $helper->sign_text = "<table class='fax'>
      <tr>
        <td>Date: ".$form->getDocumentDate('j F Y', 'span', true, false)."</td>
        <td style='text-align:center'><br/><br/>_____________________________________________<br/>Signature of Applicant</td>
     </tr>
     </table>
     NOTE:<br/>
     This notice must be served on -<br/>
     - The DPP<br/>
     - The Informant<br/>
     - The medical practitioner or counsellor (as the case requires), not less than 14 days before the 
     date for the hearing of the application";
  
  if (!isset($helper->footer_section)) $helper->footer_section = $helper->sign_text;
  
  if (!isset($helper->declaration_text)) {
    $helper->declaration_text = '';
    
    if (isset($form['field5'])) {
      $helper->declaration_text = '<table class="fax">
      <tr><td class="label">TO: </td><td class="field">'.$form['field10']->renderRow().'</td></tr>
      <tr><td class="label">AND TO: </td><td class="field">'.$form['field5']->renderRow().'</td></tr>';
    
      if (isset($form['field13']))
        $helper->declaration_text.= '<tr><td class="label">AND TO: </td><td class="field">'.$form['field13']->renderRow().'</td></tr>';
    
      $helper->declaration_text.= '</table>';
    }
  }
  
  if (!isset($helper->low_content_text)) {
    $helper->low_content_text = 'TAKE NOTICE THAT:<br/>'.$form['field17']->renderRow();
    
    if (isset($form['field18']))
      $helper->low_content_text.= 'The protected evidence sought is:<br/>
      [A description of the material sought, confined to relevant dates and times and restricting where 
      possible the number and nature of documents sought]<br/>'.$form['field18']->renderRow();
  
    if (isset($form['field19']))
      $helper->low_content_text.= 'Pursuant to section 32D of the Act, the accused will assert the 
      following:<br/>[A brief statement of the matters relied upon to satisfy the requirements of section 
      32D of the Evidence (Miscellaneous Provisions ) Act 1958]<br/>'.$form['field19']->renderRow();
  }
  
  if (!isset($helper->header_section)) 
    $helper->header_section = "<p>IN THE MATTER OF:</p>
    <p>".$form['field10']->renderRow()."</p>V.<p>".$form['field4']->renderRow()."</p>";  
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>