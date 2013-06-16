<?php

require_once dirname(__FILE__).'/../lib/todoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/todoGeneratorHelper.class.php';

/**
 * todo actions.
 *
 * @package    fileadmin
 * @subpackage todo
 * @author     William Palomino
 * @version    3.0
 */
class todoActions extends autoTodoActions
{
  public function preExecute()
  {
    $code = $this->getRequest()->getParameter('code');
    if ($code) {
      sfContext::getInstance()->getUser()->setAttribute('todo_code', $code);
    }
    else {
      $code = sfContext::getInstance()->getUser()->getAttribute('todo_code', 'ALL');
    }
    parent::preExecute();
  }
  
  
  public function executeIndex(sfWebRequest $request)
  {
    if ($request->getParameter('filter')) {
      if (is_array($request->getParameter('filters'))) $this->setFilters($request->getParameter('filters'));
    }
    else if ($request->getParameter('rf')) {
      $this->setFilters($this->configuration->getFilterDefaults());
    }
    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      parent::executeNew($request);
    }
    else {
      $task = new Task();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      $task->setUserFileId($user_file->getId());
      $task->setTaskById($this->getUser()->getGuardUser()->getId());
      $this->task = $task;
      $this->form = new TaskForm($task);
    }
    
  }
  
  /*public function executeMbListBy(sfWebRequest $request)
  {
    $this->redirect("todo/index");
  }
  
  public function executeMbListFor(sfWebRequest $request)
  {
    $this->redirect("todo/index");
  }
  
  public function executeOListBy(sfWebRequest $request)
  {
    $this->redirect("todo/index");
  }
  
  public function executeOListFor(sfWebRequest $request)
  {
    $this->redirect("todo/index");
  }*/
  
  
  // to autocomplete
  public function executeAutocompletetaskfor(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $users = Doctrine::getTable('SfGuardUser')->retrieveUsersForSelect(
                $request->getParameter('q'), 
                $request->getParameter('limit')
    );
    return $this->renderText(json_encode($users));
  }
}
