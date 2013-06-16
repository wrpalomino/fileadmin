  public function executeUpdate(sfWebRequest $request)
  {
    $this-><?php echo $this->getSingularName() ?> = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this-><?php echo $this->getSingularName() ?>);
    
    $this->processForm($request, $this->form);
    
     // added by William, 17/05/2013: to avoid rendering when ajax call to save new form
    if ($request->getParameter('_nrd')) return sfView::NONE;

    $this->setTemplate('edit');
    
    // added by William 06/03/2012: to allow a edit pager version
    if ($this->edit_pager) $this->preIndex($request); //$this->executeIndex($request);
  }
