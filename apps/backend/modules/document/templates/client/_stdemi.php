<?php 
  if (!isset($helper->pre_text)) $helper->pre_text = "<b>Do solemnly and sincerely declare that:</b>"; 
  if (!isset($helper->post_text)) 
    $helper->post_text = "<b>I acknowledge that this statement is true and correct and that I make it in 
    the belief that a person making a false statement is liable to the penalties for perjury.</b>"; 
  if (!isset($helper->sign_text)) 
    $helper->sign_text = "<tr><td colspan='2'><br/>(The witness must print their name,address and their authority 
      under section 107A of the Evidence Act 1958 to witness a statutory declaration)</td></tr>";
  if (!isset($helper->declare_text)) 
    $helper->declare_text = "Declared at: ____________________________<br/>
    In the State of Victoria<br/>
    this day ___________ of _____________________
    <table class='fax'>
    <tr>
      <td></td>
      <td style='text-align:center'>
        <br/><br/>.............................................................................................</br>
        (signature of declarant)
      </td>
    </tr>
    <tr>
      <td>Before&nbsp;me:&nbsp;</td>
      <td style='text-align:center'>
        <br/><br/>.............................................................................................</br>
        (signature of authorised witness)
      </td>
    </tr>
    ".$helper->sign_text."
    </table>";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center"><h2>STATUTORY DECLARATION</h2></div><br/>
    <table>
    <tr><td class="label">I,</td><td class="field"><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td class="label">Of</td><td class="field"><?php echo $form['field5']->renderRow() ?></td></tr>
    <tr><td class="label">Occupation: </td><td class="field"><?php echo $form['field2']->renderRow() ?></td></tr>
    </table>
  </div>
  <div class="doc_section">
    <?php echo $helper->pre_text?><br/>
    <?php echo $form['field17']->renderRow() ?>
    <?php echo $helper->post_text?><br/><br/>
    <?php echo $helper->declare_text?>
  </div>  
  <div class="doc_footer"></div>
</div>