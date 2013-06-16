<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <p class="important">
        REQUEST FORM MUST BE PRESENTED TO RELEVANT COURT/CASH OFFICE FOR PAYMENT AND CASH REGISTER IMPRINT OR RECEIPT
      </p>
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <p class="important">Request for Copy of Digital Recording</p>
    </div>    
  </div>
  
  <div class="doc_section">
    <table class="fax">
    <tr><td class="important" colspan="4">CASE DETAILS:</td></tr>
    <tr>
      <td class="label">Case&nbsp;Number:</td><td><?php echo $form['field3']->renderRow() ?></td>
      <td class="label">Case Name:</td><td><?php echo $form['field4']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Hearing Type:</td><td><?php echo $form['field10']->renderRow() ?></td>
      <td class="label">Case before Magistrate:</td><td><?php echo $form['field11']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Hearing Date:</td><td><?php echo $form['field8']->renderRow() ?></td>
      <td class="label">Number&nbsp;of&nbsp;days&nbsp;to&nbsp;be&nbsp;copied:</td>
      <td><?php echo $form['field12']->renderRow() ?></td>
    </tr>
    </table>
    <table class="fax">
    <tr><td class="important" colspan="2">APPLICANT'S DETAILS:</td></tr>
    <tr>
      <td class="fourth">Person&nbsp;ordering&nbsp;copy:</td>
      <td><?php echo $form['field9']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Capacity:</td>
      <td>
        <input type="radio" value="informant" name="capacity" />&nbsp;Informant<?php echo str_repeat('&nbsp;', 8)?>
        <input type="radio" value="defendant" name="capacity" />&nbsp;Defendant<?php echo str_repeat('&nbsp;', 8)?>
        <input type="radio" value="plaintiff" name="capacity" />&nbsp;Plaintiff<?php echo str_repeat('&nbsp;', 8)?>
        <input type="radio" value="non_party" name="capacity" />&nbsp;Non party<br/>
        <input type="radio" value="defendant_representative" name="capacity" />&nbsp;Defendant’s legal representative&nbsp;&nbsp;&nbsp;
        <input type="radio" value="plaintiff_representative" name="capacity" />&nbsp;Plaintiff’s legal representative
      </td>
    </tr>
    <tr>
      <td class="fourth">ORGANIZATION:</td><td><?php echo $form['field13']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="fourth">REASON&nbsp;FOR&nbsp;REQUEST:</td>
      <td><?php echo $form['field17']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="fourth">CONTACT TELEPHONE:</td><td><?php echo $form['field14']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="fourth">POSTAL ADDRESS:</td><td><?php echo $form['field15']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="fourth">SIGNATURE:</td>
      <td>
        <br/><br/>______________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        DATE: <?php $form->getDocumentDate("d F Y")?>
      </td>
    </tr>
    </table>
    
    <p class="important">FEES:</p>
    NUMBER OF DAYS TO BE COPIED : ____________ @ $55 per day + TOTAL FEE: $__________
    <p class="important centered">NOTE: ALL REQUESTS ARE TO BE APPROVED FOR RELEASE BY A REGISTRAR PRIOR TO ACCEPTED PAYMENT</p>
    
    <p class="important">APPROVED BY:</p>
    <br/>Registrar’s name: _______________________ Registrar’s signature______________________
    
    <p style="margin-left: 200px">
      TRANSCRIPT: PREFERRED SUPPLIERS<br/>
      Court Recording Services Pty Ltd 9602 1799<br/>
      Legal Transcripts                9642 0322<br/>
      Spark & Cannon Pty Ltd           9670 6989
    </p>
    
    <p class="important centered">DIGITAL RECORDINGS ARE PROVIDED ON PC CD-ROM AND CANNOT BE PLAYED ON A CD PLAYER</p>
    
  </div>
  <div class="doc_footer"></div>
</div>