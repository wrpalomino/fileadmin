<?php
 $helper->aff_text = "Do solemnly and sincerely declare and affirm as follows:-"; 
 $helper->sworn_text = "AFFIRMED";
 $helper->sign_text = "An Australian Legal Practitioner within the meaning of the Legal Profession Act 2004"; 
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>