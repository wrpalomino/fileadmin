<?php 
  $helper->title = "Authority to release information to a third party";
  $helper->content_text = "The bank account statements for the following account(s):
  <table>
  <tr><td>Account Name(s):        </td><td>______________________________</td></tr>
  <tr><td>Bank & Account Type(s): </td><td>______________________________</td></tr>
  <tr><td>Account Number(s):      </td><td>______________________________</td></tr>
  <tr><td></td><td>(Please make sure BSB is included in account number)</td></tr>
  <tr><td>For the time period(s): </td><td>_____________ to _____________</td></tr>
  </table><br/>
  I understand that this authority will remain in force for a period of 12 months unless revoked 
  in writing by me at an earlier date.<br/>
  I understand that transactions remain my responsibility and that I must provide my written 
  permission expressly requesting the transaction to be made.<br/>
  I specifically revoke all forms of prior authority and I direct that no information whatsoever 
  including documentation relating to my accounts is to be supplied to any other person other 
  than my above mentioned solicitors."
?>
<?php echo $helper->get_partial_subfolder('mefage', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>