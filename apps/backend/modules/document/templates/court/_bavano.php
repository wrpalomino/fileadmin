<?php
  $helper->title = "NOTICE OF APPLICATION FOR ORDER VARYING BAIL";
  
  $helper->header_section = "<div>
    <div style='float:right'>No. _______ of 20</div><div class='clear'></div>
    <p>".$form['field10']->renderRow()."</p>
    IN THE MATTER of the Crimes Act 1958 (Victoria)<p>-and-</p>
    IN THE MATTER of the Bail Act 1997<p>-and-</p>
    IN THE MATTER of an Application for an Order Varying Bail
    <p>".$form['field4']->renderRow()."</p>
    </div>";
?>
<?php echo $helper->get_partial_subfolder('banoti', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>