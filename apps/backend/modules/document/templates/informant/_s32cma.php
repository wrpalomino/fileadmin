<?php
  if (!isset($helper->title)) $helper->title = "NOTICE PURSUANT TO S.32 (C) OF THE EVIDENCE ACT 1958 (VIC)";
  if (!isset($helper->sign_text)) 
    $helper->sign_text = "<br/><br/>...................................................<br/>
      ".$form['field9']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('s32cas', 'informant', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>