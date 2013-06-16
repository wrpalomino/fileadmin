  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    // added by William, 08/05/2013: to load different form layout for the object
    $allFormValues = $request->getParameter($form->getName());    
    if ( isset($allFormValues['_frm']) && class_exists($allFormValues['_frm'].'Form') )  {
      $class_name = $allFormValues['_frm'].'Form';
      $this->form = new $class_name($this-><?php echo $this->getSingularName() ?>);
      $form = $this->form;
    }
     
    $form->bind($allFormValues, $request->getFiles($form->getName()));
  
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $<?php echo $this->getSingularName() ?> = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }
      
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $<?php echo $this->getSingularName() ?>)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@<?php echo $this->getUrlForAction('new') ?>');
      }
      else
      {
        <?php //commented and added by William, 03/02/2012 ?>
        $rarray = array('sf_route' => '<?php echo $this->getUrlForAction('edit') ?>', 'sf_subject' => $<?php echo $this->getSingularName() ?>);
        
        // added by William, 08/05/2013: to load different form layout for the object
        if (isset($allFormValues['_frm']))  { 
          $rarray['_frm'] = $allFormValues['_frm'];
        }
        
        if ($this->shadow_box) $rarray['shbx'] = '2';
        else if (strtolower($this->getActionName()) == 'create') $rarray['create'] = '1';
        
        // added by William, 17/05/2013: prevent redirection, for ajax calls (no notice required!)
        Document::setDocBuffer($form->getObject()->getId());
        if ($request->getParameter('_nrd')) {
          echo "%|%".$form->getObject()->getId()."%|%"; 
          return; 
        }
        else $this->getUser()->setFlash('notice', $notice);
        
        $this->redirect($rarray);
        
        <?php /*if ($this->shadow_box) {
          $this->redirect(array('sf_route' => '<?php echo $this->getUrlForAction('edit') ?>', 'shbx' => '2', 'sf_subject' => $<?php echo $this->getSingularName() ?>));
        }
        else {
          if (strtolower($this->getActionName()) == 'create') {
            $this->redirect(array('sf_route' => '<?php echo $this->getUrlForAction('edit') ?>', 'create' => '1', 'sf_subject' => $<?php echo $this->getSingularName() ?>));
          }
          else {
            $this->redirect(array('sf_route' => '<?php echo $this->getUrlForAction('edit') ?>', 'sf_subject' => $<?php echo $this->getSingularName() ?>));
          }
        }*/ ?>
          
        <?php /* $route = '< ? php echo $this->getSingularName(); ? >';
        $returnTo = strtolower($this->configuration->getValue($thisContext . 'return_to'));
        if ($returnTo != 'list')
        {
          $route .= '_' . $returnTo;
        }
        $returnArray = array('sf_route' => $route);
        if ($returnTo != 'list')
        {
          $returnArray['sf_subject'] = $<?php echo $this->getSingularName(); ?>;
        }
        $this->redirect($returnArray);
        <?php /************************ end of changes **********************/ ?>
        
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
