<?php
  $helper->sign_text = "<tr><td></td><td>".$form['field9']->renderRow()."<br/>".$form['field8']->renderRow()."
    <br/><br/>An Australian Legal Practitioner within the meaning of the Legal Profession Act 2004</td></tr>";
?>
<?php echo $helper->get_partial_subfolder('stdeni', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>