  public function executeEdit(sfWebRequest $request)
  {
    // modified by William 06/03/2012: to allow a edit pager version
    if (!$this->edit_pager) {
      $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
      $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
      
      // added by William, 08/05/2013: to load different form layout for the object
      if ( $request->getParameter('_frm') && (class_exists($request->getParameter('_frm').'Form')) ) { // load this form
        $class_name = $request->getParameter('_frm').'Form';
        $this->form = new $class_name($this-><?php echo $this->getSingularName() ?>);
      }
      
    }
    else {
      //$this->executeIndex($request);
      $this->preIndex($request);
      
      // this call from the create actions, set the filters to show just the new record and redirect
      if ($request->getParameter('create')) {
        $this->setFilters(array('id' => array('text' => $this->getRoute()->getObject()->getId())));
        
        // added by William, 04/05/2103: pass info flash to next page
        if ($this->getUser()->hasFlash('info')) $this->getUser()->setFlash('info', $this->getUser()->getFlash('info'));
        
        $this->redirect('<?php echo $this->getModuleName()?>/index?filtered=1&flc=1');
      }
 
      // go back to search if nothing to show
      if ($this->pager->getNbResults() == 0) {
        sfContext::getInstance()->getUser()->setAttribute('mode', 'search');
        $this->redirect('<?php echo $this->getModuleName()?>/index');
      }
    
      // check if there is a value to show otherwise redirect to previous page
      if (!$this->pager->getResults()->toArray()) $this->redirect('<?php echo $this->getModuleName()?>/index?page='.$this->pager->getNbResults());
    
      if ($this->edit_pager) {
        $objects = $this->pager->getResults();
        
        // added 12/05/2012: to load client's info (replaced with ajax call on 13/03/2013)
        /*$user_id = $request->getParameter('user_id');
        if ($user_id) $objects[0]->setUserData($user_id);*/
        
        $this-><?php echo $this->getSingularName() ?> = $objects[0];
        
        $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
        $this->setTemplate('edit');
      }
    }
    // end of modified
    
  }
  