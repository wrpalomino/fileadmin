<div class="doc_buttons" id="doc_buttons">
  
  <?php if (sfContext::getInstance()->getRequest()->getParameter('fmt')): // only email ?>
  
    <button name="emailButton" id="emailButton" class="docActionButtons">Email</button>
    
  <?php else: ?>
  
    <button name="print" onClick="printPage(); return false" class="docActionButtons">Print</button>
  
    <?php if (!isset($helper->only_print)): ?>
      <br/><br/>
      <button name="previewButton" id="previewButton" class="docActionButtons">Preview</button><br/><br/><br/><br/>
      <button name="faxButton" id="faxButton" class="docActionButtons">Fax</button><br/><br/>
      <button name="emailButton" id="emailButton" class="docActionButtons">Email</button>
    <?php endif; ?>
      
    <br/><br/><br/><br/><br/><br/>
    <?php 
      $doc_params = sfContext::getInstance()->getUser()->getAttribute('doc_params', null);
      if ( ($doc_params && $doc_params['user_file_id'] != '') && !isset($helper->only_print) ) {
        //echo $helper->linkToSave($form->getObject(), array('params' => array(), 'class_suffix' => 'save', 'label' => '     Save    '));
        include_partial($this->getModuleName().'/form_actions', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper));
      }
    ?>
  <?php endif; ?>  
    
</div>