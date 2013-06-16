<?php
 $helper->sign_text = "An Australian Legal Practitioner within the meaning of the Legal Profession Act 2004"; 
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>