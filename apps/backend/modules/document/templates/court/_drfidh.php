<?php
  $helper->title = "DEFENCE RESPONSE FOR INITIAL DIRECTIONS HEARING";
  
  $helper->low_content_text = '<table class="fax">
    <tr><td class="third">Case conference date: </td><td>'.$form['field13']->renderRow().'</td></tr>
    <tr><td>Filing date: </td><td>'.$form['field14']->renderRow().'</td></tr>
    <tr><td>Committal date: </td><td>'.$form['field15']->renderRow().'</td></tr>
    <tr><td>Committal charges: </td><td>'.$form['field18']->renderRow().'</td></tr>
    <tr><td colspan="2">Outline of defence case:<br/>'.$form['field17']->renderRow().'</td></tr>
    </table>';
?>
<?php echo $helper->get_partial_subfolder('coadso', 'court', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>