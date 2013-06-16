<?php
  $helper->show_question = false;
  $helper->title = "Court Appearance File Note";
  $helper->top_text = ""; 
?>
<?php echo $helper->get_partial_subfolder('casstu', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>