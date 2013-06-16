<?php
 $helper->aff_text = "Do solemnly and sincerely declare and affirm as follows:-"; 
 $helper->sworn_text = "AFFIRMED";
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>