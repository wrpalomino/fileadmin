<?php 
  $helper->title = "Authority re: Caveat";
  $helper->hereby_text = "Agree to my solicitor:";
  $helper->content_text = "<b>lodging a caveat or caveats against any real property that I own</b> 
  or have an interest in, to secure their legal fees for acting on my behalf in relation to criminal 
  charges and all work incidental to that matter, including taking steps to arrange for the funding 
  of the matter and the lodging of any caveat."
?>
<?php echo $helper->get_partial_subfolder('mefage', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>