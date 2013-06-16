<?php

require_once dirname(__FILE__).'/../lib/courtGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/courtGeneratorHelper.class.php';

/**
 * court actions.
 *
 * @package    fileadmin
 * @subpackage court
 * @author     William Palomino
 * @version    3.0
 */
class courtActions extends autoCourtActions
{
  public function preExecute() 
  {    
    parent::preExecute();
    
    // keeps the form in the shadowbox for all the actions
    if ($this->getRequest()->getParameter('shbx')) {
      $this->partial_links = false;
      $this->edit_pager = false;
      $this->setLayout('form_layout');
      $this->no_title = false;
      $this->mode = 'search';
      $this->shadow_box = true;
      $this->helper->setFormTemplate('form2', false);  // no tabs
    }
    else {
      $this->helper->setTabs(true); // render the form fieldsets as tabs
      $this->helper->form_attributes = array('onsubmit' => 'return validateCourtDate();');      
    
      if (!$this->edit_pager) {
        $this->getUser()->setAttribute('court.max_per_page', 20);
        $this->customFilters();   // set custom filters for list
        $print_lnk = array('print' => array('text' => 'Print List', 'href' => '#', 'js' => "onclick=print(); return false;"));
        $this->section_links = array_merge(Link::getCourtDefaultLinks(), $print_lnk);
      }
      else {      
        $this->getUser()->setAttribute('court.max_per_page', 1);
        $this->setSort(array('date', 'desc'));    // force this order always
        //$this->helper->pagination = false;        // show only one result
        $this->section_links = Link::getCourtDefaultLinks();

        // reset module's filters and page when get the module
        if (sfContext::getInstance()->getRequest()->getParameter('edit_pager')) {
          $this->setFilters($this->configuration->getFilterDefaults());
          $this->setPage(1);
        }
        $filtersx = $this->getFilters();
        if (!empty($filtersx)) $this->helper->pagination = true;  // allow pagination

      }

      // check status of the client's file 20/04/2013
      CommonObject::checkFileCourtDatesState();
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
    
    if (!$this->edit_pager) $this->verifyClientFile('Court Dates');
  }
  
  
  public function customFilters()
  {
    $request = sfContext::getInstance()->getRequest();
    $filters_type = ($request->getParameter('filter')) ? $request->getParameter('filter') : '';
    $MAX_DATE = '2030-12-31';
    $MIN_DATE = "2009-12-31";
    $ONE_DAY = 24*60*60;
    $ONE_WEEK = $ONE_DAY*7;
    
    if ($request->getParameter('rf')) {
      $this->setFilters($this->configuration->getFilterDefaults());
      $filters_type = 'All';
    }
    else {
      switch ($filters_type) {
        case 'Past':
          $date_filters['date']['from'] = $MIN_DATE;
          $date_filters['date']['to'] = date('Y-m-d', time() - $ONE_DAY);
          break;
        case 'Current': 
          $date_filters['date']['from'] = date("Y-m-d");
          $date_filters['date']['to'] = $MAX_DATE;
          break;
        case 'Tomorrow':
          $date_filters['date']['from'] = date('Y-m-d', time() + $ONE_DAY);
          $date_filters['date']['to'] = $date_filters['date']['from'];
          break;
        case 'Next 7 days':
          $date_filters['date']['from'] = date("Y-m-d");
          $date_filters['date']['to'] = date('Y-m-d', time() + $ONE_WEEK);
          break;
        case 'Next 2 weeks':
          $date_filters['date']['from'] = date("Y-m-d");
          $date_filters['date']['to'] = date('Y-m-d', time() + 2*$ONE_WEEK);
          break;
        case 'Past 2 weeks':  
          $date_filters['date']['from'] = date('Y-m-d', time() - 2*$ONE_WEEK);
          $date_filters['date']['to'] = date('Y-m-d', time() - $ONE_DAY);
          break;
        case 'Today':
          $date_filters['date']['from'] = date("Y-m-d");
          $date_filters['date']['to'] = $date_filters['date']['from'];
          break;
        case 'Complete':
          $this->setFilters($this->configuration->getFilterDefaults());
          break;
        default:
          /*if ($request->getParameter('page') !== null) $date_filters = $this->getFilters();
          else*/ 
          //$this->setFilters($this->configuration->getFilterDefaults());
      }
      if ( isset($date_filters) && is_array($date_filters) ) {
        $this->setFilters($date_filters);
        $this->setPage(1);    // always set to page 1 when new request
      }
    }
    $this->helper->header_note = '<h2>'.$filters_type.' Court Dates List</h2>';
  }
  
  public function executeNew(sfWebRequest $request)
  {
    if ($this->verifyUserFile('To create a new Court Date select a File first!')) {
      $file_id = CommonObject::getSessionUserFileData('fileId');
      $court_date = new CourtDate();
      $user_file = Doctrine::getTable('UserFile')->find($file_id);
      $court_date->setUserFileId($user_file->getId());
      $court_date->setAppearingId($this->getUser()->getGuardUser()->getId());
      
      $court_dates = $user_file->getFileCourtDates();
      if ($court_dates) {
        $court_date->setCourtId($court_dates[sizeof($court_dates)-1]->getCourtId());        
      }
      $this->court_date = $court_date;
      $this->form = new CourtDateForm($court_date);
    }
    
  }
  
  
  public function executeResults(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    //$this->section_links = $this->helper->getSectionLinks('results');
    $this->section_links = Link::getCourtResultsLinks();
  }
  
  public function executeSummaryAdjournments(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('summary_adjournments');
  }
  
  
  public function executeChildren(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('children');
  }
  
  public function executeMagistrates(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('magistrates');
  }
  
  /*public function executeCommittalStream(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    $this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('committal_stream');
  }*/
  
  public function executeCounty(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    //$this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('county');
  }
  
  public function executeAppeal(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    //$this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('appeal');
  }
  
  
  public function executeSupreme(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    //$this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('supreme');
  }
  
  public function executeCourtAppeal(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    //$this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('court_appeal');
  }
  
  public function executeHighCourt(sfWebRequest $request)
  {
    $this->setPagination($request);
    
    //$this->helper->section_links_id = 'section_links2';
    $this->section_links = $this->helper->getSectionLinks('high_court');
  } 
  
}
