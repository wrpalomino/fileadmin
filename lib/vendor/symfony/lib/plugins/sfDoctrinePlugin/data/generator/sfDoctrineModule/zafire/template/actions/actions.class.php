[?php

require_once(dirname(__FILE__).'/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorConfiguration.class.php');
require_once(dirname(__FILE__).'/../lib/Base<?php echo ucfirst($this->moduleName) ?>GeneratorHelper.class.php');

/**
 * <?php echo $this->getModuleName() ?> actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 31002 2010-09-27 12:04:07Z Kris.Wallsmith $
 */
abstract class <?php echo $this->getGeneratedModuleName() ?>Actions extends <?php echo $this->getActionsBaseClass()."\n" ?>
{
  public function defineVars()
  {    
    $this->no_title = false;
    $this->edit_pager = false;
    $this->only_filters = false;
    $this->show_filters = true;
    $this->shadow_box = false;
    
    $this->request = $this->getRequest();
    
    // added by William 06/03/2012: to allow a edit pager version
    $this->partial_links = sfConfig::get('app_<?php echo $this->getModuleName() ?>_partial_links');
    $this->links = $this->helper->getPageLinks();
  }

  public function preExecute()
  {
    $this->configuration = new <?php echo $this->getModuleName() ?>GeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new <?php echo $this->getModuleName() ?>GeneratorHelper();

    parent::preExecute();
    
    // added by William, 31/05/2013: action vars
    $this->defineVars();    
    
    // added by William, 11/03/2013: search files using main filter, except if shadowbox
    if ($this->getRequest()->getParameter('shbx') === NULL) {
      $this->renderComponent('clientFilter', 'definePager', array('obj' => $this));
    }
    
    // set edit_pager. Always set module's default edit_pager (overwrite any setting) unless this is 'x' (variable)
    $default_edit_pager = sfConfig::get('app_<?php echo $this->getModuleName() ?>_default_edit_pager');
    if ((string)$default_edit_pager != 'x') {
      $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>_edit_pager', $default_edit_pager);
    }
    else if ($this->request->getParameter('edit_pager') != NULL) {
      $this->getUser()->setAttribute('<?php echo $this->getModuleName() ?>_edit_pager', $this->request->getParameter('edit_pager'));
    }
        
    if ($this->getUser()->getAttribute('<?php echo $this->getModuleName() ?>_edit_pager', 0)) {    
      $this->no_title = true;
      $this->edit_pager = true;
      $this->only_filters = true;
      
      // load default section links for search, new, and edit
      $this->section_links = $this->helper->getSectionLinks('default');
    }
    
    // set the initial mode
    if ($this->request->getParameter('mode')) $this->getUser()->setAttribute('mode', $this->request->getParameter('mode'));
    $this->mode = $this->getUser()->getAttribute('mode', 'search');

    // set the status of the file here in case there is redirection
    $file = CommonObject::getSessionUserFileData();
    if ($file) $this->getUser()->setFlash('file_status', 'File Status: '.$file->getStatus()->getName(), false);
  }
  
  
  public function preIndex($request)
  {
    $request = $this->setMainFilter($request);
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort'))) {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }
    // pager
    if ($request->getParameter('page')) {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }
  
  
  public function setMainFilter($request)
  {
    $main_filter = $this->getUser()->getAttribute('main_filter', null);
        
    if ($request->getParameter('mf_reset')) {    
      $this->getUser()->setAttribute('main_filter', null);
      $request->getParameterHolder()->remove('filtered');
    
      // set search mode
      $this->getUser()->setAttribute('mode', 'search');
      $this->getUser()->setAttribute('client', null);
      
      // reset module's filters when main filter is executed
      $this->setFilters($this->configuration->getFilterDefaults());
      
      $this->mode = sfContext::getInstance()->getUser()->getAttribute('mode', 'search');
    }
    else if ($request->getParameter('mf_filter') || ($main_filter !== null) ) {     
      if ($request->getParameter('mf_filter')) {
        //$arr = $request->getParameter('client_up_form_filters');
        //$this->getUser()->setAttribute('main_filter', $arr);
        $arr = $this->getUser()->getAttribute('main_filter', null);
        
        // added 17/02/2013: set results list paging to 0 after a search request!
        if ($request->getParameter('page')) $request->setParameter('page', 1);
        $this->setPage(1);
      }
      else {
        $arr = $this->getUser()->getAttribute('main_filter', null);
      }
      
      $empty = true;
      foreach ($arr as $k  => $v) {
        if (is_array($v)) {
          $names = array_filter($v, 'strlen');
          if (!empty($names)) {
            $empty = false;
            break;
          }  
        }
      }
      if (!$empty) {
        $this->configuration->setTableMethod('mainFilter');
      }
    }
    return $request;
  }
  
  public function editPagerRedirection($request)
  {
    if ($this->edit_pager) {
    
      // added 25/02/2013: force to show if there is records, except when require search mode!!!!
      $mode = $request->getParameter('mode');  // search mode only
      if ($mode === null) {
        $main_filter = $this->getUser()->getAttribute('main_filter', null);
        if ( ($this->pager->getNbResults() > 0)&&($this->mode != 'browse')&&($main_filter !== NULL) ) $this->mode = 'browse';
      }
      
      if ( ($this->mode == 'browse') || ($request->getParameter('filtered') != NULL) || ($request->getParameter('page') != NULL) ) {
        if ($request->getParameter('flc')) {
          $this->getUser()->setFlash('notice', 'The item was created successfully!');
          // added by William, 04/05/2103: pass info flash to next page
          if ($this->getUser()->hasFlash('info')) $this->getUser()->setFlash('info', $this->getUser()->getFlash('info'));
        }
        if ($this->pager->getNbResults() > 0) {
          $this->getUser()->setAttribute('mode', 'browse');
          $this->getUser()->setAttribute('client', $this->getCurrentClient('<?php echo $this->getModuleName()?>', $this->pager));
          $this->redirect('<?php echo $this->getModuleName()?>/edit');
        }
        else if ($request->getParameter('filtered') != NULL) {
          $this->getUser()->setAttribute('mode', 'search');
          $this->getUser()->setAttribute('client', null);
          
          $this->getUser()->setFlash('search_info', 'No Results found!', false);
        }
      }
    }
    else {  // no edit_pager mode but main search filter triggered
      if ( ($this->pager->getNbResults() > 0) && ($request->getParameter('mf_filter') != NULL) ) { 
          $this->getUser()->setAttribute('mode', 'browse');
          $this->getUser()->setAttribute('client', $this->getCurrentClient('<?php echo $this->getModuleName()?>', $this->pager));
      }
    }
  }
  
  
  public function getCurrentClient($module, $pager)
  {
    $client = array('id' => null, 'last_file_id' => null);
    $objects = $pager->getResults();
    
    if ( $objects && isset($objects[0]) ) {
      $object = $objects[0];

      if ( method_exists($object, 'obtainClientId') && is_callable(array($object, 'obtainClientId')) ) {
        $client['id'] = $object->obtainClientId($module);
      }
      if ( method_exists($object, 'obtainUserFileId') && is_callable(array($object, 'obtainUserFileId')) ) {
        $client['last_file_id'] = $object->obtainUserFileId($module);
      }
    }
    return $client;
  }
  
  
  public function setPagination($request)
  {
    $this->edit_pager = 1;
    if ($this->mode == 'browse') {
      $this->preIndex($request);
      if ($this->pager->getNbResults() > 0) {
        $this->getUser()->setAttribute('client', $this->getCurrentClient('<?php echo $this->getModuleName()?>', $this->pager));
      }
      $this->helper->setActionUrl('<?php echo $this->getModuleName()?>'.'/'.sfContext::getInstance()->getActionName());
    }
  }
  
  
  public function verifyClientFile($object_name, $current_client=NULL, $flash_elem='shbx_custom_info', $rd=false)
  {
    if ($current_client === NULL) $current_client = $this->getUser()->getAttribute('client', null);
    
    $msg = ($this->pager->getNbResults() == 0) ? 'No Results found!' : 'No File selected, showing all '.$object_name.'!';    
    if ($current_client === NULL) {
      if (!$this->getUser()->hasFlash($flash_elem))
        $this->getUser()->setFlash($flash_elem, $msg, $rd);
    }
    else if ($current_client['last_file_id'] === NULL) {
      if (!$this->getUser()->hasFlash($flash_elem))
        $this->getUser()->setFlash($flash_elem, $msg, $rd);
    }
  }
  
  
  public function verifyUserFile($msg, $flash_elem='custom_info', $e_pager=1)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $this->getUser()->setFlash($flash_elem, $msg);
      $this->redirect($this->getModuleName().'/index?edit_pager='.$e_pager);
      //return false;
    }
    return true;
  }
  
  
  public function postExecute()
  {
    // added by William, 10/05/2013: warning for user
    if ($this->getActionName() == 'index') {
      if ( ($this->mode != 'search') && ($this->edit_pager == 0) ) {
        $this->getUser()->setFlash('info', 'To search among all records please reset the main filter!', false);
      }
    }
    
    // set the status of the file here in case there is no redirection
    $file = CommonObject::getSessionUserFileData();
    if ($file) $this->getUser()->setFlash('file_status', 'File Status: '.$file->getStatus()->getName(), false);
  }
  

<?php include dirname(__FILE__).'/../../parts/indexAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filterAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/newAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/createAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/editAction.php' ?>

<?php // added by William, 03/02/2012 ?>
<?php include dirname(__FILE__).'/../../parts/showAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/updateAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/deleteAction.php' ?>

<?php if ($this->configuration->getValue('list.batch_actions')): ?>
<?php include dirname(__FILE__).'/../../parts/batchAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/processFormAction.php' ?>

<?php if ($this->configuration->hasFilterForm()): ?>
<?php include dirname(__FILE__).'/../../parts/filtersAction.php' ?>
<?php endif; ?>

<?php include dirname(__FILE__).'/../../parts/paginationAction.php' ?>

<?php include dirname(__FILE__).'/../../parts/sortingAction.php' ?>
}
