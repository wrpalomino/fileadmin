<?php
  $helper->associate_to = '<tr><td class="label">Associate&nbsp;To:</td>
    <td class="field">'.$form['field12']->renderRow().'</td>
    <td class="label">&nbsp;</td><td class="field">&nbsp;</td></tr>';
?>
<?php echo $helper->get_partial_subfolder('fxcorc', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>