  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this-><?php echo $this->getSingularName() ?> = $this->form->getObject();
    
    // added by William, 08/05/2013: to load different form layout for the object
    if ( $request->getParameter('_frm') && (class_exists($request->getParameter('_frm').'Form')) ) { // load this form
      $class_name = $request->getParameter('_frm').'Form';
      $this->form = new $class_name($this-><?php echo $this->getSingularName() ?>);
    }
  }
