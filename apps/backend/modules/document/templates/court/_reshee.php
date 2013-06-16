<?php 
  $dob_detail = isset($helper->dob_detail) ? $helper->dob_detail : "";
  if (!isset($helper->court_line)) $helper->court_line = "";
  if (!isset($helper->court_date)) $helper->court_date = $form->getDocumentDate("D j F Y", 'span', true, false);
?>
<div class="doc_container" id="doc_container">
  
  <div class="doc_section">
    <div style="float:left">
      <?php echo $form['field9']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo $form['field2']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo '<span class="smaller_font">'.$dob_detail.'</span>' ?>
    </div>
    <div style="float:right;padding-right:5px">
      <span class="doc_field with_border centered">&nbsp;&nbsp;<?php echo $helper->court_date ?>&nbsp;&nbsp;</span>
    </div>
  </div>
  
  <div class="doc_section">
    <div style="float:left;width:18%;padding:2px;margin:0px;position:relative"><?php echo $form['field1']->renderRow() ?>&nbsp;</div>
    <div style="float:left;width:45%;padding:2px;margin:0px;position:relative">
      <?php echo $form['field4']->renderRow() ?><br/>
      <?php echo $form['field5']->renderRow() ?>
    </div>
    <div style=float:right;text-align:right;width:35%;padding:2px;margin:0px;position:relative">
      <table class="smaller_font">
      <tr><td>Home: <br/>Work: <br/>Mobile: </td><td><?php echo $form['field3']->renderRow() ?></td></tr>
      <tr><td>Email: </td><td style="text-align:left"><?php echo $form['field16']->renderRow() ?></td></tr>
      </table>
    </div>
  </div>
  
  <div class="doc_section">
    <div>
      <table class="fax">
      <tr>
        <td><?php echo $form['field6']->renderRow() ?></td>
        <td><?php echo $form['field8']->renderRow() ?></td>
        <td style="padding-right:8px"><?php echo $form['field10']->renderRow() ?></td>
      </tr>
      <tr class="smaller_font"><td>Informant</td><td>Prosecutor</td><td>Coram</td></tr>
      </table>
    </div>
    <div>
      <div style="float: left">
        <table>
        <tr><td class="label smaller_font">Court: </td><td class="field"><?php echo $form['field7']->renderRow() ?></td></tr>
        <tr><td class="label smaller_font">Listing Status: </td><td class="field"><?php echo $form['field12']->renderRow() ?></td></tr>
        <tr><td class="label smaller_font">Bail Status: </td><td class="field"><?php echo $form['field13']->renderRow() ?></td></tr>
        </table>
      </div>
      <div style="float: right">Case Number:<?php echo $form['field11']->renderRow() ?></div>
    </div>
    <div style="clear: both">
      <p>
        Adjourned: <?php echo $form['field14']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        for: <?php echo $form['field15']->renderRow() ?>
      </p>
    </div>
  </div>
  
  <div class="doc_section">
    <div style="float: left;width: 48%">
      Charges:<br/>
      <?php echo $form['field17']->renderRow() ?>
    </div>
    <div style="float: right;width: 48%;margin-right: 5px">
      COURT RESULT:<br/>
      <?php echo $form['field18']->renderRow() ?>
    </div>
    <div style="clear: both">
      <br/>
      <table class="fax with_border">
      <tr style="text-align: center">
        <td>Date</td><td>Court</td><td>Listing</td><td>Solicitor</td><td>Judge/Mag</td>
      </tr>
      <?php echo $helper->court_line ?>
      </table>
    </div>
  </div>
  
  <!--<div class="doc_footer"></div>-->
</div>