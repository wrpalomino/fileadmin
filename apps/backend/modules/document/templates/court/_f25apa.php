<?php
  $helper->form_number = "FORM 25";
  $helper->rule_number = "Rule 38";
  $helper->top_title = "<b>NOTICE OF APPEARANCE</b>";
?>
<?php echo $helper->get_partial_subfolder('f32adj', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>