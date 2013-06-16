<?php
  $helper->title = "NOTICE OF APPLICATION";
  
  $helper->low_content_text = '<p>'.$form['field17']->renderRow().'</p>';
?>
<?php echo $helper->get_partial_subfolder('coadso', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>