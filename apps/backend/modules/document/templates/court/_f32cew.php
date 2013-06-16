<?php
$helper->questions = "1. The Defendant will apply for leave to cross-examine the following witness or 
  witnesses:<br/>".$form['field17']->renderRow()."
  2. The particulars of previous convictions of any witness on whose evidence the prosecution intends to 
  rely in the committal proceeding:<br/>".$form['field18']->renderRow()."
  3. The Defendant seeks the production of an item or items listed in the hand-up brief and the informant 
  objects to the production of the item or items:<br/>
  <table style='width:100%;padding:0px;margin:0px'><td style='width:70%'>Item</td><td>Ground for objection</td></table>".
  $form['field19']->renderRow();
?>

<?php echo $helper->get_partial_subfolder('f32adj', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>