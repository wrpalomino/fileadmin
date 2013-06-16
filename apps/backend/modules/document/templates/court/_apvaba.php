<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <span class="important smaller_font">Bail Act 1977</span>
      <p>Bail Regulations 2003</p>
      <span class="important">NOTICE OF APPLICATION FOR AN ORDER TO VARY</span>
    </div>
    <div style="padding-left:230px"><?php echo $form['field1']->renderRow()?></div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr>
      <td colspan="2"><?php echo $form['field2']->renderRow() ?></td>
      <td class="label">Court Reference: <?php echo $form['field3']->renderRow() ?></td>
    </tr>  
    <tr><td class="label">Applicant:</td><td class="field" colspan="2"><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td class="label">Respondent:</td><td class="field" colspan="2"><?php echo $form['field5']->renderRow() ?></td><tr>
    <tr><td class="label">Nature&nbsp;of&nbsp;Charge:</td><td class="field" colspan="2"><?php echo $form['field17']->renderRow() ?></td><tr>
    </table>  
    
    <p>On (date) <?php echo $form['field7']->renderRow() ?> , <?php echo $form['field8']->renderRow() ?>
    the applicant was admitted to bail upon signing an undertaking on the following conditions:</p>
    <div style="float:left;width:10%"><?php echo $form['field9']->renderRow() ?></div>
    <div style="float:right;width:90%">
      A deposit of $&nbsp;<?php echo $form['field10']->renderRow() ?> or security to the same value;<br/>
      <p><?php echo $form['field11']->renderRow() ?></p>
      <?php echo $form['field19']->renderRow() ?>
    </div>
    <div class="clear"></div>
    
    <br/><br/>
    <div style="float:left">To the above named&nbsp;&nbsp;</div>
    <div style="float:left"> <?php echo $form['field11']->renderRow() ?></div>
    <div class="clear"></div>
    Take notice that -
    <ol>
      <li>
        I will apply to the Magistrates’ Court at <?php echo $form['field13']->renderRow() ?> on (date)
        <?php echo $form['field14']->renderRow() ?> at (time am/pm) <?php echo $form['field15']->renderRow() ?>
        for an order:*<br/>
        
        <?php echo $form['field16']->renderRow() ?>&nbsp;* varying the amount of bail fixed as follows
        <?php echo $form['field6']->renderRow() ?><br/>
        
        <?php echo $form['field12']->renderRow() ?>
        <?php echo $form['field18']->renderRow() ?>
     </li>
     <li>
       <div style="float:left">You as&nbsp;&nbsp;</div>
       <div style="float:left"><?php echo $form['field11']->renderRow() ?></div> are entitled to appear at the hearing of such 
       application and to give evidence.
       <div class="clear"></div>
     </li>
   </ol>
    
   <br/><br/>
   <div style="float:left">Dated at <?php $form->getDocumentDate("d F Y")?>&nbsp;&nbsp;</div>
   <div class="centered" style="float:left">at ____________________<br/>place</div>
   <div class="centered" style="float:right">__________________________<br/>Applicant</div>
   <div class="clear"></div>

   <p class="smaller_font">* Check whichever is applicable.</p>
   
  </div>
  <div class="doc_footer"></div>
</div>