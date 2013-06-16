<?php

require_once dirname(__FILE__).'/../lib/barristerGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/barristerGeneratorHelper.class.php';

/**
 * barrister actions.
 *
 * @package    fileadmin
 * @subpackage barrister
 * @author     William Palomino
 * @version    3.0
 */
class barristerActions extends autoBarristerActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    if (sfContext::getInstance()->getActionName() == 'new') {
      $file_id = CommonObject::getSessionUserFileData('fileId');
      $this->helper->form_attributes = array('onsubmit' => 'linkObjectToFile(this, event, \'Barrister\', '.$file_id.');');
    }
    
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
    
      // to bind embedded filter forms
      if (count($this->getFilters())) $this->filters->bind($this->getFilters());
        
      $this->editPagerRedirection($request);
    }
  }
  
  public function executeCorrespondence(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('correspondence');
  }
  
  public function executeBacksheets(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('backsheets');
    $this->extra_options = $this->helper->getExtraOptions();
  }
  
}
