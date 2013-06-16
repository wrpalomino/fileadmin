<?php
  $helper->payment_fields = "Total Fees $ ".$form['field9']->renderRow()."<br/>
    Amount to pay from trust $ ".$form['field10']->renderRow()."<br/>
    <b>Amount remaining in trust</b> $ ".$form['field11']->renderRow();

  $helper->post_text = "<div align='center'>Thank you for your instructions in relation to this matter.</div>";
?>
<?php echo $helper->get_partial_subfolder('trmoin', 'fee', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>