<?php if (!isset($helper->content_text)) $helper->content_text = $form->getDocumentDate("j F Y", 'span', true, false); ?>
<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center" style="float:left;width:62%;margin-left:20%">
      <h2><?php echo $form['field4']->renderRow() ?></h2>
    </div>
    <div style="float:left;width:10%"><?php echo $form['field1']->renderRow() ?></div>
    <div class="clear"></div>
    
    <?php echo $form['field5']->renderRow() ?><br/><br/>
    DATE OF BIRTH:<br/>
    <?php echo $form['field2']->renderRow() ?>
    <?php if (!empty($helper->dob_detail)): ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $helper->dob_detail ?>&nbsp;&nbsp;&nbsp; on <?php $form->getDocumentDate()?><br/>
    <?php endif; ?>
    <p><?php echo $helper->content_text; ?></p>
    <?php if (isset($form['field17'])): ?>
      <?php echo $form['field17']->renderRow() ?>
    <?php endif; ?>
  </div>  
  <!--<div class="doc_footer"></div>-->
</div>