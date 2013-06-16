<div class="doc_container" id="doc_container">
  <div class="doc_header">
    <?php echo image_tag('phone_message.jpg', array('alt' => 'Phone Message', 'title' => 'Phone Message')); ?>
    <p><br/><?php echo $form['field4']->renderRow() ?></p>
  </div>
  <div class="doc_logo">
    <div style="text-align:left;padding-left:140px">
      <p>Date: <?php $form->getDocumentDate("d/m/Y")?>&nbsp;</p>
      <p>Time: <?php $form->getDocumentDate("H:i:s A", 'span', false)?>&nbsp;</p><br/><br/>
      <p>File:&nbsp;&nbsp;<?php echo $form['field1']->renderRow() ?>&nbsp;</p>
    </div>
  </div>
  <div class="doc_section">
    <br/><br/><br/>
    <?php echo $form['field7']->renderRow() ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $form['field8']->renderRow() ?>
    <br/>
    <table class="fax">
    <tr><td>FROM: </td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>TO: </td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>TAKEN BY: </td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>RSVP ETC.: </td><td><?php echo $form['field12']->renderRow() ?></td></tr>
    <tr><td>PHONE No:</td><td><?php echo $form['field13']->renderRow() ?></td></tr>
    </table>
    <p><?php echo $form['field17']->renderRow() ?></p>
  </div>
  <!--<div class="doc_footer"></div>-->
</div>