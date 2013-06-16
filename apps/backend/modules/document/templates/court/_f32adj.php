<?php if (!isset($helper->form_number)) $helper->form_number = "FORM 32" ?>
<?php if (!isset($helper->rule_number)) $helper->rule_number = "Rule 48" ?>
<?php if (!isset($helper->top_title)) $helper->top_title = "<b>CASE DIRECTION NOTICE</b><br/>(section 119 of the <b>Criminal Procedure Act 2009)</b>" ?>
<?php if (!isset($helper->court_title)) $helper->court_title = "" ?>
<?php if (!isset($helper->address_text)) $helper->address_text = "" ?>
<?php if (!isset($helper->questions)) 
  $helper->questions = "9. The accused and the DPP or Informant seek an adjournment of the committal proceedings<br/>
    Reason (s) for the adjournment:<br/>".$form['field17']->renderRow(); 
?>

<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <br/>Magistrates’ Court Criminal Procedure Rules 2009
      <br/><b><?php echo $helper->form_number ?></b>
    </div>
    <b><?php echo $helper->rule_number ?></b>
    <div align="center"><?php echo $helper->top_title ?></div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td><?php echo $form['field7']->renderRow() ?></td>
      <td style="text-align:right">Court&nbsp;Reference: <?php echo $form['field6']->renderRow() ?></td>
    </tr>  
    <tr>
      <td colspan="2">
        BETWEEN:<br/>
        <?php echo $form['field10']->renderRow() ?><br/>
        v.<br/>
        <?php echo $form['field4']->renderRow() ?><br/><br/>
        Committal mention date: <?php echo $form['field11']->renderRow() ?><br/>
      </td>
    </tr>
    </table>
    <br/>
    
    <?php if ($helper->form_number == "FORM 25"): ?>
    
      <div align="center">APPEARANCE</div><br/>
      TAKE NOTICE THAT the legal practitioner indicated below represents the accused and is willing 
      to accept service of documents on behalf of the accused
    
    <?php else :?>
      <p>To: <span class="important">The Registrar</span></p>
      <table class="fax with_border">
      <tr><td colspan="2">&nbsp;&nbsp;&nbsp;Take NOTICE that - </td></tr>
      <tr>
        <td><input type="checkbox" name="notice1" value="notice1"></td>
        <td>the Defendant’s legal practitioner has read the brief of evidence</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="notice2" value="notice2"></td>
        <td>the Director of Public Prosecutions has read the brief of evidence</td>
      </tr>
      <tr>
        <td><input type="checkbox" name="notice3" value="notice3"></td>
        <td>
          the Defence and the Director of Public Prosecutions have discussed whether this matter 
          can be resolved by *a plea\ *pleas of guilty and, if so, on what charge(s).
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="notice4" value="notice4"></td>
        <td>
          the accused and the DPP or informant propose that this committal proceeding be dealt 
          with as follows - 
        </td>
      </tr>
      </table>
      <br/><?php echo $helper->questions; ?>
    
    <?php endif; ?>
    
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr><td colspan="2">Date: <?php $form->getDocumentDate()?></td></tr>
    <tr><td>Signature&nbsp;of&nbsp;defendant’s&nbsp;legal&nbsp;practitioner:</td><td>_________________________</td></tr>
    <tr><td>Name of legal practitioner:</td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>Name of legal practitioner (or firm):</td><td>Martinez & Morgan</td></tr>
    
    <?php if ($helper->form_number == "FORM 25"): ?>
    
    <tr><td></td><td><?php echo $helper->address_text?></td></tr>
      <tr><td>Facsimile number: </td><td><?php echo sfConfig::get('app_appowner_fax') ?></td></tr>
      <tr><td>Phone number: </td><td><?php echo sfConfig::get('app_appowner_phone') ?></td></tr>
      <tr><td>Email address of legal practitioner: </td><td><?php echo $form['field2']->renderRow() ?></td></tr>
      <tr><td>Present address of accused:</td><td><?php echo $form['field5']->renderRow() ?></td></tr>
    
    <?php else: ?>
    
      <tr><td></td><td></td></tr>
      <tr><td colspan="2">Date: _________________</td></tr>
      <tr>
        <td>Signature:</td>
        <td>
          <div align="center">
            ____________________________________________<br/>
            for or on behalf of the Director of Public Prosecutions
          </div>
        </td>
      </tr>
    
    <?php endif; ?>
    
    </table>
  </div>
  <div class="doc_footer"></div>
</div>