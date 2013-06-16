<?php
  if (!isset($helper->associate_to)) $helper->associate_to = '';
?>
<div class="doc_container" id="doc_container">
  <div class="doc_header">
    Reference: <?php echo $form['field1']->renderRow() ?><br/>
    Email: <?php echo $form['field2']->renderRow() ?><br/>
    <?php echo $form['field3']->renderRow() ?><br/>
  </div>
  <div class="doc_logo">
    <?php echo image_tag($helper->logo, array('alt' => 'Logo', 'title' => 'Logo', 'class' => 'logo_img')); ?>
  </div>
  <div>
    <?php echo image_tag('document_logo_fax.jpg', array('alt' => 'Fax Logo', 'title' => 'Fax Logo', 'class' => 'fax_img')); ?>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td class="label">To:</td><td class="field"><?php echo $form['field5']->renderRow() ?></td>
      <td class="label">From:</td><td class="field"><?php echo $form['field9']->renderRow() ?></td>
    </tr>
    <?php echo $helper->associate_to?>
    <tr>
      <td class="label">Fax:</td><td class="field"><?php echo $form['field6']->renderRow() ?></td>
      <td class="label">Pages:</td><td class="field"><?php echo $form['field10']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">CC:</td><td class="field"><?php echo $form['field11']->renderRow() ?></td>
      <td class="label">Date:</td><td class="field"><?php $form->getDocumentDate()?></td>
    </tr>
    <tr>
      <td class="label">Re:</td><td class="field"><?php echo $form['field4']->renderRow() ?></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td class="label"></td>
      <td class="field" colspan="3">
        <?php echo $form['field7']->renderRow() ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form['field8']->renderRow() ?><br/>
      </td>
    </tr>
    </table>
    <?php echo $form['field17']->renderRow() ?><br/>
  </div>
  <div class="doc_footer">
    Please note: The fax you have received may contain privileged or legally sensitive content. If you have received
    this fax in error, please notify our office at the number above and destroy the fax immediately.
  </div>
</div>