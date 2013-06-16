<?php
  $helper->title = "RESPONSE OF ACCUSED TO SUMMARY OF PROSECUTION OPENING AS PER SECTION 183 OF THE 
    CRIMINAL PROCEDURE ACT 2009";
  
  $helper->low_content_text = '';
?>
<?php echo $helper->get_partial_subfolder('coadso', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>