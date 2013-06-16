<?php 
  if (!isset($helper->title)) $helper->title = "AFFIDAVIT";
 
  if (!isset($helper->aff_text)) $helper->aff_text = "Make oath and say:-"; 
  if (!isset($helper->sworn_text)) $helper->sworn_text = "SWORN"; 
  if (!isset($helper->sign_text)) $helper->sign_text = "[name, address and title of person taking affidavit who is 
    duly authorised under Section 123c of the Evidence Act 1958 ]";
 
  if (!isset($helper->top_header_section)) $helper->top_header_section = '';
  
  if (!isset($helper->header_section)) 
    $helper->header_section = "<p>IN THE MATTER OF:</p>
    <p>".$form['field10']->renderRow()."</p>V.<p>".$form['field4']->renderRow()."</p>";
  
  if (!isset($helper->declaration_text)) 
    $helper->declaration_text = "<table>
    <tr><td class='label'>I,</td><td class='field'>".$form['field4']->renderRow()."</td></tr>
    <tr><td class='label'>Of</td><td class='field'>".$form['field5']->renderRow()."</td></tr>
    <tr><td class=''label'>Occupation: </td><td class='field'>".$form['field13']->renderRow()."</td></tr>
    </table>";
  
  if (!isset($helper->low_content_text)) 
    $helper->low_content_text = $helper->aff_text."<br/>".$form['field17']->renderRow()."
    <p>".$helper->sworn_text." at ________________________________<br/>
      In the State of Victoria<br/>
      this ____________________________________
    </p>";
  
  if (!isset($helper->footer_section)) 
    $helper->footer_section = '<div style="float:left; width: 10%">Before&nbsp;me:&nbsp;</div> 
    <div style="float:left; width: 90%">
      <br/>'.str_repeat('.',140).'
      <br/><span class="smaller_font">'.$helper->sign_text.'</span>
    </div>';
  
  if (!isset($helper->show_table)) $helper->show_table = true;
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <?php echo $helper->top_header_section?>
    
    <p><?php echo $form['field7']->renderRow() ?></p>

    <?php echo $helper->header_section?>
    <div align="center"><h3 class="important"><?php echo $helper->title?></h3></div>
    
    <?php if ($helper->show_table): ?>
      <hr class="division" />
      <table class="fax">
      <tr><td>Date&nbsp;of&nbsp;document: </td><td colspan="3"><?php $form->getDocumentDate("D, j F Y")?></td></tr>
      <tr><td>Filed on behalf of: </td><td colspan="3"><?php echo $form['field11']->renderRow() ?></td></tr>
      <tr><td>Prepared by: </td><td colspan="3"><?php echo $form['field12']->renderRow() ?></td></tr>
      <tr>
        <td>Solicitor name: </td><td><?php echo $form['field9']->renderRow() ?></td>
        <td>Telephone: </td><td><?php echo $form['field2']->renderRow() ?></td>
      </tr>
      <tr>
        <td rowspan="3">Firm: </td><td rowspan="3"><?php echo $form['field8']->renderRow() ?></td>
        <td>Facsimile: </td><td><?php echo $form['field3']->renderRow() ?></td>
      </tr>
      <tr><td>File Ref: </td><td><?php echo $form['field1']->renderRow() ?></td></tr>
      <tr><td>Solicitor's&nbsp;Code: </td><td><?php echo $form['field6']->renderRow() ?></td></tr>
      </table>
      <hr class="division" />
    <?php endif; ?>
    
    <?php echo $helper->declaration_text?>
    
  </div>
  <div class="doc_section">
    <?php echo $helper->low_content_text?>
    <?php echo $helper->footer_section?>
  </div>  
  <div class="doc_footer"></div>
</div>