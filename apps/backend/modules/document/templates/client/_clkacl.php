<?php
  if (!isset($helper->title)) $helper->title = 'CentreLink Authority';
  if (!isset($helper->hereby_text)) $helper->hereby_text = 'hereby authorize:';
  if (!isset($helper->content_text))
    $helper->content_text = "to access any of my details held at CentreLink either electronically 
    or otherwise. That includes but is not limited to confirmation of my eligibility for a 
    HealthCare card, what entitlement I receive and whether or not the payment status is current.<br/> 
    This authority is intended to be ongoing unless expressly revoked which can be done at any 
    stage by contacting us either in writing or verbally informing us of the same";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center"><h3><?php echo $helper->title ?></h3></div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <?php if (isset($form['field3'])): ?>
      <tr><td class="label">To:</td><td class="field"><?php echo $form['field3']->renderRow() ?></td></tr>
    <?php endif; ?>
    <tr><td class="label">I,</td><td class="field"><?php echo $form['field4']->renderRow() ?></td></tr>
    <?php if (isset($form['field5'])): ?>
      <tr><td class="label">Of</td><td class="field"><?php echo $form['field5']->renderRow() ?></td></tr>
    <?php endif; ?>
    </table>
    <?php if (isset($form['field1'])) : ?>
      <br/>Date of Birth: &nbsp;&nbsp;<?php echo $form['field1']->renderRow() ?>
    <?php endif; ?>
    <?php if (isset($form['field2'])) : ?>
      <br/>CentreLink CRN: *&nbsp;&nbsp;<?php echo $form['field2']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[* Must be provided]
    <?php endif; ?>
    
    <p><?php echo $helper->hereby_text ?></p>
    <?php echo $form['field9']->renderRow() ?><br/>
    <?php echo $form['field8']->renderRow() ?><br/>
  </div>
  <div class="doc_section">
    <div><?php echo $helper->content_text ?></div>
      <p class="final_greetings">
        <?php if (!isset($helper->dont_show_sign)) echo "<br/>Signed: __________________________<br/>" ?>
      </p>
    Date: <?php $form->getDocumentDate("D j F Y")?>
  </div>
  <div class="doc_footer">
  </div>
</div>