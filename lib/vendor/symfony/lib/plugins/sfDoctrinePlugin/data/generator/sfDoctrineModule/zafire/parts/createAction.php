  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
    
    $this->processForm($request, $this->form);
    
    // added by William, 17/05/2013: to avoid rendering when ajax call to save new form
    if ($request->getParameter('_nrd')) return sfView::NONE;
    
    $this->setTemplate('new');
  }
