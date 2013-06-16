<?php

require_once dirname(__FILE__).'/../lib/listingGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/listingGeneratorHelper.class.php';

/**
 * listing actions.
 *
 * @package    fileadmin
 * @subpackage listing
 * @author     William Palomino
 * @version    3.0
 */
class listingActions extends autoListingActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    // keeps the form in the shadowbox for all the actions
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      $this->partial_links = false;
      $this->edit_pager = false;
      $this->setLayout('form_layout');
      $this->no_title = false;
      $this->mode = 'search';
      $this->shadow_box = true;
    }
    
    // show form and list next to it 
    $this->helper->formlist = true;
    parent::executeIndex(sfContext::getInstance()->getRequest());
    
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      parent::executeIndex($request);
    }
    else {
      $request = $this->setMainFilter($request);
      parent::executeIndex($request);
      $this->editPagerRedirection($request);
    }
  }
  
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
        
    // added by William, 10/06/2013: check if this listing has been linked to some court dates
    $count = Doctrine::getTable('CourtDate')->createQuery()
            ->select('count(id)')
            ->where('listing_id = ?', $request->getParameter('id'))
            ->execute(array(), Doctrine_Core::HYDRATE_NONE);
    $total = $count[0][0];
    if ($total > 0) {
      $this->getUser()->setFlash('info', 'The listing can not be deleted, it is linked to '.$total.' Court Dates');
    }
    else {

      if ($this->getRoute()->getObject()->delete())
      {
        $this->getUser()->setFlash('info', 'The item was deleted successfully.');
      }
    
    }

    $this->redirect('listing/index?shbx=1');
  }
}
