<?php  
  $helper->header_section = '<div class="final_greetings">
      <p>Between:</p>
        <p class="subtitle">'.$form['field4']->renderRow().'</p>
        <p>and</p>
        <p class="subtitle">'.$form['field10']->renderRow().'</p>
    </div>';
  
  $helper->footer_section = '<br/><br/><br/><br/><p class="final_greetings important">Applicant’s appeal folder</p>';
?>

<?php echo $helper->get_partial_subfolder('folcsh', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>