<?php
  if (!isset($helper->top_header_section)) $helper->top_header_section = '<p class="subtitle">'.
    $form['field7']->renderRow().'<br/>CRIMINAL DIVISION<br/>MELBOURNE</p><br/><br/><br/>';
  
  if (!isset($helper->header_section)) $helper->header_section = '<div class="final_greetings">
      <p>Between:</p>
      <div style="padding-left:200px">
        <p class="subtitle">'.$form['field4']->renderRow().'</p>
        <p>and</p>
        <p class="subtitle">'.$form['field10']->renderRow().'</p>
      </div>
    </div>';
  
  if (!isset($helper->declaration_text)) $helper->declaration_text = '<br/><br/><br/><br/><br/><br/><br/>';
  
  if (!isset($helper->footer_section)) $helper->footer_section = '
    <p class="final_greetings smaller_font"><span class="important">Applicant</span><br/>'.
      $form['field8']->renderRow().'
      <br/>Phone:&nbsp;&nbsp;&nbsp;'.$form['field2']->renderRow().'
      <br/>Fax:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$form['field3']->renderRow().'
      <br/>Contact:&nbsp;'.$form['field9']->renderRow().'
    </p>
      
    <p class="final_greetings smaller_font"><span class="important">Respondent</span><br/>'.
      $form['field11']->renderRow().'<br/>'.
      $form['field12']->renderRow().'
    </p>';
?>
<?php echo $helper->get_partial_subfolder('affecs', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>