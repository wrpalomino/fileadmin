<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center">
      <?php echo image_tag('magistrate_court_victoria.jpg', array('alt' => 'Magistrate Court', 'class' => 'magistrate_court_img')); ?>
      <br/><span class="important">POLICE ROPES PROGRAM</span>
    </div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr><td class="label">TO:</td><td class="field"><?php echo $form['field2']->renderRow() ?></td></tr>
    <tr><td class="label">DATE:</td><td class="field"><?php $form->getDocumentDate()?></td></tr>
    <tr><td class="label">FROM:</td><td class="field"><?php echo $form['field10']->renderRow() ?></td></tr>
    <tr>
      <td class="label">INFORMANT:</td>
      <td class="field">
        I wish to participate in the program
        <p>
          <input type="checkbox" value="yes">&nbsp;YES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="checkbox" value="yes">&nbsp;NO
        </p>
      </td>
    </tr>
    </table>
    
    <table class="fax with_border centered">
    <tr>
      <td>
        <div class="centered">THIS YOUNG PERSON MEETS THE CRITERIA TO PARTICIPATE IN THE POLICE<br/>
        ROPES PROGRAM AND HAS AGREED TO PARTICIPATE IN THE ROPES PROGRAM</div>
      </td>  
    </tr>
    </table>
    
    <p>
      <b>Please note:</b> The Parent/Guardian will have to complete an indemnity form and a Medical History 
      for the young person <span class="important">prior to attendance</span> at the ROPES Program
    </p>
    
    <table class="fax">
    <tr><td class="important" colspan="4"><br/>Young Person’s details</td></tr>
    <tr>
      <td class="label">Name:</td><td class="field"><?php echo $form['field4']->renderRow() ?></td>
      <td class="label">Date&nbsp;of&nbsp;Birth:</td><td class="field"><?php echo $form['field3']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Address:</td><td class="field"><?php echo $form['field5']->renderRow() ?></td>
      <td colspan="2"></td></td>
    </tr>
    <tr><td class="important" colspan="4"><br/>Young Person’s details</td></tr>
    <tr><td colspan="4">Parent/s / Guardian/s Name: <?php echo $form['field11']->renderRow() ?></td></tr>
    <tr>
      <td colspan="4">
        Home Phone: <?php echo $form['field12']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
        Work phone: <?php echo $form['field13']->renderRow() ?>&nbsp;&nbsp;&nbsp;&nbsp;
        Mobile: <?php echo $form['field14']->renderRow() ?>
      </td>
    </tr>
    <tr><td class="important" colspan="4"><br/>Informant’s details</td></tr>
    <tr>
      <td class="label">Informant&nbsp;Name:</td><td class="field"><?php echo $form['field6']->renderRow() ?></td>
      <td class="label">Station:</td><td class="field"><?php echo $form['field7']->renderRow() ?></td>
    </tr>
    <tr>
      <td class="label">Offence:</td><td class="field"><?php echo $form['field8']->renderRow() ?></td>
      <td class="label">Offence Date:</td><td class="field"><?php echo $form['field9']->renderRow() ?></td>
    </tr>
    </table>
    <p class="final_greetings">Signature: ____________________________________</p>
    
  </div>
  <div class="doc_footer"></div>
</div>