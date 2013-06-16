<div class="doc_container" id="doc_container">
 
  <div class="doc_section">
    <p class="subtitle">Information to be provided to the Court for making of a Gaol Order.</p>
    <table class="fax">
    <tr><td class="half">Prepared by:</td><td><?php echo $form['field9']->renderRow() ?></td></tr>
    <tr><td>Of Law firm/ Police Station:</td><td><?php echo $form['field6']->renderRow() ?></td></tr>
    <tr><td>Address:</td><td><?php echo $form['field5']->renderRow() ?></td></tr>
    <tr><td>Urgent contact phone number:</td><td><?php echo $form['field1']->renderRow() ?></td></tr>
    <tr><td>Email:</td><td><?php echo $form['field2']->renderRow() ?></td></tr>
    <tr>
      <td>Has the opposing party (defence practitioner/ informant) been notified:</td>
      <td><?php echo $form['field12']->renderRow() ?></td>
    </tr>
    </table>
    State reason why prisoner could not be authorised to be present in court by audio visual link under 
    Part IIA of the Evidence (Miscellaneous Provisions) Act 1958:<br/>
    <?php echo $form['field18']->renderRow() ?>
  </div>
   
  <div class="doc_section">
    <p class="subtitle centered">SCHEDULE 2 Regulation 20<br/>ORDER TO BRING A PRISONER BEFORE A COURT OR CORONER</p>
    <!--<div class="centered">
      <p style="font-style: italic">Corrections Regulations 2009<br/>S.R. o. 40/2009</p>
      <p>Schedule 2</p>
      <h2 class="subtitle">ORDER TO BRING A PERSON BEFORE A COURT OR CORONER</h2>
      <div style="border: solid 2px; padding: 10px; position: absolute; top:28px">Sch. 2</div>
      <div style="position: absolute; top:70px; left: 560px">Regulation&nbsp;20</div>
    </div>-->
  </div>
  
  <div class="doc_section">    
    <table class="fax">
    <tr>
      <td class="half">To <span class="smaller_font">(insert title of person in charge of prison)</span>:</td>
      <td><?php echo $form['field3']->renderRow() ?></td>
    </tr>
    <tr>
      <td>at <span class="smaller_font">(insert name of place of prison)</span>:</td>
      <td><?php echo $form['field11']->renderRow() ?></td>
    </tr>
    <tr>
      <td colspan="2">
        AND to all members of the police force in Victoria<br/>
        Under the provisions of regulation 20 of the Corrections Regulations 2009 I order that:
      </td>
    </tr>
    <tr>
      <td><span class="smaller_font">(Insert&nbsp;name&nbsp;of&nbsp;prisoner)</span>:</td>
      <td><?php echo $form['field4']->renderRow() ?></td>
    </tr>
    <tr>
      <td>A Prisoner detained at <span class="smaller_font">(insert name of prison)</span>:</td>
      <td><?php echo $form['field10']->renderRow() ?></td>
    </tr>
    <tr>
      <td>Be brought before the <span class="smaller_font">(insert name of court)</span>:</td>
      <td><?php echo $form['field7']->renderRow() ?></td>
    </tr>
    
    <tr>
      <td>To be held at <span class="smaller_font">(insert place where court to be held)</span>:</td>
      <td><?php echo $form['field13']->renderRow() ?></td>
    </tr>
    
    <tr><td>On <span class="smaller_font">(insert date)</span>:</td><td><?php echo $form['field8']->renderRow() ?></td></tr>
    
    <!--<tr><td valign="top">Answering a charge of:</td><td>< ?php echo $form['field18']->renderRow() ?></td></tr>-->
    
    <tr>
      <td colspan="2">
        For the Purpose of <span class="smaller_font">(insert purpose for which the prisoner is required to 
        attend. If the purpose is to answer a charge include the nature of the offences with which the prisoner 
        is charged)</span>:
        <?php echo $form['field17']->renderRow() ?>
        <p>
          And the prisoner is to remain in custody of those officers and members of the police 
          force acting under this order until the prisoner is returned to the prison from which 
          the prisoner was removed or is released by order of the court.
        </p>
      </td>
    </tr>
    </table>
    
    <div style="float:left;width:100px">
      <p>Dated:</p>
      Judge:<br/>
      Magistrate:<br/>
      Coroner:
    </div>
    <div style="float:left">
      <p><?php $form->getDocumentDate("d F Y")?></p>
      <?php echo $form['field14']->renderRow() ?><br/>
      <?php echo $form['field15']->renderRow() ?><br/>
      <?php echo $form['field16']->renderRow() ?>
    </div>
    <div class="clear"></div>
    
    <p class="final_greetings subtitle centered">
      NOTICE TO THE OFFICERS AND MEMBERS OF THE POLICE FORCE BRINGING THE PRISONER BEFORE A COURT OR CORONER
    </p>
    
    <p>
      The prisoner (insert name of prisoner): <?php echo $form['field4']->renderRow() ?>
      <div style="padding-left:200px">
        is detained for other matters and must be returned to the place of detention*<br/>
        or is not detained for other matters<br/>
        or is granted bail<br/>
        and may be released if so ordered by the court.*
      </div>
    </p>
    
    <p>
      <br/>__________________________________________________________<br/>
      Name and signature of the person in charge of the prison from which <br/>
      the prisoner is removed to attend before a court or coroner
    </p>
    *Strike out whichever is inapplicable.
    
  </div>
  <div class="doc_footer"></div>
</div>