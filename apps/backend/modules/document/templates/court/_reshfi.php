<?php
  if (!isset($helper->title))         $helper->title = "FINAL RESULT";
  if (!isset($helper->charge_list))   $helper->charge_list = "";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_header three_fourth">
    <div align="center">
      <h2 class="largest_font"><?php echo $helper->title ?></h2>
      <?php echo $form['field4']->renderRow() ?>
    </div>
  </div>
  <div class="doc_header fourth"><br/><br/><br/><br/><?php echo $form['field1']->renderRow() ?></div>
  <div class="doc_section">
    <?php echo $form['field5']->renderRow() ?>
    <table class="fax full">
    <tr>
      <td colspan="2">
        <table class="with_border">
        <tr><td>Date:     </td><td><?php echo $form['field8']->renderRow() ?></td></tr>
        <tr><td>Court:    </td><td><?php echo $form['field7']->renderRow() ?></td></tr>
        <tr><td>Listing:  </td><td><?php echo $form['field9']->renderRow() ?></td></tr>
        </table>
      </td>
      <td style="width:50px">Ph:&nbsp;Home<br/>Work<br/>Mobile</td>
      <td><?php echo $form['field3']->renderRow() ?></td>
    </tr>
    <tr><td>Informant: </td><td><?php echo $form['field10']->renderRow() ?></td><td colspan="2">&nbsp;</td></tr>
    </table>
  </div>
  <div class="doc_section">
    <br/><?php echo $helper->charge_list ?><br/>
    <?php echo $form['field17']->renderRow() ?>
  </div>
  
  <!--<div class="doc_footer"></div>-->
</div>