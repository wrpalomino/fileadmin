<?php

require_once dirname(__FILE__).'/../lib/judgeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/judgeGeneratorHelper.class.php';

/**
 * judge actions.
 *
 * @package    fileadmin
 * @subpackage judge
 * @author     William Palomino
 * @version    3.0
 */
class judgeActions extends autoJudgeActions
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
    
    // always
    $this->setLayout('form_layout');
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      parent::executeIndex($request);
    }
    else {
      $request = $this->setMainFilter($request);
      parent::executeIndex($request);

      // to bind embedded filter forms
      if (count($this->getFilters())) $this->filters->bind($this->getFilters());    
    
      $this->editPagerRedirection($request);
    }
  }
  
  
  public function executeCheckCourtType(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    
    if (is_numeric($id)) {
      $court = Doctrine::getTable('Agency')->find($id);
      if ( ($court) && ($court->getSubgroupId() == 8) ) {
        die('Magistrate');
        return sfView::NONE;
      }
    }
    die('Judge');
    return sfView::NONE;
  }
}
