<?php

require_once dirname(__FILE__).'/../lib/briefGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/briefGeneratorHelper.class.php';

/**
 * brief actions.
 *
 * @package    fileadmin
 * @subpackage brief
 * @author     William Palomino
 * @version    3.0
 */
class briefActions extends autoBriefActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    if (!$this->edit_pager) {
      $this->getUser()->setAttribute('brief.max_per_page', 20);
      $this->configuration->setTableMethod('unreceived');
      if ($filters_type = $this->getUser()->getAttribute('briefTableMethod', null)) {
        $this->helper->header_note = '<h2>'.$filters_type.' Brief List</h2>';
      }
    }
    else {
      $this->getUser()->setAttribute('brief.max_per_page', 1);
    }
    $this->section_links = $this->helper->getSectionLinks('briefs');
  }
  
  public function executeIndex(sfWebRequest $request)
  {      
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
    
    if (!$this->edit_pager) $this->verifyClientFile('Briefs');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    if ($this->verifyUserFile('To create a new Brief select a File first!')) {
      $brief = new Brief();
      $brief->setUserFileId(CommonObject::getSessionUserFileData('fileId'));
      $this->brief = $brief;
      $this->form = new BriefForm($brief);
    }
    
  }
}
