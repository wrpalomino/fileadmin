<?php if (!isset($helper->top_title)) $helper->top_title = "APPLICATION FOR BAIL" ?>
<?php if (!isset($helper->court_title)) $helper->court_title = "" ?>
<?php 
  if (!isset($helper->prv_bail_content))
    $helper->prv_bail_content = "THERE HAS BEEN NO BAIL FIXED OR PREVIOUSLY REFUSED";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center"><h3 class="important"><?php echo $helper->top_title ?></h3></div>
  </div>
  <div class="doc_section">
    <p><?php echo $form['field13']->renderRow() //$helper->court_title?></p>
    APPLICANT’S DETAILS<br/>
    <table class="fax with_border smaller_font">
    <tr>
      <td class="label">Applicant&nbsp;Name:</td>
      <td colspan="3"><?php echo $form['field4']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Address&nbsp;(Prison):</td><td class="field"><?php echo $form['field5']->renderRow() ?></td>
      <td class="label">Date&nbsp;of&nbsp;Birth:</td><td class="field"><?php echo $form['field3']->renderRow() ?></td>
    </tr>
    </table>
    <br/>
    CHARGE DETAILS<br/>
    <table class="fax with_border smaller_font">
    <tr>
      <td class="label">Case&nbsp;Number:</td><td class="field"><?php echo $form['field6']->renderRow() ?></td>
      <td class="label"></td><td class="field"></td>
    </tr>
    <tr>
      <td class="label">Respondent&nbsp;(Informant):</td><td class="field"><?php echo $form['field10']->renderRow() ?></td>
      <td class="label">Reg.&nbsp;No</td><td class="field"><?php echo $form['field15']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Charges:</td><td colspan="3"><?php echo $form['field17']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Nature of proceedings:</td><td colspan="3"><?php echo $form['field16']->renderRow() ?></td>
    </tr>
    <tr>
      <td colspan="4" class="smaller_font">
        Date and Place where the Applicant is required to appear to answer charges:<br/>
        <?php echo $form['field8']->renderRow() ?>&nbsp;&nbsp;at&nbsp;&nbsp;
        <?php echo $form['field7']->renderRow() ?>
      </td>
    </tr>
    </table>
    <br/>
    PREVIOUS BAIL APPLICATIONS<br/>
    <div class="smaller_font with_border" style="padding:4px"><?php echo $helper->prv_bail_content ?></div>
    <br/>
    CO-ACCUSED DETAILS<br/>
    <div class="smaller_font with_border" style="padding:4px"><?php echo $form['field18']->renderRow() ?></div>
    <br/>
    HEARING DETAILS FOR THIS APPLICATION<br/>
    <div class="smaller_font with_border" style="padding:4px">
        TAKE NOTICE that the applicant intends to apply for bail at the Magistrates’ Court at Victoria<br/>
        sitting at <?php echo $form['DocumentDetail']['field1']->renderRow() ?> 
        on <?php echo $form['DocumentDetail']['field2']->renderRow() ?>
        <div style="float:right"><?php echo $form['DocumentDetail']['field3']->renderRow() ?></div>
        <div class="clear"></div><?php echo $form['DocumentDetail']['field4']->renderRow() ?>
        Estimated Duration <?php echo $form['DocumentDetail']['field5']->renderRow() ?>
    </div>
  </div>
  <div class="doc_section">
    <table class="fax smaller_font">
    <tr>
      <td><br/>Dated at _______________________ on <?php $form->getDocumentDate("d/m/Y")?></td>
      <td>
        <div class="imgHover" id="signatureDiv"><?php echo image_tag("signatures/default.png", array('alt' => 'Signature', 'title' => 'Signature', 'id' => 'signature')); ?></div>
        Applicant’s Legal Practitioner
      </td>
    </tr>  
    </table>
    <table class="fax compact smaller_font">
    <tr><td colspan="3"><b>TO</b> (please tick)</td></tr>
    <tr>
      <td rowspan="4"><?php echo $form['field14']->renderRow() ?></td>
      <td>Name:</td><td><?php echo $form['field9']->renderRow() ?></td>
    </tr>
    <tr><td>Phone:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>Fax:<br/></td><td><?php echo $form['field12']->renderRow() ?><br/></td></tr>  
    <tr><td>Email:</td><td><?php echo $form['field2']->renderRow() ?></td></tr>
    </table>
  </div>
  <div class="doc_footer"></div>
</div>