<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <p class="subtitle">
        Form 31<br/><br/>APPLICATION<br/><br/><br/><br/>
      </p>
      <div style="position:absolute;top:34px">
        Rules 47,63,66<br/><br/>
        <div style="border:solid 2px;padding:5px">Form 31</div>
      </div>
    </div>
  </div>
  
  <div class="doc_section">
 
    <div style="float:left"><?php echo $form['field15']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    
    <br/><br/>
    <table class="fax">
    <tr><td class="third">TO:</td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>THE APPLICANT:</td><td><?php echo $form['field4']->renderRow() ?> applies - </td></tr>
    <tr><td colspan="2"><?php echo $form['field17']->renderRow() ?></td></tr>
    <tr><td>Committal mention date:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    </table>
    
    <p class="final_greetings">
      This application will be heard by the <?php echo $form['field7']->renderRow() ?><br/>
      at ____________________ on _____________<br/>
      or so soon afterwards as the business of the Court allows.
    </p>
    
    <br/><br/>
    <table class="fax">
    <tr>
      <td class="half">Signature of applicant’s legal practitioner:</td>
      <td><div class="imgHover" id="signatureDiv"><?php echo image_tag("signatures/default.png", array('alt' => 'Signature', 'title' => 'Signature', 'id' => 'signature')); ?></div></td>
    </tr>
    <tr>
      <td>This application was filed by:</td>
      <td>
        <?php echo $form['field9']->renderRow() ?><br/>
        <?php echo $form['field12']->renderRow() ?>
      </td>
    </tr>
    <tr><td>Facsimile number:</td><td><?php echo $form['field13']->renderRow() ?></td></tr>
    <tr><td>Phone number:</td><td><?php echo $form['field14']->renderRow() ?></td></tr>
    </table>
    
    <p class="final_greetings">Date: <?php $form->getDocumentDate("d F Y")?></p>
    <p>Registrar: _____________________________________________ <p>
    
  </div>
  <div class="doc_footer"></div>
</div>