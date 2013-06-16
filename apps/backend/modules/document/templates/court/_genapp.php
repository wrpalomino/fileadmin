<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered"><h2 class="subtitle">NOTICE OF APPLICATION TO THE MAGISTRATES’ COURT</h2></div>
    <div class="doc_header"><?php echo $form['field7']->renderRow() ?></div>
    <div class="doc_logo">Case No:&nbsp;&nbsp;<?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    <b>IN THE MATTER OF AN APPLICATION UNDER</b><br/><br/>
    
    <table class="fax">
    <tr><td>APPLICANT: </td><td><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td>Address: </td><td><?php echo $form['field5']->renderRow() ?></td></tr>
    <tr><td>RESPONDENT: </td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>Address: </td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>ORDERS SOUGHT: </td><td><?php echo $form['field17']->renderRow() ?></td></tr>
    <tr><td>GROUNDS&nbsp;OF&nbsp;APPLICATION: </td><td><?php echo $form['field18']->renderRow() ?></td></tr>
    </table>
    
    <p class="final_greetings">
      Dated at __________________ on <?php $form->getDocumentDate("d F Y")?>
    </p>
    <div style="float:right" class="centered">
      ___________________________<br/>
      Applicant
    </div>
    <div class="clear"></div>
    <p class="final_greetings">
      TAKE NOTICE that this application will be heard and determined by the 
      Magistrates’ Court of Victoria at FRANKSTON <?php //echo $form['field7']->renderRow() ?> 
      at 
      10.00 am on _____/_____/_____ <?php //echo $form['field8']->renderRow() ?>
    </p>
    <div style="float:right" class="centered">
      ___________________________<br/>
      Registrar
    </div>
    
  </div>  
  <div class="doc_footer"></div>
</div>