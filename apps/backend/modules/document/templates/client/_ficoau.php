<?php //include_partial('empty', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
<?php
  // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Solicitor - File Authority), IT MAY REQUIRE CHANGE CONTENT
  $helper->title = "File Collection Authority";
  $helper->content_text = "any charge sheets, Police briefs of evidence, tapes of interviews, medical 
  reports, psychological or psychiatric reports etc that you may have on my file.<br/>
  I want them to act on my behalf in the matter which you have been handling.<br/>
  I specifically revoke all forms of authority and I direct that no information whatsoever including 
  documentation of files is to be supplied to any other person, insurance company employer or solicitors 
  other than my above mentioned solicitors.";
?>
<?php echo $helper->get_partial_subfolder('mefage', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>