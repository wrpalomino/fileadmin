<?php
  $helper->content_text = "";
  $helper->preface_text = "Please find enclosed a Freedom of Information request form in accordance 
    with the <i>Freedom of Information Act 1982</i>.<br/><br/>
    Please contact us if you have any questions about this request.";
?>
<?php echo $helper->get_partial_subfolder('crgunc', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>