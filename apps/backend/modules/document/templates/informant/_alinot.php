<?php 
  if (!isset($helper->form_number)) $helper->form_number = "FORM 14";
  if (!isset($helper->rule_number)) $helper->rule_number = "Rule 26";
  if (!isset($helper->top_title))   $helper->top_title = "<b>NOTICE OF ALIBI<br/>(section 51 of the Criminal Form 14 Procedure Act 2009)</b>";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center"><b><?php echo $helper->form_number ?></b></div>
    <b><?php echo $helper->rule_number ?></b>
    <div align="center"><?php echo $helper->top_title ?></div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td><?php echo $form['field7']->renderRow() ?></td>
      <td style="text-align:right">Court&nbsp;Reference: <?php echo $form['field6']->renderRow() ?></td>
    </tr>  
    <tr><td colspan="2"><p>To the Prosecutor or Informant</p></td></tr>
    <tr><td>Informant: </td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>Accused: </td><td><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td>Charged filed on: </td><td><?php echo $form['field2']->renderRow() ?></td></tr>
    <tr><td>Nature of Offences: </td><td><?php echo $form['field5']->renderRow() ?></td></tr>
    </table>
    On <?php echo $form['field8']->renderRow() ?> in <?php echo $form['field3']->renderRow() ?> the 
    Accused will appear for the above offence<br/>
    Take notice that the Defendant intends to adduce at the hearing evidence in support of an alibi and 
    provides the following information in support of the alibi:*<br/>
    <!--<ol id="lower-alpha">
      <li>* [State the name of each witness the accused proposes to call];</li>
      <li>[State the current address of each witness, if known to the accused];</li>
      <li>[Last known address of each witness. If the name and address of a witness is not known, the 
        accused must state any information which might be of material assistance in finding the witness];</li>
      <li>[State the facts on which the accused relies].</li>
    </ol>-->
    <?php echo $form['field17']->renderRow() ?>
    <p class="smaller_font">
      <i>INFORMANT: Please note that section s399B of the Crimes Act prohibits you from questioning alibi 
      witnesses other than in our presence and with our consent and deems it a contempt of Court if you do so.</i>
    </p>
  </div>
  <!--<div class="doc_footer"></div>-->
</div>