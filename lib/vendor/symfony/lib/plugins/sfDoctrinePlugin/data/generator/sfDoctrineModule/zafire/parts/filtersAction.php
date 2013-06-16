// modified by William, 12/03/2013: to access this function outside the action class scope
//protected function getFilters()
  public function getFilters()
  {
    return $this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  
  //protected function setFilters(array $filters)
  public function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>.filters', $filters, 'admin_module');
  }
