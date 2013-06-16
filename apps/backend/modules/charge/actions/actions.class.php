<?php

require_once dirname(__FILE__).'/../lib/chargeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/chargeGeneratorHelper.class.php';

/**
 * charge actions.
 *
 * @package    fileadmin
 * @subpackage charge
 * @author     William Palomino
 * @version    3.0
 */
class chargeActions extends autoChargeActions
{
  public function preExecute() {
    parent::preExecute();
    $this->section_links = $this->helper->getSectionLinks('charges');
  }
  
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
    
    // unset some links if no file selected
    $current_client = $this->getUser()->getAttribute('client', null);    
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $links = $this->helper->getSectionLinks('charges');
      unset($links['inf_c2']);
      $this->section_links = $links;
    }
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      //$this->getUser()->setFlash('custom_info', 'To create a new Court Date select a File first!');
      //$this->redirect($this->getModuleName().'/index?edit_pager=1');
      parent::executeNew($request);
    }
    else {
      $charge = new Charge();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      $charge->setUserFileId($user_file->getId());      
      $this->charge = $charge;
      $this->form = new ChargeForm($charge);
    }
    
  }
}
