<?php
  /*$helper->fee_content = "<p>Thank you for your instructions to act for you in this matter.</p>
  Enclosed are two copies of the Fees Agreement. Please sign them, return a copy to our office and keep 
  the second copy for your records.
  <p class='final_greetings'>Yours faithfully</p>%%solicitor%%";*/
?>

<?php echo $helper->get_partial_subfolder('adlefm', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>