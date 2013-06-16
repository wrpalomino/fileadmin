<?php
  if (!isset($helper->title)) $helper->title = "NOTICE OF APPLICATION FOR LEAVE TO APPEAL<br/>AGAINST CONVICTION";
  
  $helper->top_header_section = '<div class="centered">
    <b>FORM 6 2A</b><div style="float:left">Rule 2.05 (1) </div><div style="float:right"><br/>20 No_____</div>
    <div class="clear"></div>
    </div>';
  
  $helper->header_section = "<div class='centered'>
    <p>".$form['field10']->renderRow()."</p>V<p>".$form['field4']->renderRow()."</p>
    </div>";
  
  $helper->declaration_text = '<p class="subtitle">To the Registrar of Criminal Appeals</p>'.
    $form['field17']->renderRow().'<br/><br/>';
  
  $helper->low_content_text = '';
 
  $helper->footer_section = '<p class="final_greetings">Date: '.$form->getDocumentDate("d F Y", 'span', true, false).'</p>
    <div style="float:left" class="half">
      <div class="imgHover" id="signatureDiv">'.image_tag("signatures/default.png", array('alt' => 'Signature', 'title' => 'Signature', 'id' => 'signature')).'</div>
      [Signed by Applicant or legal practitioner<br/>on behalf of Applicant]
    </div>
    <div style="float:right" class="half">
      <br/><p>*[If signed by legal practitioner] The name and address for service are as follows</p>
      '.$form['field9']->renderRow().'<br/>
      '.$form['field8']->renderRow().'<br/>
      Ph. '.$form['field2']->renderRow().'<br/>
      Fax '.$form['field3']->renderRow().'<br/>
    </div>
    <div class="clear"></div>
    <p class="centered"><br/>PARTICULARS (to be completed by Applicant): overleaf)</p>';
  
  $helper->show_table = false;
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>