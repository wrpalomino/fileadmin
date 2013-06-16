<?php 
  if (!isset($helper->title))       $helper->title = "Medical File Authority";
  if (!isset($helper->hereby_text)) $helper->hereby_text = 'hereby request that you forward to:';
  if (!isset($helper->content_text)) 
    $helper->content_text = "any medical reports, file entries or other data that you have in 
    your possession relating to myself.<br/>
    I specifically revoke all forms of authority and I direct that no information whatsoever 
    including documentation of files is to be supplied to any other person, insurance company 
    employer or solicitors other than my above mentioned solicitors." 
?>
<?php echo $helper->get_partial_subfolder('clkacl', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>