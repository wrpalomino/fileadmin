<?php
$helper->questions = "<b>1. The court should determine the committal proceeding at the committal mention 
  hearing.</b><br/>
  (a) At the committal mention hearing, will the defendant submit that the defendant should not be committed 
  for trial?<br/>".$form['field17']->renderRow()."
  (b) If committed for trial, how does the defendant intend to plead?<br/>".$form['field18']->renderRow()."
  (c) Basis of intention to plead:<br/>The defendant will plead guilty to:<br/>".$form['field19']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('f32adj', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>