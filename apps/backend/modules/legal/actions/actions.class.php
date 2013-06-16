<?php

require_once dirname(__FILE__).'/../lib/legalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/legalGeneratorHelper.class.php';

/**
 * legal actions.
 *
 * @package    fileadmin
 * @subpackage legal
 * @author     William Palomino
 * @version    3.0
 */
class legalActions extends autoLegalActions
{
  public function preExecute() 
  {    
    parent::preExecute();
    $this->section_links = $this->helper->getSectionLinks('vla_details');
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  
  public function executeNew(sfWebRequest $request)
  {
    if ($this->verifyUserFile('To create a new VLA select a File first!')) {
      $legal_aid = new LegalAid();      
      $legal_aid->setUserFileId(CommonObject::getSessionUserFileData('fileId'));
      $this->legal_aid = $legal_aid;
      $this->form = new LegalAidForm($legal_aid);
    }
  }

  public function executeSimplifiedGrants(sfWebRequest $request)
  {
    $this->redirect("legal/new");
  }
  
  public function executeElodge(sfWebRequest $request)
  {
    $this->setPagination($request);

    //$this->helper->section_links_id = 'section_links2';
    
    $this->section_links = $this->helper->getSectionLinks('elodge');
    $this->elodge_text = $this->helper->elodge_text;
  }
  
  public function executeIndictable(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->section_links = $this->helper->getSectionLinks('indictable');
  }
  
  public function executeForms(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->section_links = $this->helper->getSectionLinks('forms');
  }
  
  public function executeManuals(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->section_links = $this->helper->getSectionLinks('manuals');
  }
  
  public function executeCompliance(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->section_links = $this->helper->getSectionLinks('compliance');
  }
  
  public function executeWorksheets(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->section_links = $this->helper->getSectionLinks('worksheets');
  }
}
