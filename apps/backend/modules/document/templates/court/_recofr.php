<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div class="centered">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <p class="subtitle">FORM 12</p>
      <div style="float:left"><b>Rule 22</b></div>
      <p class="subtitle">REQUEST FOR CONTESTED SUMMARY HEARING</p>
    </div>
  </div>
  <div class="doc_section">
    
    <div style="float:left"><?php echo $form['field2']->renderRow() ?></div>
    <div style="float:right">Court Reference: <?php echo $form['field3']->renderRow() ?></div>
    <div class="clear"></div>
    <br/>
    <div style="float:left;width:200px">BETWEEN:</div>
    <div style="float:left" class="centered">
      <?php echo $form['field6']->renderRow() ?><br/><i>[Name of informant]</i> 
      <br/>v.<br/>
      <?php echo $form['field4']->renderRow() ?><br/><i>[Name of Accused]</i>
    </div>
    <div class="clear"></div>
    
    <p>TAKE NOTICE that-</p>
    <div style="float:left;width:350px">
      <?php echo $form['field5']->renderRow() ?>
      Estimated Hearing Time:<br/>
      A Summary Case Conference has been held:
    </div>
    <div style="float:left">
      <?php echo $form['field9']->renderRow() ?><br/><br/><br/>
      <?php echo $form['field7']->renderRow() ?><br/>
      <?php echo $form['field8']->renderRow() ?>
    </div>
    <div class="clear"></div>
    <br/>
    
    <table class="fax compact">
    <tr>
      <td style="border-bottom:solid 1px"><b>WITNESS REQUIRED</b></td>
      <td style="border:solid 1px;width:100px" class="centered"> YES | NO </td>
      <td style="border-bottom:solid 1px"><b>ISSUE IN DISPUTE</b></td>
      <td style="border:solid 1px;width:100px" class="centered"> YES | NO </td>
    </tr>
    <tr>
      <td><b>Prosecution:</b></td><td style="border:solid 1px"></td>
      <td>Factual Arguments</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field5']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Informant</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field1']->renderRow() ?></td>
      <td>Question of Law</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field6']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Corroborator</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field2']->renderRow() ?></td>
      <td>Self Defence</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field7']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Other Police</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field3']->renderRow() ?></td>
      <td>Alibi</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field8']->renderRow() ?></td></tr>
    <tr>
      <td>Civilian</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field4']->renderRow() ?></td>
      <td>Voire Dire</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field9']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Expert</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field5']->renderRow() ?></td>
      <td style="border-bottom:solid 1px">Admissions/Concessions</td>
      <td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field10']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Child</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field6']->renderRow() ?></td>
      <td rowspan="10" colspan="2" style="border:solid 1px">
        If yes, provide description:<br/>
        <?php echo $form['field17']->renderRow() ?>
      </td>
    </tr>
    <tr><td>Protected Witness</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field7']->renderRow() ?></td>
    <tr><td><b>Accused:</b></td><td style="border:solid 1px"></td>
    <tr><td>Informant</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field8']->renderRow() ?></td>
    <tr><td>Corroborator</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field9']->renderRow() ?></td>
    <tr><td>Other Police</td><td style="border:solid 1px"><?php echo $form['DocumentDetail']['field10']->renderRow() ?></td>
    <tr><td>Civilian</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field1']->renderRow() ?></td>
    <tr><td>Expert</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field2']->renderRow() ?></td>
    <tr><td>Child</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field3']->renderRow() ?></td>
    <tr><td>Protected Witness</td><td style="border:solid 1px"><?php echo $form['DocumentDetail2']['field4']->renderRow() ?></td>
    </table>
   
    <p class="subtitle">OFFENCES</p>
    <table class="fax">
    <tr><td>Co-offenders:</td><td><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr>
      <td colspan="2" style="white-space:nowrap">
        If yes, names of co-offenders if known:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form['field18']->renderRow() ?>
      </td>
    </tr>
    <tr><td>Is it an alleged sexual offence:</td><td><?php echo $form['field11']->renderRow() ?></td></tr>
    <tr>
      <td>Is it alleged that the offence arises out of an act of family violence:</td>
      <td><?php echo $form['field12']->renderRow() ?></td>
    </tr>
    </table>
    
    <p class="subtitle">RESOURCES REQUIRED</p>
    <table class="fax">
    <tr>
      <td class="width:30%">Audiovisual link</td><td class="width:30%"><?php echo $form['field13']->renderRow() ?></td>
      <td class="width:20%">Interpreter</td><td><?php echo $form['field14']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Remote Witness Facility</td><td><?php echo $form['field15']->renderRow() ?></td>
      <td>If yes, language required:</td><td><?php echo $form['field19']->renderRow() ?></td>
    </tr>
    <tr>
      <td>In-Court screens</td><td><?php echo $form['field16']->renderRow() ?></td>
      <td>DVD/Video/TV</td><td><?php echo $form['field1']->renderRow() ?></td>
    </tr>
    </table>
    
    <p class="subtitle">REQUEST MATTER BE LISTED FOR A CONTESTED HEARING</p>
    <div style="float:left;">
      <div class="imgHover" id="signatureDiv"><?php echo image_tag("signatures/default.png", array('alt' => 'Signature', 'title' => 'Signature', 'id' => 'signature')); ?></div>
      [Signature of Legal Practitioner of Accused OR Accused]
    </div>
    <div style="float:right;text-align:center">
      <br/><br/><br/>_______________________________<br/>[Signature Police Prosecutor]
    </div>
    <div class="clear"></div>
    <br/>
    <hr class="division" />
    <span class="smaller_font">
      Note: if the accused is not legally represented this form is to be completed by the prosecution relevant 
      to the information in their possession. This form is to be filed with the Court Coordinator at the relevant venue.
    </span>
    
  </div>
  <div class="doc_footer"></div>
</div>