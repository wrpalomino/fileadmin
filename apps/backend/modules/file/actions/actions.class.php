<?php

require_once dirname(__FILE__).'/../lib/fileGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/fileGeneratorHelper.class.php';

/**
 * file actions.
 *
 * @package    fileadmin
 * @subpackage file
 * @author     William Palomino
 * @version    3.0
 */
class fileActions extends autoFileActions
{
  public function preExecute() 
  {
    parent::preExecute();
    $this->helper->setTabs(true); // render the form fieldsets as tabs
    $this->helper->form_attributes = array('onsubmit' => 'return validateFile();');
     
    if (!$this->edit_pager) {
      $this->getUser()->setAttribute('file.max_per_page', 20);
      $this->customFilters();   // set custom filters for list
      //$print_lnk = array('print' => array('text' => 'Print List', 'href' => '#', 'js' => "onclick=print(); return false;"));
    }
    else {
      $this->getUser()->setAttribute('file.max_per_page', 1);
    }
    
    // check status of the client's file 20/04/2013
    CommonObject::checkFileCourtDatesState();
  }
  
  
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  
  public function executeNew(sfWebRequest $request)
  {  
    // commented by William, 14/03/2013: replaced with ajax call
    /*$user_id = $request->getParameter('user_id');
    if ($user_id) { // preload form
      $user_file = new UserFile();
      $user_file->setUserData($user_id);
      $this->user_file = $user_file;
      $this->form = new UserFileForm($user_file);
    }
    else {*/
      parent::executeNew($request);
    //}    
  }
 
  
  public function customFilters()
  {
    $request = sfContext::getInstance()->getRequest();
    $filters_type = ($request->getParameter('filter')) ? $request->getParameter('filter') : '';
   
    if ($request->getParameter('rf')) {
      $this->setFilters($this->configuration->getFilterDefaults());
      $filters_type = 'All';
    }
    else {      
      switch ($filters_type) {
        case 'Current':   $status_filters['status_id'] = 37;   break;
        case 'Closed':    $status_filters['status_id'] = 38;   break;
        case 'Re-open':   $status_filters['status_id'] = 39;   break;
        case 'Complete':
          $this->setFilters($this->configuration->getFilterDefaults());
          break;
        case 'Out-dated':
          $status_filters['status_id'] = '';
          $this->setFilters($this->configuration->getFilterDefaults());
          $this->configuration->setTableMethod('getOutDatedFiles');
          break;
        default:
          /*if ($request->getParameter('page') !== null) {
            $this->configuration->setTableMethod($this->configuration->getTableMethod());
            $status_filters = $this->getFilters();
          }
          else*/ 
          //$this->setFilters($this->configuration->getFilterDefaults());
      }
            
      if ( isset($status_filters) && is_array($status_filters) ) {        
        $this->setFilters($status_filters);
        $this->setPage(1);    // always set to page 1 when new request
      }
    }
    $this->helper->header_note = '<h2>'.$filters_type.' Files List</h2>';
  }
  
  
  // to autocomplete
  public function executeAutocompleteclient(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $clients = Doctrine::getTable('SfGuardUser')->retrieveUsersForSelect(
                $request->getParameter('q'), 
                $request->getParameter('limit'),
                'CLI'
    );
    return $this->renderText(json_encode($clients));
    
    /*$result = UserTable::findClientByName($request['q'], $request->getParameter('limit', 20));
    $output = array();
    foreach($result as $r) {
      $output[$r['id']] = $r['name'];
    }
    return $this->renderText(json_encode($output));*/
  }
  
  
  // added by William, 14/03/2013
  public function executeLoadClientDetails(sfWebRequest $request)
  {
    $client_id = $request->getParameter('client_id');
    if ($client_id) { // preload form
      $user_file = new UserFile();
      $user_arr = $user_file->setUserData($client_id);
      die(json_encode($user_arr));
    }
    else {
      die('none');
    }
    return sfView::NONE;
  }
  
  public function executeAutocompleteinformant(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $informants = Doctrine::getTable('SfGuardUser')->retrieveUsersForSelect(
                $request->getParameter('q'), 
                $request->getParameter('limit'),
                'INF'
    );
    return $this->renderText(json_encode($informants));
  }
  
  public function executeAutocompleteprosecution(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $agencies = Doctrine::getTable('Agency')->retrieveAgenciesForSelect(
                $request->getParameter('q'), 
                $request->getParameter('limit'),
                'PRS'
    );
    return $this->renderText(json_encode($agencies));
  }
  
  
  public function changeFilesStatusBatch($request, $action)
  {
    $ids = $request->getParameter('ids');
    $action_label = ($action == 'close') ? 'closed' : 're-opened';
    
    $user_files = Doctrine_Query::create()
      ->from('UserFile uf')
      ->whereIn('uf.id', $ids)
      ->execute();
    
    if ($user_files) {
      foreach ($user_files as $user_file) {
        $user_file->changeStatus($action);
      }
      $this->getUser()->setFlash('notice', 'The selected user files have been '.$action_label.' successfully!');
 
      $this->redirect('@user_file');
    }
    else {
      $this->getUser()->setFlash('error', 'The selected user files could not be '.$action_label.'!', false);
    }
  }
  
  
  public function executeBatchClosefiles(sfWebRequest $request)
  {
    $this->changeFilesStatusBatch($request, 'close');
  }
  
  
  public function executeBatchReopenfiles(sfWebRequest $request)
  {
    $this->changeFilesStatusBatch($request, 're-open');
  }
  
  
  
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $user_file = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $user_file)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@user_file_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

                
        if (strtolower($this->getActionName()) == 'create') {
          $this->redirect(array('sf_route' => 'user_file_edit', 'create' => '1', 'sf_subject' => $user_file));
        }
        else {
            
          // added to clone file
          $clone_file = $request->getParameter('clone_file');
          if ($clone_file) {
            $new_file = $this->user_file->copy(true);  // true: clone related objects too
            $new_file_number = $new_file->getNewFileNumber();
            $new_file->setNumber($new_file_number);
            $new_file->save();
            
            // added by William, 13/02/2015: load the cloned file to work with it.
            $this->getUser()->setFlash('notice', 'File has been cloned successfully. Redirecting to cloned file, please wait...');
            $this->redirect(array('sf_route' => 'user_file_edit', 'new_file_number' => $new_file_number, 'sf_subject' => $new_file));
          }
          
          $this->redirect(array('sf_route' => 'user_file_edit', 'sf_subject' => $user_file));
        }

      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  } 
  
}
