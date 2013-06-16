<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      MAGISTRATES’ COURT CRIMINAL PROCEDURE RULES 2009
      <p class="subtitle">Form 13<br/><br/>WITNESS SUMMONS</p>
      <div style="padding:5px;position:absolute;top:40px">
        Rule 24
        <!--<div style="border:solid 2px;padding:5px">Form 13</div>-->
      </div>
    </div>
  </div>
  
  <div class="doc_section">
    <div style="float:left"><?php echo $form['field2']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    
    <br/>
    <div style="float:left;text-align:right;white-space:nowrap">
      To the Witness: [insert name]&nbsp;&nbsp;<br/>
      of [address]&nbsp;&nbsp;
    </div>
    <div style="float:left">
      <?php echo $form['field1']->renderRow() ?><br/>
      <?php echo $form['field15']->renderRow() ?>
    </div>
    <div class="clear"></div>
    <br/>
    
    <p class="subtitle">DETAILS OF THE CASE:</p>
    
    <table class="fax">
    <tr>
      <td class="third" style="white-space:nowrap">Name of person charged <span class="smaller_font">(Accused)</span>:</td>
      <td><?php echo $form['field4']->renderRow() ?></td>
    </tr>
    <tr><td valign="top">Summary of the charges:</td><td><?php echo $form['field18']->renderRow() ?></td></tr>
    <tr>
      <td>Who filed the charges? <span class="smaller_font">(Informant)</span>:</td>
      <td><?php echo $form['field10']->renderRow() ?></td>
    </tr>
    <tr><td>Agency and address:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr>
      <td colspan="2">
        Email address:&nbsp;&nbsp;<?php echo $form['field12']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
        Phone number:&nbsp;&nbsp;<?php echo $form['field13']->renderRow() ?>
      </td>
    </tr>
    </table>
    
    <br/><p class="subtitle">WHAT YOU HAVE TO DO:</p>
    <p>
      You must bring this summons with you and<br/>
      <?php echo str_replace(array('%%field17%%', '%%field19%%'), 
                             array('<br/>'.$form['field17']->renderRow(), '<br/>'.$form['field17']->renderRow()),
                             $form['DocumentDetail']['field1']->renderRow());
      ?>
    </p>
    <p>
      If you are required to give evidence, you must attend at the hearing.<br/>
      If you fail to attend the hearing or give evidence in accordance with this document a warrant for
      your arrest may be issued.<br/>
      You may produce this summons and the documents or things referred to above to the registrar of the 
      Magistrates' Court at [venue] <?php echo $form['DocumentDetail']['field2']->renderRow() ?> by hand 
      or by post, in either case so that the registrar receives them not later than 2 days (excluding 
      Saturdays, Sundays or other holidays) before the date on which you are required to attend.
    </p>
    
    <br/><p class="subtitle">WHERE WILL THE CASE BE HEARD?</p>
    <table class="fax">
    <tr><td colspan="4">The Magistrates Court at [venue]:&nbsp;&nbsp;<?php echo $form['field7']->renderRow() ?></td></tr>
    <tr>
      <td>Address:</td><td><?php echo $form['field5']->renderRow() ?></td>
      <td>Phone:</td><td><?php echo $form['field6']->renderRow() ?></td>
    </tr>
    <tr>
      <td>When:</td><td>Time:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form['field16']->renderRow() ?></td>
      <td>Date:</td><td><?php echo $form['field8']->renderRow() ?></td>
    </tr>
    </table>
    
    <br/><p class="subtitle">Details about this summons:</p>
    <table class="fax">
    <tr><td>Issued at:</td><td><?php echo $form['DocumentDetail']['field3']->renderRow() ?></td></tr>
    <tr><td>Date:</td><td><?php echo $form['DocumentDetail']['field4']->renderRow() ?></td></tr>
    <tr><td>Issued by:</td><td><?php echo $form['DocumentDetail']['field5']->renderRow() ?></td></tr>
    <tr><td>Registrar:</td><td><?php echo $form['DocumentDetail']['field6']->renderRow() ?></td></tr>
    <tr><td>Magistrate:</td><td><?php echo $form['DocumentDetail']['field7']->renderRow() ?></td></tr>
    <tr>
      <td class="third">Summons filed by <span class="smaller_font">[identify party]</span>:</td>
      <td>
        <?php echo $form['field9']->renderRow() ?><br/>
        <?php echo $form['field14']->renderRow() ?>
      </td>
    </tr>
    <!--<tr><td>Phone:</td><td>< ?php echo $form['field15']->renderRow() ?></td></tr>-->
    </table>
    
  </div>
  <div class="doc_footer"></div>
</div>