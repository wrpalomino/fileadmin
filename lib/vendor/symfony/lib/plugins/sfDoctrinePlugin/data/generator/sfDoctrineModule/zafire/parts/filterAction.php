  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      // reset main filter when reset module's filters
      $this->getUser()->setAttribute('main_filter', null);
      
      // reset default tablemethod if exists!
      if ($this->getUser()->getAttribute($this->getModuleName().'TableMethod', null)) {
        $this->getUser()->setAttribute($this->getModuleName().'TableMethod', null);
      }
    
      // set search mode
      $this->getUser()->setAttribute('mode', 'search');
      $this->getUser()->setAttribute('client', null);
      
      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
      
      // added by William 06/03/2012: to allow a edit pager version
      if ($this->edit_pager) $this->redirect('@<?php echo $this->getUrlForAction('list') ?>'.'?filtered=1');
      
      $this->redirect('@<?php echo $this->getUrlForAction('list') ?>');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
