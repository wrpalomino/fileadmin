<?php

require_once dirname(__FILE__).'/../lib/adminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/adminGeneratorHelper.class.php';

/**
 * admin actions.
 *
 * @package    fileadmin
 * @subpackage admin
 * @author     William Palomino
 * @version    3.0
 */
class adminActions extends autoAdminActions
{
  public function preExecute() 
  {
    if (in_array(sfContext::getInstance()->getActionName(), array('clock', 'downloadfile'))) return true;
    
    parent::preExecute();
    // keeps the form in the shadowbox for all the actions
    $this->no_title = true;
    $this->partial_links = false;
    //$this->helper->document_tpl_file = 'empty';
    //$this->helper->show_settings = true;
    //$this->helper->show_buttons = true;

    $doc = sfContext::getInstance()->getRequest()->getParameter('doc');
    if ($doc) sfContext::getInstance()->getUser()->setAttribute ('doc', $doc);
    else $doc = sfContext::getInstance()->getUser()->getAttribute ('doc', null);
    
    $this->task = $doc;
    if ($doc) {
      //$this->edit_pager = false;
      //$this->setLayout('form_layout');
      //$this->mode = 'search';
      $this->shadow_box = true;
      //$this->helper->document_tpl_file = $doc;
      
      //$this->mapSubfolder($doc);
    }
  }
  
  
  public function executeProcess(sfWebRequest $request)
  { 
    $this->found = false;
    switch ($this->task) {
      case 'chfinu':  case 'stficl':  case 'stfiro':
     
        $current_client = $this->getUser()->getAttribute('client', null); 
        if ($current_client !== null) {
          $user_file = ($current_client['last_file_id']) ? Doctrine::getTable('UserFile')->find($current_client['last_file_id']) : null;
          if ($user_file) {
            $this->found = true;
            $this->user_file = $user_file;
            
            if ($this->task == 'chfinu') $info = 'You are about to change file number: '.$user_file->getNumber();
            else $info = 'You are about to change the status of the file number '.$user_file->getNumber();
            
            $this->form = new ChangeFileNumberForm($user_file, array('task' => $this->task));
            $this->getUser()->setFlash('shbx_custom_info', $info, false);
          }
        }
        
        break;
      default:
    }
    
    if (!$this->found) $this->getUser()->setFlash('shbx_custom_error', 'There is no file selected', false);
    $this->setLayout('form_layout');
  }
  
  
  public function executeChangeFileNumber(sfWebRequest $request)
  {
    $this->found = false;
    $current_client = $this->getUser()->getAttribute('client', null);
    if ($current_client !== null) {
      $user_file = ($current_client['last_file_id']) ? Doctrine::getTable('UserFile')->find($current_client['last_file_id']) : null;
      if ($user_file) {
        $this->found = true;
        $this->form = new ChangeFileNumberForm($user_file, array('task' => $this->task));
        $this->form->bind($request->getParameter('user_file'), $request->getFiles('user_file'));
   
        if ($this->form->isValid()) {
          $this->form->save();
          $this->getUser()->setFlash('shbx_custom_notice', 'The file was updated successfully', false);
        }
      }
    }
    
    if (!$this->found) $this->getUser()->setFlash('shbx_custom_error', 'There is no file selected', false);
    $this->setLayout('form_layout');
    $this->setTemplate('process');
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
    
    $this->redirect("admin/correspondence");
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    parent::executeEdit($request);
    $this->redirect("admin/correspondence");
  }
  
  
  public function executeFileManagement(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('file_management');
    
  }
  
  public function executePhoneBook(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('phone_book');
  }
  
  public function executeReferral(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('referral');
  }
  
  public function executeCorrespondence(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('correspondence');
  }
  
  public function executeSettings(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->disk = array('path' => '/', 'total' => 0,  'free' => 0, 'dirs' => array());
    $this->disk['total'] = MyUtil::roundsize(disk_total_space($this->disk['path']));
    $this->disk['free'] = MyUtil::roundsize(disk_free_space($this->disk['path']));
    $this->disk['dirs']['wamp'] = array('path' => '/PHP', 'size' => 0, 'dirs' => array());
    
    $this->disk['dirs']['wamp']['size'] = MyUtil::get_dir_size($this->disk['dirs']['wamp']['path']); 
    //$this->section_links = $this->helper->getSectionLinks('referral');
  }
  
  public function executeCourtList(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $rel_uri = sfContext::getInstance()->getRouting()->getCurrentInternalUri(); 
    $this->request_uri = str_replace($rel_uri, 'court/index', $request->getUri().'&shbx=1');
    
    $this->helper->section_links_id = 'section_links2';
    //$this->section_links = $this->helper->getSectionLinks('court_list');
    $this->section_links = Link::getAdminCourtListLinks();
  }
  
  
  public function executeClock(sfWebRequest $request)
  {
    $msg = date('D, d M - h:i A');
    die($msg);  // echo $msg; causes headers already sent problem
    
    return sfView::NONE;
  }
  
  
  public function executeDownloadfile(sfWebRequest $request)
  {
    $file_name = ($request->getParameter($fname)) ? $request->getParameter($fname) : 'fileadmin.sql';
    $fullPath = ($request->getParameter($fpath)) ? $request->getParameter($fpath) : '/var/www/html/fileadmin.sql';

    if (file_exists($fullPath)) {       
        header('Content-Description: File Transfer'); 
        header('Content-Type: application/octet-stream'); 
        header('Content-Length: ' . filesize($fullPath)); 
        header('Content-Disposition: attachment; filename="' . $file_name . '"'); 

        readfile($fullPath);
        exit();
    }
    return sfView::NONE;
  }
  
}
