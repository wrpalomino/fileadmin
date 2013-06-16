<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
    </div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td>&nbsp;</td>
      <td>
        <?php echo $form['field7']->renderRow() ?><br/><br/>
        BETWEEN:<br/><br/>
        <?php echo $form['field5']->renderRow() ?><br/><br/>
        AND<br/><br/>
        <?php echo $form['field4']->renderRow() ?><br/><br/>
      </td>
    </tr>
    <tr><td colspan="2"><div class="centered"><p><b>CERTIFICATE UNDER SECTION 17 OF THE APPEALS COSTS ACT 1998</b></p></div></td></tr>
    <tr><td>JUDGE:&nbsp;</td><td><?php echo $form['field3']->renderRow() ?></td></tr>
    <tr><td>DATE:&nbsp;</td><td><?php echo $form['field8']->renderRow() ?></td></tr>
    </table>
    
    <p>
      The Court grants a certificate under section 17 of the Appeal Costs Act 1998.<br/>
      The proceeding was adjourned by or on behalf of the Court.
    </p>
    
    <table class="fax">
    <tr>
      <td><?php echo $form['field6']->renderRow() ?></td>
      <td><div class="centered"><br/><br/><br/>___________________________<br/>Judge</div></td>
    </tr>
    </table>
    
  </div>
  <div class="doc_footer"></div>
</div>