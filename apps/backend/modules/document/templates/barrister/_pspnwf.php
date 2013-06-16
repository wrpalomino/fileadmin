<?php 
  if (!isset($helper->barrister_text)) $helper->barrister_text = "<tr><td>Barrister:</td></tr>
    <tr><td>".$form['field5']->renderRow()."</td></tr>";
?>
<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div style="float:left; width:60%; padding-top:10px">
      <?php echo $form['field17']->renderRow() ?>
    </div>
    <div style="float:right; width:38%; margin-right:5px">
      <div align="center">
        <p>
          <b>Martinez&nbsp;&amp;&nbsp;Morgan</b>
          <hr class="division">
          BARRISTERS & SOLICITORS
        </p>
      </div>
      <div style="border-left:solid 3px #000;margin-left:40px;padding-left:10px">
        <p>
          <b>Address</b><br/>
          <?php echo $form['field8']->renderRow() ?>
        </p>
        <p>
          <b>Telephone</b><br/>
          <?php echo $form['field2']->renderRow() ?>
        </p>
        <p>
          <b>Facsimile</b><br/>
          <?php echo $form['field3']->renderRow() ?>
        </p>
        <p>
          <b>Reference</b><br/>
          <?php echo $form['field1']->renderRow() ?>
        </p>
      </div>
        
      <table class="with_border">
      <tr><td><?php echo $form['field4']->renderRow() ?></td></tr>
      <tr><td style="height:260px">&nbsp;</td></tr>
      <tr><td>Informant:</td></tr>
      <tr><td><?php echo $form['field10']->renderRow() ?></td></tr>
      <?php echo $helper->barrister_text ?>
      </table> 
    </div>
  </div>
  <!--<div class="doc_footer"></div>-->
</div>