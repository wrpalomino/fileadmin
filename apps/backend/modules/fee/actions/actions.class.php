<?php

require_once dirname(__FILE__).'/../lib/feeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/feeGeneratorHelper.class.php';

/**
 * fee actions.
 *
 * @package    fileadmin
 * @subpackage fee
 * @author     William Palomino
 * @version    3.0
 */
class feeActions extends autoFeeActions
{
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  public function executeInvoices(sfWebRequest $request)
  {    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('invoices');
  }
  
}
