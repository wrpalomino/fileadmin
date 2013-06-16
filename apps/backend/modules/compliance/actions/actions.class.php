<?php

require_once dirname(__FILE__).'/../lib/complianceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/complianceGeneratorHelper.class.php';

/**
 * compliance actions.
 *
 * @package    fileadmin
 * @subpackage compliance
 * @author     William Palomino
 * @version    3.0
 */
class complianceActions extends autoComplianceActions
{
  public function preExecute() 
  {    
    parent::preExecute();
    $this->section_links = $this->helper->getSectionLinks('compliance');
  }
  
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
}
