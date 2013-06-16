<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <p class="subtitle final_greetings">
        FORM 44<br/><br/>
        NOTICE OF REQUEST FOR APPEARANCE<br/>VIA AUDIO VISUAL LINK<br/>
        (section 42K of the Evidence Miscellaneous Provisions) Act 1958)
      </p>
      <div style="position:absolute;top:180px">Rule 88</div>
    </div>
  </div>
  
  <div class="doc_section">
 
    <div style="float:left"><?php echo $form['field7']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    <p class="final_greetings">To Central Prison Records:</p>
    
    <table class="fax">
    <tr><td>Accused/Witness:</td><td><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td>Accused/Witness CRN No:</td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>Prison:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>Date of Hearing:</td><td><?php echo $form['field8']->renderRow() ?></td></tr>
    <tr><td>Purpose of Hearing:</td><td><?php echo $form['field12']->renderRow() ?></td></tr>
    <tr><td>Time of appearance:</td><td><?php echo $form['field13']->renderRow() ?></td></tr>
    </table>
    
    <p class="final_greetings">
      Take notice that the Accused is required to appear at the hearing in the Magistrates Court 
      via audio visual link.<br/><br/>
      Time of the audio visual link (as provided or notified by a Court Coordinator): _________________
    </p>
    <p class="final_greetings">
       <br/><br/><br/><br/><hr class="division"/>
       <div class="centered">
         Note: This form is to be filed with the Court Coordinator at the relevant venue
       </div>
    </p>
    
  </div>
  <div class="doc_footer"></div>
</div>