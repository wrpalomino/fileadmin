<?php

require_once dirname(__FILE__).'/../lib/clerkGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clerkGeneratorHelper.class.php';

/**
 * clerk actions.
 *
 * @package    fileadmin
 * @subpackage clerk
 * @author     William Palomino
 * @version    3.0
 */
class clerkActions extends autoClerkActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    // keeps the form in the shadowbox for all the actions
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      $this->partial_links = false;
      $this->edit_pager = false;
      $this->setLayout('form_layout');
      $this->no_title = false;
      $this->mode = 'search';
      $this->shadow_box = true;
    }
  }
  

  public function executeIndex(sfWebRequest $request)
  {
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      parent::executeIndex($request);
    }
    else {
      $request = $this->setMainFilter($request);
      parent::executeIndex($request);    
      $this->editPagerRedirection($request);
    }
  }
}
