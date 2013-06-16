<?php
  if (!isset($helper->show_question)) $helper->show_question = true;
  if (!isset($helper->title))         $helper->title = "Case Study";
  if (!isset($helper->charge_list))   $helper->charge_list = "";
  if (!isset($helper->top_text)) 
    $helper->top_text = "**Please just fill in boxes 1, 2 and 3. Use the tab key to move through fields and then email";
?>

<div class="doc_container" id="doc_container">
  
  <div class="single_page">
  
    <div class="doc_header three_fourth">
      <div align="center"><h2 class="largest_font"><?php echo $helper->title ?></h2></div>
      <?php echo $form['field4']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $form['field1']->renderRow() ?>
    </div>
    <div class="doc_logo fourth">
      <br/><?php $form->getDocumentDate("H:i:s A", 'span', false)?>
      <br/><?php $form->getDocumentDate("j F Y")?>&nbsp;
    </div>
    <div class="doc_section">
      <p><?php if (!empty($helper->top_text)) echo $helper->top_text ?></p>
      <table class="fax">
      <tr><td>Date:   </td><td><?php echo $form['field8']->renderRow() ?></td></tr>
      <tr><td>At:     </td><td><?php echo $form['field7']->renderRow() ?></td></tr>
      <tr><td>Who:    </td><td><?php echo $form['field9']->renderRow() ?></td></tr>
      <tr><td>Before: </td><td><?php echo $form['field6']->renderRow() ?></td></tr>
      </table>  
    </div>
    
    <div class="doc_section">
      <?php if ($helper->show_question): ?>
        <ol>
          <li>Place of offence<br/><?php echo $form['field5']->renderRow() ?></li>
          <li>Brief summary of Facts<br/><?php echo $form['field18']->renderRow() ?></li>
          <li>Why good result and how did you get it?<br/><?php echo $form['field19']->renderRow() ?></li>
        </ol>
      <?php else: ?>
        <?php echo $form['field17']->renderRow() ?>
      <?php endif; ?>
    </div>
    <!--<div class="doc_footer"></div>-->
    
  </div>
 
  <?php if ($helper->show_question): ?>
  
    <div class="single_page">

      <div class="doc_header three_fourth">
        <div align="center"><h2 class="largest_font"><?php echo $helper->title ?></h2></div>
        <?php echo $form['field4']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form['field1']->renderRow() ?>
      </div>
      <div class="doc_logo fourth">
        <br/><?php $form->getDocumentDate("H:i:s A", 'span', false)?>
        <br/><?php $form->getDocumentDate("j F Y", 'span', false)?>&nbsp;
      </div>
      <div class="doc_section">
        <p><?php if (!empty($helper->top_text)) echo $helper->top_text ?></p>
        <table class="fax">
        <tr><td>Charges:   </td><td><?php echo $helper->charge_list ?></td></tr>
        <tr><td>Result:    </td><td><?php echo $form['field17']->renderRow() ?></td></tr>
        </table>  
      </div>
      <!--<div class="doc_footer"></div>-->

    </div>
  
  <?php endif; ?>
  
</div>