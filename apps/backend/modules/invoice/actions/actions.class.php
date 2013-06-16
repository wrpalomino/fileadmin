<?php

require_once dirname(__FILE__).'/../lib/invoiceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/invoiceGeneratorHelper.class.php';

/**
 * invoice actions.
 *
 * @package    fileadmin
 * @subpackage invoice
 * @author     William Palomino
 * @version    3.0
 */
class invoiceActions extends autoInvoiceActions
{
  public function preExecute() 
  {
    parent::preExecute();

    // set sections links for this module too
    $this->section_links = $this->helper->getSectionLinks('invoices');
  }
  
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request); 
    
    $this->verifyClientFile('invoices');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $this->redirect($this->getModuleName().'/index?edit_pager=0');
    }
    else {
      $invoice = new Invoice();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      //$invoice->setUserFileId($user_file->getId());
      $this->invoice = $invoice;
      $this->form = new InvoiceForm($invoice);
    }
    
  }
}
