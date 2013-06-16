<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <p class="important">TELE-COURT BOOKING REQUEST</p>
    </div>
  </div>
  
  <div class="doc_section">
 
    <table class="fax">
    <tr><td class="half">Booking request made by:</td><td>Solicitor</td></tr>
    <tr><td>Name:</td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>Solicitors Firm:</td><td><?php echo $form['field3']->renderRow() ?></td></tr>
    <tr><td>Contact Number:</td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr><td>Defendant’s Name:</td><td><?php echo $form['field4']->renderRow() ?></td></tr>
    <tr><td>CRN:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr><td>Prison:</td><td><?php echo $form['field12']->renderRow() ?></td></tr>
    <tr><td>Date of Hearing:</td><td><?php echo $form['field8']->renderRow() ?></td></tr>
    <tr>
      <td>
        <br/>Hearing Type:<?php echo $form['field13']->renderRow() ?>
      </td>
      <td>
        <br/>Co-Defendant:<?php echo $form['field14']->renderRow() ?>
        Specify:<?php echo $form['field15']->renderRow() ?>
      </td>
    </tr>
    </table>
    
    <p class="final_greetings centered subtitle">
      Booking requests must be received by the correct office by 1PM the day before hearing for 
      request to be processed.
    </p>
    <p class="centered">www.magistratescourt.vic.gov.au</p>
    
  </div>
  <div class="doc_footer"></div>
</div>