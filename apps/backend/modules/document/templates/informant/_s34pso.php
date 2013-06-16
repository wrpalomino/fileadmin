<?php 
  if (!isset($helper->title)) $helper->title = "NOTICE OF APPLICATION BY THE DEFENDANT FOR LEAVE PURSUANT 
    TO S.342 OF THE CRIMINAL PROCEDURE ACT (VIC) 2009"; 
?>
<?php echo $helper->get_partial_subfolder('s32cma', 'informant', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>