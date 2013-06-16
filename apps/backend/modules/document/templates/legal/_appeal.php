<?php 
  if (!isset($helper->title)) $helper->title = "COUNTY COURT APPEAL WORKSHEET";
  
  if (!isset($helper->content_text)) $helper->content_text = "
  <p>Practitioners should only recommend the granting of assistance for a County Court Appeal where:</p>
  <i>There are reasonable grounds for the appeal AND the practitioner has had regard for the nature and
  extent of any benefit that may accrue by a person, the public or section of the public for the 
  provision of legal assistance.</i>
  <p>".$form['field4']->renderRow()."&nbsp;Copy of Notice of Appeal on file
  <br/>".$form['field5']->renderRow()."</p>
  <p>Full details of the charges, ".$form['field6']->renderRow()."&nbsp;or REFER TO CHARGE SHEETS</p>
  <p>".$form['field7']->renderRow()."".$form['field17']->renderRow()."</p>
  <p>".
    $form['field8']->renderRow()."&nbsp;
    Assessment of the strengths and weaknesses of the appeal, whether in respect of conviction and/or 
    sentence.<br/>".$form['field18']->renderRow()."
  </p>
  <p>".
    $form['field9']->renderRow()."&nbsp;
    Indication of the likely appropriate penalty that the applicant should have received, and the reasons 
    why.<br/>".$form['field19']->renderRow()."
  </p>";
  
  if (!isset($helper->low_content_text)) $helper->low_content_text = "";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div style="float:left">
      <?php echo $form['field2']->renderRow()?><br/>
      <?php echo $form['field1']->renderRow()?><br/><br/>
      <h2><?php echo $helper->title?></h2>
    </div>
    <div style="float:right">
      <?php echo image_tag('legal_aid_logo.jpg', array('alt' => 'Magistrate Court', 'class' => 'legalAidLogo')); ?>
    </div>
    <div class="clear"></div>
  </div>
  
  <div class="doc_section">
    
    <?php echo $helper->content_text?>
    <?php echo $helper->low_content_text?>
    
  </div>
  
  <div class="doc_section"
    <p>
      Practitioner:<?php echo $form['field3']->renderRow()?><?php echo str_repeat("&nbsp;",30)?>
Date: <?php $form->getDocumentDate()?>
    </p>
  </div>  
  <div class="doc_footer"></div>
</div>