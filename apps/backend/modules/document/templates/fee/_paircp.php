<?php 
  if (!isset($helper->title)) $helper->title = "RECEIPT";
  $helper->abn = sfConfig::get("app_appowner_abn");
  
  $helper->title.= (!isset($helper->receipt_number)) ? "" : $helper->receipt_number;
?>
<?php echo $helper->get_partial_subfolder('adlefm', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>