<?php

require_once dirname(__FILE__).'/../lib/clientGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clientGeneratorHelper.class.php';

/**
 * client actions.
 *
 * @package    fileadmin
 * @subpackage client
 * @author     William Palomino
 * @version    3.0
 */
class clientActions extends autoClientActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    $this->helper->form_attributes = array('onsubmit' => 'updateRelatedFiles(this, event);');
    
    // keeps the form in the shadowbox for all the actions
    if ($this->getRequest()->getParameter('shbx')) {
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
  
  public function executeAuthorities(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('authorities');
    
    /*$send_OK = false;
    $tstart = date("Ymd\THis", strtotime("2013-05-08 01:30:00 PM"));
    $tend = date("Ymd\THis", strtotime("2013-05-08 02:00:00 PM"));
    $icloud_api = new ICloud("icloudservice");
    $send_OK = $icloud_api->saveEvent(array('eid' => 'event'.time(), 'description' => 'Test event description', 'summary' => 'Test event', 'tstart' => $tstart, 'tend' => $tend));
    echo $icloud_api->getSendMessageStatus();
    echo date("Y m d H i s", strtotime("now"));*/
  }
          
  public function executeCorrespondence(sfWebRequest $request)
  {
    if ($request->getParameter('caddress')) {   // for silent script to change correspondence address
      $this->getUser()->setAttribute('corresponce_address', $request->getParameter('caddress'));
    }
    else {
      $this->setPagination($request);
    
      $this->helper->section_links_id = 'section_links2';
      $this->section_links = $this->helper->getSectionLinks('correspondence');
      $this->send_to_radios = $this->helper->getSendTo();
    }
  }
          
  public function executeForms(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('forms');
  }
          
  public function executeInstructions(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('instructions');
    $this->instructions_on_file = Doctrine::getTable('UserFile')->getYesNoNcOptions();
    
    $userFile = CommonObject::getSessionUserFileData();    
    $this->iof_value = ($userFile) ? $userFile->getInstructionOnFile() : '';
  }
          
  public function executeScannedDocuments(sfWebRequest $request)       
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2'; 
  }
  
  public function executeSms(sfWebRequest $request)       
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
  }
 
}