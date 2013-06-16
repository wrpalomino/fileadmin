<div class="doc_container" id="doc_container">
  <div class="doc_header">
    <?php echo image_tag('file_note.jpg', array('alt' => 'File Note', 'title' => 'File Note')); ?>
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
    <p>&nbsp;&nbsp;BY: <?php echo $form['field9']->renderRow() ?></p> 
    <p>&nbsp;&nbsp;TO: <?php echo $form['field10']->renderRow() ?></p>
    <p><?php echo $form['field17']->renderRow() ?></p>
  </div>
  <!--<div class="doc_footer"></div>-->
</div>