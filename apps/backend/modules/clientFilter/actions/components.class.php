<?php

require_once dirname(__FILE__).'/../lib/ClientUpFormFilter.class.php';

/**
 * sidebar actions.
 *
 * @package    fileadmin
 * @subpackage clientFilter
 * @author     William Palomino
 * @version    3.0
 */
class clientFilterComponents extends sfComponents
{  
  /*public function executeDefault(sfWebRequest $request)
  {
    $this->current_url = $this->buildPath();
    $this->form = new ClientUpFormFilter();
    
    // force resend to display only courtdates related to the file number
    $this->resend = '';
    $modules_to_force = array('court', 'brief');
    
    $main_filter = $this->getUser()->getAttribute('main_filter', null); 
        
    if ($main_filter !== null) {

      // force resend to display only courtdates related to the file number
      if (in_array($this->getContext()->getModuleName(), $modules_to_force)) {
        if ( (trim($main_filter['number']['text']) == '') && !isset($_POST['resend']) )  {
          foreach ($main_filter as $k => $v) {
            if ($k != 'number')  $main_filter[$k]['text'] = '';
          }
          $this->resend = 'resend';
        }
      }
      
      // added by William, 13/02/2013: load the cloned file data (for module file only)
      $new_file_number = sfContext::getInstance()->getRequest()->getParameter('new_file_number');
      if ($new_file_number) {        
        foreach ($main_filter as $k => $v) {
          $main_filter[$k]['text'] = ($k == 'number') ? $new_file_number : '';
        }
        $this->resend = 'resend';
        //sfContext::getInstance()->getUser()->setFlash('custom_notice', 'Cloned file ('.$new_file_number.') loaded successfully');
      }
      
      $this->form->bind($main_filter);
    }
    
    // to assign one file to the search even if no related object's records are found
    $this->searchFileOnly($request);
  }*/
  
  
  public function buildPath()
  {
    $current_url = $this->getRequest()->getUri();
    
    $environment = sfConfig::get('sf_environment');
    $script = ($environment == 'prod') ? 'index.php': 'backend_dev.php';
    $current_url_new = substr($current_url, strpos($current_url, $script) + strlen($script));
    $current_url_new = str_replace('/'.$script, '', $current_url_new);
    
    $params = sfContext::getInstance()->getRouting()->parse($current_url_new);
    $module = $params['module'];
    //$action = $params['action'];
  
    $parts  = explode('?', $current_url);
    //echo $module.' - '.$action;
    
    return (isset($parts[1])) ? '@mf_'.$module.'?'.$parts[1] : '@mf_'.$module;
  }
  
  public function getQuery($request, $fields_arr=null)
  {
    $q = Doctrine_Query::create()
          ->select('*')
          ->from('UserFile r');
    
    if ( $request->getParameter('mf_filter') || ($fields_arr !== null) ) {
      $arr0 = ($fields_arr !== null) ? $fields_arr : $request->getParameter('client_up_form_filters');
      $empty = true;
      
      foreach ($arr0 as $k => $v) {
        if (is_array($v)) {
          $names = array_filter($v, 'strlen');
          if (!empty($names)) {
            $empty = false;
            break;
          }
        }
      }
      if (!$empty) {        
        $q = Doctrine::getTable('UserFile')->mainFilter($q, null, $arr0);
        return $q;
      }
    }

    $q->addWhere("0");
    return $q;
  }
  
  
  public function searchFileOnly($request) 
  {
    $current_client = sfContext::getInstance()->getUser()->getAttribute('client', null);
    
    $search = ( ($current_client === null) || ($current_client['last_file_id'] === null) );
    
    if ($search) { // only search if search button was triggered & no file selected
      $q = $this->getQuery($request);
      if ($q != '') {
        $file = $q->fetchOne();
        if ($file) {  // load the form and bind the form
          $arr = $arr0;
          $arr['last_name']['text'] = $file->getClient()->getLastName();
          $arr['first_name']['text'] = $file->getClient()->getFirstName();
          $arr['number']['text'] = $file->getNumber();
          $court_dates = $file->getFileCourtDates();
          if (isset($court_dates[0])) {
            $arr['court']['text'] = $court_dates[0]->getCourt()->getName();
            $arr['date']['text'] = $court_dates[0]->getDate();
            $arr['listing']['text'] = $court_dates[0]->getListing()->getName();
          }
          $charges = $file->getFileCharges();
          if (isset($charges[0])) $arr['charge']['text'] = $charges[0]->getCharge();
          $arr['informant']['text'] = $file->getInformant()->obtainFullName();
          $arr['solicitor']['text'] = $file->getSolicitor()->obtainFullName();
                    
          $this->form->bind($arr);
          
          // do not set main_filter, not even with the original array of form's values
          //$main_filter = $this->getUser()->getAttribute('main_filter', null); 
          //if ($main_filter === null) sfContext::getInstance()->getUser()->setAttribute('main_filter', $arr0);
       
          // but do set the current client and file
          $client = array('id' => $file->getClient()->getId(), 'last_file_id' => $file->getId());
          sfContext::getInstance()->getUser()->setAttribute('client', $client);
        }
      }
    }
  }
  
  
  
  public function executeDefinePager()
  {
    $request = $this->getContext()->getRequest();
    $this->pager = new sfDoctrinePager('UserFile', 1);
    
    $mf_fields = null;
    if ($request->getParameter('mf_filter')) {  // perform a search
      $mf_fields = $request->getParameter('client_up_form_filters');
      $this->getUser()->setAttribute('main_filter0', $mf_fields); // save main filter fields
      $this->pager->setPage(1);
      $this->setPage(1);
      
      // reset module's filters when main filter is executed
      $this->obj->setFilters($this->obj->configuration->getFilterDefaults());
    }
    elseif ($request->getParameter('mf_reset')) {  // reset main filter
      $this->getUser()->setAttribute('main_filter0', null);
      $this->pager->setPage(null);
      $this->setPage(null);
    }
    else { // for page or module navigation
      $mf_fields = $this->getUser()->getAttribute('main_filter0', null);
      if ($request->getParameter('page0')) $this->setPage($request->getParameter('page0'));
      $this->pager->setPage($this->getPage());
    }

    $this->pager->setQuery($this->getQuery($request, $mf_fields));
    $this->pager->init();
    $this->getUser()->setAttribute('mf_pager', $this->pager);
    
    // set the object filter to load only according to the file number
    $results = $this->pager->getResults();    
    if ( (count($results) > 0) && $mf_fields) {
      foreach ($results as $result) {
        $file_number = $result->getNumber();
      }
      foreach ($mf_fields as $k => $v) {
        $mf_fields[$k]['text'] = ($k != 'number') ? '' : $file_number;
      }
      $this->getUser()->setAttribute('main_filter', $mf_fields);
      
      //added by William, 15/03/2013: save current client for file pager in case no related object found
      $this->getUser()->setAttribute('client', $this->obj->getCurrentClient('file', $this->pager));
      
    }
    else {
      if ( $request->getParameter('mf_filter') || ($this->getUser()->getAttribute('main_filter0', null) !== null) ) {        
        $request->setParameter('mf_reset', ' Reset ');
      }
      else { // no pagination, no search, no search fields applied
        // reset module's filters if no module's filters have been applied//, unless pagination in progress
        if ( ($request->getParameter('filter') === null) /*&& ($request->getParameter('page') === null)*/ ) {
          $filters = $this->obj->getFilters();
          if (empty($filters)) $request->setParameter('mf_reset', ' Reset ');
        }
      }
    }
    
    return sfView::NONE;
  }

  
  public function executeDefault(sfWebRequest $request)
  {
    $this->current_url = $this->buildPath();
    $this->form = new ClientUpFormFilter();
    
    $this->pager = $this->getUser()->getAttribute('mf_pager', null);
        
    $results = $this->pager->getResults();
    $arr = array();
    foreach ($results as $result) $arr['id'] = $result->getId();
    $arr = sfContext::getInstance()->getUser()->getMainFilterFields($arr, 'file', 'text');
    
    $this->form->bind($arr);
  }
  
  protected function getPager($query) 
  {
    $pager = new Doctrine_Pager($query, $this->getPage(), 3);
    return $pager;
  }

  protected function setPage($page) 
  {
    $this->getUser()->setAttribute('files.page', $page, 'admin_module');
  }

  protected function getPage() 
  {
    return $this->getUser()->getAttribute('files.page', 1, 'admin_module');
  }
}
