<?php
  $helper->pre_text = "I have no income and no assets and there is no one who is willing or able to pay for 
    my legal representation.<br/>I am not in receipt of a Centrelink benefit";
  $helper->post_text = "I make this statement and say that it is true and correct and that I make it in the
    belief that a person making a false statement in these circumstances will be liable to the penalties for 
    perjury.";
  
  if (!isset($helper->sign_text)) 
    $helper->sign_text = "<tr>
      <td>Address and occupation of witness: </td>
      <td><br/>_________________________________________________</td>
    </tr>";
  
  $helper->declare_text = "<table class='fax'>
    <tr><td><br/>SIGNED: </td><td><br/><br/>_________________________________________________</td></tr>
    <tr><td>at:     </td><td><br/>_________________________________________________</td></tr>
    <tr><td>Before: </td><td><br/>_________________________________________________</td></tr>
    ".$helper->sign_text."
    </table><br/>Date: ".$form->getDocumentDate("j F Y", 'span', true, false);
?>
<?php echo $helper->get_partial_subfolder('stdemi', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>