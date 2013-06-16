<?php
  $helper->title = "AFFIDAVIT IN SUPPORT OF APPLICATION FOR BAIL";
  
  $helper->header_section = "<div>
    <div style='float:right'>No. _______ of 20</div><div class='clear'></div>
    <p>".$form['field10']->renderRow()."</p>
    IN THE MATTER of the Crimes Act 1958 (Victoria)<p>-and-</p>
    IN THE MATTER of the Bail Act 1997<p>-and-</p>
    IN THE MATTER of an Application for Bail by
    <p>".$form['field4']->renderRow()."</p>
    </div>";
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>