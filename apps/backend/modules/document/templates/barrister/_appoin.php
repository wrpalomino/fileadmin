<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div style="float:left;width:48%;padding-top:10px">
      <?php echo $form['field17']->renderRow() ?>
    </div>
    <div style="float: right;width: 48%;margin-right: 5px">
      <p><?php echo $form['field7']->renderRow() ?></p><br/>
      <p>IN THE MATTER OF:</p>
      <?php echo $form['field10']->renderRow() ?>
      <p>V.</p>
      <?php echo $form['field4']->renderRow() ?>

      <p class="final_greetings">
      <hr class="division dotted">
      <br/>
      BRIEF TO APPEAR<br/>&nbsp;
      <hr class="division dotted"> 
      </p>
      
      <table>
      <tr><td>Date&nbsp;of&nbsp;hearing: </td><td><?php echo $form['field8']->renderRow() ?></td></tr>
      <tr><td>Listed for: </td><td colspan="3"><?php echo $form['field6']->renderRow() ?></td></tr>
      <tr><td>Barrister: </td><td colspan="3"><?php echo $form['field11']->renderRow() ?></td></tr>
      <tr><td>Clerk: </td><td><?php echo $form['field12']->renderRow() ?></td></tr>
      <tr><td>&nbsp;&nbsp;Phone: </td><td><?php echo $form['field13']->renderRow() ?></td></tr>
      <tr><td>&nbsp;&nbsp;Fax: </td><td><?php echo $form['field14']->renderRow() ?></td></tr>
      <tr><td>Fee: </td><td><?php echo $form['field15']->renderRow() ?></td></tr>
      </table>
      
      <br/><br/>
      <p>All fees include GST</p>
      
      <?php echo $form['field9']->renderRow() ?><br/>
      <?php echo $form['field3']->renderRow() ?>
      
      <p>Our Ref.&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form['field1']->renderRow() ?></p>
      
    </div>
  </div>
  <!--<div class="doc_footer"></div>-->
</div>