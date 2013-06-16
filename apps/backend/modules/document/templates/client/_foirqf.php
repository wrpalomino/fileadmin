<div class="doc_container" id="doc_container">
  <div class="doc_section">
    <div align="center"><h3>Freedom of Information Request</h3></div>
  </div>
  <div class="doc_section">
    <table class="fax">
    <tr><td class="label">Date: <td class="field"><?php $form->getDocumentDate()?></td></tr>
    <tr><td class="label">Surname: <td class="field"><?php echo $form['field1']->renderRow() ?></td></tr>
    <tr><td class="label">First name(s): <td class="field"><?php echo $form['field2']->renderRow() ?></td></tr>
    <tr><td class="label">Address: <td class="field"><?php echo $form['field3']->renderRow() ?></td></tr>
    </table>
  </div>
  <div class="doc_section">
    <br/><p>I would like access to the following document(s):</p>
    <?php echo $form['field17']->renderRow() ?>
    
    <p>Indicate whether you would like to inspect the documents and/or obtain a copy of the documents:</p>
    I want a copy of the document(s)&nbsp;&nbsp;<input type="checkbox" name="like_copy" id="like_copy" /><br/>
    I want to inspect the document(s)&nbsp;<input type="checkbox" name="inspect" id="inspect" />
    <p class="final_greetings">
      _________________________________<br/>
      <?php echo $form['field4']->renderRow() ?>
    </p>
  </div>
  <div class="doc_footer"></div>
</div>