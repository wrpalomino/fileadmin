<?php
  /*$helper->fee_content = "<p>Thank you for your instructions to act for you in this matter.</p>
  Enclosed are two copies of the Fees Agreement. Please sign them, return a copy to our office and keep 
  the second copy for your records.<br/>
  Please pay the fees of $ 1000 by 17/9/2010
  <p class='final_greetings'>Yours faithfully</p>%%solicitor%%";*/
?>

<?php echo $helper->get_partial_subfolder('adlefm', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>