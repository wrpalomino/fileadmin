<?php 
  if (!isset($helper->title))             $helper->title = "";
  if (!isset($helper->abn))               $helper->abn = "";
  if (!isset($helper->pre_text))          $helper->pre_text = "";
  if (!isset($helper->post_text))         $helper->post_text = "";
  if (!isset($helper->final_text))        $helper->final_text = "";
  if (!isset($helper->fee_content))       $helper->fee_content = "";
  if (!isset($helper->show_head_fields))  $helper->show_head_fields = true;
  if (!isset($helper->show_xtra_field))   $helper->show_xtra_field = true;
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
  <div class="doc_section">
    <?php $form->getDocumentDate()?>
    
    <?php if (!empty($helper->title)): ?>
      <span class="larger_font"><?php echo str_repeat('&nbsp;', 22).$helper->title?></span>
    <?php endif; ?>
      
    <br/><br/>
    
    <?php if ($helper->show_head_fields): ?>
      <?php echo $form['field4']->renderRow() ?>
    
      <?php if (!empty($helper->abn)): ?>
        <b><?php echo str_repeat('&nbsp;', 78).$helper->abn?></b>
      <?php endif; ?>  
        
      <br/>
      <?php echo $form['field5']->renderRow() ?>
      <p>Dear <?php echo $form['field6']->renderRow() ?><p>
    <?php endif; ?>
      
    <?php if ( isset($form['field10']) && ($helper->show_xtra_field) ): ?>
      <?php echo $form['field10']->renderRow()?><br/>
    <?php endif; ?>
      
    <?php echo $form['field7']->renderRow() ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php echo $form['field8']->renderRow() ?>
  </div>
  <div class="doc_section">
    
    <?php if (!empty($helper->fee_content)): ?>

      <?php echo str_replace(array('%%client%%', '%%solicitor%%'), array($form['field4']->renderRow(), $form['field9']->renderRow()), $helper->fee_content) ?><br/>
    
    <?php else: ?>
    
      <?php 
        if (isset($form['field18'])) {
          echo $form['field16']->renderRow(); 
          echo $form['field18']->renderRow();
        }
      ?>
      
      <?php if (!empty($helper->pre_text)): ?>
        <?php echo $helper->pre_text ?><br/>
      <?php endif; ?>
      
      <?php echo $form['field17']->renderRow() ?>
        
      <?php if (!empty($helper->post_text)): ?>
        <?php echo $helper->post_text ?><br/>
      <?php endif; ?>
      
      <?php if (isset($form['field9'])): ?>
        <p class="final_greetings">Yours faithfully</p>
        <?php echo $form['field9']->renderRow() ?>
      <?php endif; ?>
      
      <?php if (!empty($helper->final_text)): ?>
        <?php echo $helper->final_text ?><br/>
      <?php endif; ?>  
        
    <?php endif; ?>
      
  </div>
  <!--<div class="doc_footer"></div>-->
</div>