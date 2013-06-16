<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div>
      <h2 class="centered">COMPLIANCE FILE NOTE</h2>
      <div style="float:left">
        <?php echo $form['field4']->renderRow()?><br/>
        <?php echo $form['field1']->renderRow()?>
      </div>
      <div style="float:right"><?php $form->getDocumentDate()?></div>
    </div>    
  </div>
  
  <div class="doc_section">
    
    <table class="fax">
    <tr><td class="right">Date of original grant:</td><td><?php echo $form['field5']->renderRow()?></td></tr>
    <tr><td class="right">Correct Category applied in (specify):</td><td><?php echo $form['field6']->renderRow()?></td></tr>
    <tr><td colspan="2"><b>Proof of means</b></td></tr>
    <tr><td class="right">&GT;12 months new proof of means:</td><td><?php echo $form['DocumentDetail']['field1']->renderRow()?></td></tr>
    <tr><td class="right">when got new proof of means:</td><td><?php echo $form['field7']->renderRow()?></td></tr>
    <tr><td class="right">&GT;2 years new proof of means:</td><td><?php echo $form['DocumentDetail']['field2']->renderRow()?></td></tr>
    <tr><td class="right">when got new proof of means:</td><td><?php echo $form['field8']->renderRow()?></td></tr>
    <tr><td class="right">release from custody proof of means:</td><td><?php echo $form['DocumentDetail']['field3']->renderRow()?></td></tr>
    <tr><td colspan="2"><b>Employment issues</b></td></tr>
    <tr><td class="right">Bank statements for 3 months:</td><td><?php echo $form['DocumentDetail']['field4']->renderRow()?></td></tr>
    <tr><td class="right">Recent payslip/employer letter:</td><td><?php echo $form['DocumentDetail']['field5']->renderRow()?></td></tr>
    <tr><td class="right">Separation certificate:</td><td><?php echo $form['DocumentDetail']['field6']->renderRow()?></td></tr>
    <tr><td class="right">Docs for self-employed:</td><td><?php echo $form['DocumentDetail']['field7']->renderRow()?></td></tr>
    <tr><td colspan="2"><b>General issues</b></td></tr>
    <tr><td class="right">Letter advising of new address:</td><td><?php echo $form['DocumentDetail']['field8']->renderRow()?></td></tr>
    <tr><td class="right">Details for Caveat provided:</td><td><?php echo $form['DocumentDetail']['field9']->renderRow()?></td></tr>
    <tr><td class="right">Client Instructions:</td><td><?php echo $form['field18']->renderRow()?></td></tr>
    <tr><td class="right">Charges:</td><td><?php echo $form['field17']->renderRow()?></td></tr>
    <tr><td class="right">Priors:</td><td><?php echo $form['field14']->renderRow()?></td></tr>
    <tr><td class="right">Contest mention proof of Negotiations:</td><td><?php echo $form['DocumentDetail']['field10']->renderRow()?></td></tr>
    <tr><td class="right">Final result letter sent:</td><td><?php echo $form['DocumentDetail2']['field1']->renderRow()?></td></tr>
    <tr><td colspan="2"><b>Centrelink</b></td></tr>
    <tr><td class="right">Centrelink CRN:</td><td><?php echo $form['field2']->renderRow()?></td></tr>
    <tr><td class="right">Expiry date on HCC:</td><td><?php echo $form['field3']->renderRow()?></td></tr>
    <tr><td class="right">Name of FAP:</td><td><?php echo $form['field10']->renderRow()?></td></tr>
    <tr><td class="right">Expiry date on FAP HCC:</td><td><?php echo $form['field11']->renderRow()?></td></tr>
    <tr><td class="right">FAP Bank statements for 3 months:</td><td><?php echo $form['DocumentDetail2']['field2']->renderRow()?></td></tr>
    <tr><td class="right">FAP Recent payslip/employer letter:</td><td><?php echo $form['DocumentDetail2']['field3']->renderRow()?></td></tr>
    <tr><td colspan="2"><b>Identify any issues with this grant of aid</b></td></tr>
    <tr><td class="right">Who do they live with? (not just faps):</td><td><?php echo $form['field12']->renderRow()?></td></tr>
    <tr><td class="right">Do they pay board? (amount):</td><td><?php echo $form['field13']->renderRow()?></td></tr>
    <tr><td colspan="2"><?php echo $form['field19']->renderRow()?></td></tr>
    </table>
    
    <div style="float:right">
      <p class=" centered">
        <br/><br/>_____________________________________<br/><?php echo $form['field9']->renderRow()?>
      </p>
    </div>
    <div class="clear"></div>
    <p class="subtitle">
      THIS IS A CONFIDENTIAL ASSESSMENT PAGE AND SHOULD BE TAKEN OFF BEFORE ANY FILE IS FORWARDED TO VLA
    </p>
    
  </div>
  <div class="doc_footer"></div>
</div>