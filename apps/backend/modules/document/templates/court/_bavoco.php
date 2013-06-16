<?php if (!isset($helper->court_title)) $helper->court_title = "" ?>
<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <br/><span class="important">BAIL ACT 1977</span>
      <br/><span class="important">APPLICATION FOR VARIATION OF BAIL</span>
    </div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td colspan="2"><?php echo $form['field13']->renderRow() //$helper->court_title?></td>
      <td class="label">CASE&nbsp;No:</td><td class="field"><?php echo $form['field6']->renderRow() ?></td>
    </tr>  
    <tr>
      <td class="label">APPLICANT</td><td class="field"><?php echo $form['field4']->renderRow() ?></td>
      <td class="label" rowspan="2">D.O.B.:</td><td class="field" rowspan="2"><?php echo $form['field3']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">ADDRESS</td><td class="field"><?php echo $form['field5']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">RESPONDENT</td><td class="field"><?php echo $form['field10']->renderRow() ?></td>
      <td class="label">REG.&nbsp;No</td><td class="field"><?php echo $form['field15']->renderRow() ?></td>
    </tr>
    <tr>
      <td colspan="4">
        The defendant was released on bail to appear at:<br/>
        <?php echo $form['field7']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form['field8']->renderRow() ?><br/>
        With the following conditions:<br/>
        <?php echo $form['field16']->renderRow() ?>
        Under Section 25 of the Bail Act 1977, it has become necessary or advisable in the interests 
        of justice to amend or supplement the conditions of bail. The amendment or supplement sought 
        is as follows;
      </td>
    </tr>
    </table>
    <br/>
    <table class="fax">
    <tr><td colspan="2"><?php echo $form['field17']->renderRow() ?></td></tr>
    <tr>
      <td>
        Dated at <?php echo $form['field11']->renderRow() ?> 
        on <?php $form->getDocumentDate("d F Y")?></td>
      <td>
        <div align="center">
          <br/>________________________
          <br/><?php echo $form['field9']->renderRow() ?>
          <br/>Solicitor for Applicant
        </div>
      </td>
    </tr>
    </table>
    
  </div>
  <div class="doc_section">
    <table class="fax with_border smaller_font">
    <tr>
      <td>
        THIS APPLICATION WILL BE HEARD BY THE MAGISTRATES’ COURT AT _______________<br/>
        at 10.00 am on __________________
      </td>  
    </tr>
    </table>
    <table class="fax">
    <tr>
      <td>Filed: ___________________________</td>
      <td><div align="center"><br/>____________________<br/>Registrar</div></td>
    </tr>
    </table>
  </div>
  <div class="doc_footer"></div>
</div>