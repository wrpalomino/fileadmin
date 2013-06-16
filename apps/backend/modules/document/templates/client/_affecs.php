<?php
  if (!isset($helper->top_header_section)) $helper->top_header_section = '<div style="padding-left: 200px">
    <div style="width:200px">'.$form['field7']->renderRow().'</div><p>CRIMINAL DIVISION</p><br/>
    </div>';
  
  if (!isset($helper->header_section)) $helper->header_section = '<div style="padding-left: 200px">
    <p>BETWEEN:</p>'.$form['field10']->renderRow().'</br>
    - V -<br/>'.$form['field4']->renderRow().'
    </div><br/>';
  
  if (!isset($helper->declaration_text)) $helper->declaration_text = '<div align="center">
    <h3>CERTIFICATE IDENTIFYING EXHIBIT</h3></div><br/>
    <div style="margin:0px 50px">This is the Exhibit marked ________________________ now produced and shown 
    to _________________ at the time of swearing of their affidavit on _______________________________
    </div>';
  
  if (!isset($helper->footer_section)) $helper->footer_section = '';
?>
<div class="doc_container" id="doc_container">
  <div class="doc_section">
    
    <?php echo $helper->top_header_section?>
    <?php echo $helper->header_section?>
    <?php echo $helper->declaration_text?>
    <?php echo $helper->footer_section?>
    
  </div>
  <div class="doc_footer"></div>
</div>