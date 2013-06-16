<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered"><h2 class="subtitle">Legal Practitioner Ceasing to Act</h2></div>
    <?php echo $form['field7']->renderRow() ?>
    <p>BETWEEN:</p>
    <div class="centered">
      <p><?php echo $form['field10']->renderRow() ?></p>
      V.
      <p><?php echo $form['field4']->renderRow() ?></p>
    </div>
    
    <p>Date of hearing: <?php echo $form['field8']->renderRow() ?></p>
   
    <p class="final_greetings">
      <?php //echo $form['field17']->renderRow() ?>
      TAKE NOTICE THAT the legal practitioner indicated below<br/> 
      has <b>ceased to act for the above named defendant</b>.
    </p>
    
    <p>Date: <?php $form->getDocumentDate("d F Y")?> </p>
    
    <table class="fax">
    <tr><td></td><td><br/><br/>_________________________________________</td></tr>
    <tr><td>Name&nbsp;of&nbsp;legal&nbsp;practitioner: </td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>Name of legal firm: </td><td><?php echo $form['field3']->renderRow() ?></td></tr>
    </table>
    
  </div>  
  <div class="doc_footer"></div>
</div>