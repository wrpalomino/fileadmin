<?php 
  $helper->title = "Credit Card Authority Form";
  $helper->hereby_text = "authorise";
  $helper->content_text = "to charge the following credit card the fees associated with the Court case of:<br/>
  ".$form['field6']->renderRow()."<br/>
  as per the fees agreement provided to them
  <table><tr><td>Name on Card: </td><td>____________________________</td></tr>
  <tr><td>Card number:         </td><td>____________________________</td></tr>
  <tr><td>Expiry date:         </td><td>____ / ____</td></tr>
  <tr><td><br/>Signed:         </td><td><br/>____________________________</td></tr>
  <tr><td>Date:                </td><td>____________________________</td></tr></table>";
  $helper->dont_show_sign = true;
?>
<?php echo $helper->get_partial_subfolder('mefage', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>