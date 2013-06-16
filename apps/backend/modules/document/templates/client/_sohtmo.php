<?php 
  $helper->title = "File Authority and release of trust monies";
  $helper->content_text = "any charge sheets, Police briefs of evidence, tapes of interviews, 
  medical reports, psychological or psychiatric reports etc that you may have on my file.<br/>
  I want them to act on my behalf in the matter which you have been handling.<br/>
  I specifically revoke all forms of authority and I direct that no information whatsoever 
  including documentation of files is to be supplied to any other person, insurancecompany 
  employer or solicitors other than my above mentioned solicitors.<br/>
  Our client also instructs that there are monies in trust which have not been disbursed and 
  accordingly we would appreciate your accounting to us, and your forwarding the balance of 
  monies held on our client’s behalf."
?>
<?php echo $helper->get_partial_subfolder('mefage', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>