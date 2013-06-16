<?php 
  $helper->cd_payment_field = "";
  $helper->cd_div_style= "style='width:96%; padding:1%'";
?>
<?php echo $helper->get_partial_subfolder('stdinv', 'fee', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>