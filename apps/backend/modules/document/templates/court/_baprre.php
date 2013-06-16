<?php 
$helper->prv_bail_content = "<b>Details of Previous Bail Application in Relation to These Charges</b><br/>
  ".$form['field19']->renderRow()."<br/>
  If bail Previously Refused, State New Facts & Circumstances<br/>".
  $form['field20']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('bafiti', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>