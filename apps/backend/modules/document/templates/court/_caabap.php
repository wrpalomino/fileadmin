<?php if (!isset($helper->form_number)) $helper->form_number = "FORM 15" ?>
<?php if (!isset($helper->rule_number)) $helper->rule_number = "Rule 28" ?>
<?php if (!isset($helper->top_title)) $helper->top_title = "CASE ABRIDGEMENT APPLICATION" ?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <br/> <?php //Magistrates’ Court Criminal Procedure Rules 2009 ?>
      <br/><b><?php echo $helper->form_number ?></b>
    </div>
    <b><?php echo $helper->rule_number ?></b>
    <p class="subtitle centered"><?php echo $helper->top_title ?></p><br/>
  </div>
  
  <div class="doc_section">
    <div style="float:left"><?php echo $form['field7']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    
    <table class="fax">
    <tr><td class="fourth">Applicant:</td><td><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td>Date of Application:</td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>Name of Accused:</td><td><?php echo $form['field6']->renderRow() ?></td></tr>
    <tr><td>Date of Birth:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>Current Hearing Date:</td><td><?php echo $form['field8']->renderRow() ?></td></tr>
    <tr><td>Abridgement Date:</td><td><?php echo $form['field12']->renderRow() ?></td></tr>
    <tr><td>Reason&nbsp;for&nbsp;Abridgement:</td><td><?php echo $form['field17']->renderRow() ?></td></tr>
    <tr><td>Abridged by consent:</td><td><?php echo $form['field13']->renderRow() ?></td></tr>
    <tr><td>Accused in Custody:</td><td><?php echo $form['field14']->renderRow() ?></td></tr>
    <tr><td>Notice given to central prisoner records:</td><td><?php echo $form['field15']->renderRow() ?></td></tr>
    <tr><td>Application filed by:</td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>Signature of Applicant:</td><td><br/><br/>______________________________</td></tr>
    <tr><td>Date:</td><td><?php $form->getDocumentDate("d F Y")?></td></tr>
    </table>
    
  </div>
  <div class="doc_footer"></div>
</div>