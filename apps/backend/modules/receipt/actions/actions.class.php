<?php

require_once dirname(__FILE__).'/../lib/receiptGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/receiptGeneratorHelper.class.php';

/**
 * receipt actions.
 *
 * @package    fileadmin
 * @subpackage receipt
 * @author     William Palomino
 * @version    3.0
 */
class receiptActions extends autoReceiptActions
{
  public function preExecute() 
  {
    parent::preExecute();

    // set sections links for this module too
    $this->section_links = $this->helper->getSectionLinks('receipts');
  }
  
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request); 
    
    $this->verifyClientFile('receipts');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $this->redirect($this->getModuleName().'/index?edit_pager=0');
    }
    else {
      $receipt = new Receipt();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      //$invoice->setUserFileId($user_file->getId());
      $this->receipt = $receipt;
      $this->form = new ReceiptForm($receipt);
    }
    
  }
}
